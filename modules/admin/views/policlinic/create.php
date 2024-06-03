<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\policlinic $model */

$this->title = 'Create Policlinic';
$this->params['breadcrumbs'][] = ['label' => 'Policlinics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policlinic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
