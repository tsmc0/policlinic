<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Doctor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textarea(['rows' => 1])->label('Имя') ?>

    <?= $form->field($model, 'last_name')->textarea(['rows' => 1])->label('Фамилия') ?>

    <?= $form->field($model, 'father_name')->textarea(['rows' => 1])->label('Отчество') ?>

    <?=  $form->field($model, 'regID')->dropdownList(\app\models\Region::find()->select('title')->indexBy('id')->column(),
        ['prompt'=>'Выберите участок'])->label('Участок')
    ?>

    <?= $form->field($model, 'date_create')->textInput()->hiddenInput()->label('') ?>

    <?=  $form->field($model, 'profID')->dropdownList(\app\models\DoctorSpec::find()->select('title')->indexBy('id')->column(),
        ['prompt'=>'Выберите специальность'])->label('Специальность')
    ?>

    <?= $form->field($model, 'avatar')->textarea(['rows' => 1])->hiddenInput()->label('') ?>

    <?= $form->field($model, 'timePerClient')->textInput()->label('Время (в минутах) на пациента') ?>

    <div class="form-group">
        <?= Html::submitButton('Cоздать', ['class' => 'btn out-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
