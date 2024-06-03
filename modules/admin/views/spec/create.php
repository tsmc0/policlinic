<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DoctorSpec $model */

$this->title = 'Create Doctor Spec';
$this->params['breadcrumbs'][] = ['label' => 'Doctor Specs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-spec-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
