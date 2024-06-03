<?php

use yii\bootstrap5\Html;

$this->title = 'Мой профиль';

$listMap = "";
foreach (array_reverse($list) as $l){
    $el = "<div class='com-card'>";
    $specName = \app\models\Doctor::find()->where(['id' => $l['docID']])->asArray()->one();

    $specW = \app\models\DoctorSpec::find()->where(['id' => $specName['profID']])->asArray()->one()['title'];
    $specName = $specName['last_name'] . ' ' . $specName['first_name'] . ' ' . $specName['father_name'];

    $el .= "<h6>Специалист: {$specName}</h6>";
    $el .= "<h6>Специальность: {$specW}</h6>";
    $el .= "<h6>Время записи: {$l['time_write']}</h6>";
    $el .= "</div>";

    $listMap .= $el;
}

?>
<style>
    .com-card{
        background-color: #f5f5f5 !important;
        border-radius: 10px !important;
        padding: 20px !important;
        margin-bottom: 50px;
    }

    .wlist{
        margin-bottom: 50px;
        margin-top: 50px;
    }
</style>
<div class="com-card">
    <h4><b> <?= Yii::$app->user->identity->last_name . ' ' . Yii::$app->user->identity->first_name . ' ' .Yii::$app->user->identity->father_name ?> </b></h4>
    <h7>Имя пользователя: <?= Yii::$app->user->identity->username ?> </h7><br>
    <h7>EMAIL: <?= Yii::$app->user->identity->email ?> </h7><br>
    <h7>Дата рождения: <?= Yii::$app->user->identity->date_birth ?> </h7><br>
    <h7>Медполис: <?= Yii::$app->user->identity->medPolis ?> </h7><br>
    <h7>Дата регистрации: <?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->date_create) ?> </h7><br>
    <?php
        if (Yii::$app->user->identity->isAdmin == 1) {
            echo Html::button(
        'Админ-панель',
               ['class' => 'btn out-btn', 'style' => 'margin-top: 50px;', 'onclick' => 'window.location.href = "'.\yii\helpers\Url::to('adminpanel').'";']
            );
        } else {

        }
    ?>
</div>
<h2>Мои записи к врачам</h2>
<div class = 'wlist'>
    <?= $listMap ?>
</div>

<?php

echo Html::beginForm(['/site/logout']);
echo Html::submitButton(
    'Выйти (' . Yii::$app->user->identity->username . ')',
    ['class' => 'btn btn-danger', 'style' => 'margin-bottom: 50px;']
);
echo Html::endForm();

?>


