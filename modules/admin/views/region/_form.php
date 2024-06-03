<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Region $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 1])->label('Наименование') ?>

    <?= $form->field($model, 'district')->textarea(['rows' => 1])->label('Районы') ?>

    <?= $form->field($model, 'numeral')->textInput()->label('Номер участка') ?>

    <?=  $form->field($model, 'polID')->dropdownList(\app\models\Policlinic::find()->select('title')->indexBy('id')->column(),
        ['prompt'=>'Выберите поликлинику'])->label('Поликлиника')
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
