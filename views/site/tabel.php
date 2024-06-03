<?php

    use app\models\DoctorTake;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    date_default_timezone_set('Asia/Yekaterinburg');

    $docname = $docInfo['last_name'] . ' ' . $docInfo['first_name'] . ' ' . $docInfo['father_name'];
    $docspec = $docSpec['title'];
    $polname = $polInfo['title'];

    $this->title = 'Табель приёма ' . $docname;

    $period = new DatePeriod(
        new DateTime(gmdate('d.m.Y h:i')),
        new DateInterval('P1D'),
        new DateTime(gmdate('d.m.Y h:i', time() + 864000))
    );

    $weekDays = ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'];

    $dates10 = "";
    foreach ($period as $key => $value) {
        $weekDay = $value->format('w');
        $dayNum = $value->format('d');
        $_start = ($dayNum == gmdate('d')) ? "<th style = 'border-top:2px solid #0d6efd !important;'>" : "<th>";

        $dates10 .= $_start . $value->format('d.m ') . ' ' . $weekDays[$weekDay] . ' ' . "</th>";
    }

    $tableHeight = 0;
    $fullMatrix = [];
    $contentTable = [];
    $datesRow = [];

    foreach ($datesList as $date){
        if (!is_null($date['info'])){
            $minutes = [];
            $startTime = strtotime($date['info']['workingDayStart']);
            $endTime = strtotime($date['info']['workingDayEnd']);

            for ($i = 0; ($i + $startTime) <= $endTime; $i+=$docInfo['timePerClient'] * 60) {
                $minutes[] = gmdate('H:i', $startTime + $i + 60 * 60 * 5);
            }

        } else {
            $minutes = [];
        }

        if ($tableHeight < count($minutes)) $tableHeight = count($minutes);

        if (count($minutes) == 0) $minutes = array_fill(0, $tableHeight, 0);

        $contentTable[] = $minutes;
        $datesRow[] = $date['date'];
    }

    foreach ($contentTable as $date => $val){
        if (count($val) == 0){
            $contentTable[$date] = array_fill(0, $tableHeight, 0);
        }
    }

    $rows = array_fill(0, $tableHeight, array_fill(0, 10, null));

    $takenByUser = [];

    for ($j = 0; $j < $tableHeight; $j++) {
        for ($k = 0; $k < 10; $k++) {
            if ($contentTable[$k][$j] ?? ''){
                $check = DoctorTake::find()->where(['time_write' => $datesRow[$k] . ' ' . $contentTable[$k][$j] ?? '--:--'])->andFilterWhere(['docID' => $_GET['docid']])->asArray()->all();

                if (count($check) != 0){
                    $rows[$j][$k] = '_' . $contentTable[$k][$j] ?? '';

                    foreach ($check as $c){
                        if ($c['userID'] == Yii::$app->user->identity->id){
                            $takenByUser[] = $datesRow[$k];
                        }
                    }
                } else {
                    $rows[$j][$k] = $contentTable[$k][$j] . '*' . $datesRow[$k] ?? '';
                }
            }
        }
    }

    $dates = "";

    foreach ($rows as $row => $content){
        $row = "<tr>";

        foreach ($content as $val) {
            if ($val == 0) {
                $row .= "<td class=''>Н/Д</td>";
            } elseif (str_starts_with($val, '_')){
                $val = str_replace('_', '', $val);

                $row .= ($val != '') ? "<td class='taken'>{$val}</td>" : "<td class=''>-</td>";
            } else {
                $_v = explode('*', $val);
                $valTime = $_v[1] . ' ' . $_v[0];

                $val = $_v[0];

                $row .= ($val != '') ? ($_v[1] != gmdate('d.m.Y')) ? "<td class='not-taken' onclick='showModal(`{$valTime}`)'>{$val}</td>" : "<td>{$val}</td>" : "<td class=''>-</td>";
            }
        }

        $row .= "</tr>";
        $dates .= $row;
    }

    $datesNone = "";

    if ($tableHeight == 0){
        $datesNone = "<h4 class='taken'>Нет данных о расписании</h4>";
    }

?>

<style>
    .not-taken{
        background-color: #21aa77 !important;
        color: white !important;
        cursor: pointer !important;
        border: 1px solid rgba(0,0,0,.1) !important;
    }

    .taken{
        background-color: #b51d29 !important;
        color: white !important;
        border: 1px solid rgba(0,0,0,.1) !important;
    }

    .neutral{
        background-color: #616161 !important;
        color: white !important;
    }

    h4{
        font-size: 18px !important;
        padding: 15px !important;
    }

    .modalc{
        position: absolute;
        z-index: 999999999;
        top: 0 !important;
        left: 0 !important;
        background-color: rgba(0,0,0,.75);
        width: -webkit-fill-available !important;
        height: 100vh !important;
        display: none;
        align-items: center;
        align-content: center;
        justify-content: center;
    }

    .btns{
        display: flex;
        gap: 10px;
    }

    .val-d{
        font-size: 14px;
        border: 1px solid rgba(0,0,0,.1) !important;
        padding: 10px;
        color: black;

    }
</style>

<div class="modalc" id = 'create-rec'>
    <div class = 'write-form'>
        <h4>Записаться к врачу <b><?php echo $docname ?></b>
            <br>Выбранное время записи: <b id = 'timex'></b>
            <br>Поликлиника: <b><?php echo $polname ?></b>
            <br>Адрес поликлиники: <b><?php echo $polInfo['address'] ?></b>
        </h4>
        <?php
            $form = ActiveForm::begin(['class' => 'recordForm']);

            echo $form->field($model, 'writeTime')->textInput(['id' => 'writeTime', 'type' => 'hidden']);
            echo $form->field($model, 'docID')->textInput(['value' => $docInfo['id'], 'type' => 'hidden']);
            echo $form->field($model, 'regID')->textInput(['value' => 1, 'type' => 'hidden']);
            echo $form->field($model, 'userID')->textInput(['value' => 1, 'type' => 'hidden']);

            echo "<div class = 'btns'>";
            echo Html::submitButton('Записаться', ['class' => 'btn btn-primary', 'name' => 'write-button', 'id' => 'sendd']);
            echo Html::button('Отмена', ['class' => 'btn btn-secondary', 'id' => 'close-button']);
            echo "</div>";

            ActiveForm::end();
        ?>
    </div>
</div>

<h1>Табель приёма <?php echo $docname ?> (<?php echo $docspec ?>)</h1>
<h7>Поликлиника: <?php echo $polname ?></h7>

<table class="table" style = 'margin-top: 50px'>
    <thead>
    <tr id = 'DATES_LIST'>
        <?php echo $dates10 ?>
    </tr>
    </thead>
    <tbody id = 'DATES_BODY'>
        <?php echo $dates ?>
    </tbody>
</table>
<?php echo $datesNone ?>
<p class="val-d"><b>Н/Д</b><br>- Нет данных о расписании для этого дня</p>
<script>
    const takenByUser = <?php echo json_encode($takenByUser) ?>;

    function showModal(time = null){
        document.body.style.overflow = "hidden";
        document.getElementById('create-rec').style.display = 'flex';
        document.getElementById('timex').textContent = time;
        window.scrollTo(0,0);

        if (takenByUser.find((el) => el === time.split(' ')[0]) !== undefined){
            document.getElementById('sendd').textContent = 'Вы уже записаны на этот день';
            document.getElementById('sendd').classList.add('btn-danger');
            document.getElementById('sendd').setAttribute('type', 'button');
        } else {
            document.getElementById('sendd').classList.add('btn-primary');
            document.getElementById('sendd').textContent = 'Записаться';
            document.getElementById('sendd').setAttribute('type', 'sumbit');
            document.getElementById('sendd').addEventListener('click', () => document.getElementById('writeTime').value = time);
        }


    }

    function hideModal(){
        document.body.style.overflow = "auto";
        document.getElementById('create-rec').style.display = 'none';
    }

    document.getElementById('close-button').addEventListener('click', () => hideModal());

</script>
