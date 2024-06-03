<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Region $model */

$this->title = 'Обновить участок: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список участков', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
