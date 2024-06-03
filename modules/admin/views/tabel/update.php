<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DoctorTabel $model */

$this->title = 'Обновить табель: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список табелей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctor-tabel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
