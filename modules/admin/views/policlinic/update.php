<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\policlinic $model */

$this->title = 'Update Policlinic: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Policlinics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="policlinic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
