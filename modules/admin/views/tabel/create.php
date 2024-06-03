<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DoctorTabel $model */

$this->title = 'Добавить табель приёма';
$this->params['breadcrumbs'][] = ['label' => 'Табели приёма', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-tabel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
