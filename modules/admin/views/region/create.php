<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Region $model */

$this->title = 'Создать участок';
$this->params['breadcrumbs'][] = ['label' => 'Список участков', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
