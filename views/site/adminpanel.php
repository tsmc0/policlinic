<?php

use yii\bootstrap5\Html;

?>
<h1>Панель управления</h1>
<?php
    echo Html::button(
        'Табель приёма',
        ['class' => 'btn out-btn', 'style' => 'margin-top: 50px;margin-right: 25px;', 'onclick' => 'window.location.href = "'.\yii\helpers\Url::to('../admin/tabel').'";']
    );
    echo Html::button(
        'Список участков',
        ['class' => 'btn out-btn', 'style' => 'margin-top: 50px;margin-right: 25px;', 'onclick' => 'window.location.href = "'.\yii\helpers\Url::to('../admin/region').'";']
    );
    echo Html::button(
        'Список докторов',
        ['class' => 'btn out-btn', 'style' => 'margin-top: 50px;margin-right: 25px;', 'onclick' => 'window.location.href = "'.\yii\helpers\Url::to('../admin/doctor').'";']
    );
    echo Html::button(
        'Список спициальностей',
        ['class' => 'btn out-btn', 'style' => 'margin-top: 50px;margin-right: 25px;', 'onclick' => 'window.location.href = "'.\yii\helpers\Url::to('../admin/spec').'";']
    );
?>
