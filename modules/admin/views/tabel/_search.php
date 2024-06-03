<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DoctorTabelSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctor-tabel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'docID') ?>

    <?= $form->field($model, 'workingDayStart') ?>

    <?= $form->field($model, 'workingDayEnd') ?>

    <?= $form->field($model, 'clientType') ?>

    <?php // echo $form->field($model, 'freeDay') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
