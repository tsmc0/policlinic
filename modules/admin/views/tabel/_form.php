<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DoctorTabel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctor-tabel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'docID')->dropdownList(\app\models\Doctor::find()->select('last_name')->indexBy('id')->column(),
        ['prompt'=>'Выберите доктора'])->label('Доктор')
    ?>

    <?= $form->field($model, 'workingDayStart')->textarea(['rows' => 1])->label('Время начала приёма (дд.мм.гггг чч:мм)') ?>

    <?= $form->field($model, 'workingDayEnd')->textarea(['rows' => 1])->label('Время завершения приёма (дд.мм.гггг чч:мм)') ?>

    <?= $form->field($model, 'clientType')->textInput()->hiddenInput()->label('') ?>

    <?= $form->field($model, 'freeDay')->textInput()->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn out-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
