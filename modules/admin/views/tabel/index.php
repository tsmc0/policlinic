<?php

use app\models\DoctorTabel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DoctorTabelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Табель приёма';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-tabel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить табель приёма', ['create'], ['class' => 'btn out-btn']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'docID',
            'workingDayStart:ntext',
            'workingDayEnd:ntext',
            'clientType',
            //'freeDay',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DoctorTabel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
