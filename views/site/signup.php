<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Создать аккаунт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните поля ниже чтобы создать аккаунт:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'father_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'dateBirth')->input('date') ?>
            <?= $form->field($model, 'medPolis')->textInput(['autofocus' => true]) ?>

            <?php echo $form->field($model, 'polID')->dropdownList(
                \app\models\Policlinic::find()->select(['title','id'])->indexBy('id')->column(),
                ['prompt'=>'Выберите поликлинику приписания']
            );?>

            <?php echo $form->field($model, 'regID')->dropdownList(
                \app\models\Region::find()->select(['title','id'])->indexBy('id')->column(),
                ['prompt'=>'Выберите номер участка']
            );?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'repeat_password')->passwordInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Создать аккаунт', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
