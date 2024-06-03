<?php

$listMap = "";
foreach ($dates as $l){
	$el = "<div class='com-card'>";
	$specName = $l['userID']['last_name'] . ' ' . $l['userID']['first_name'] . ' ' . $l['userID']['father_name'];
	$uch = $l['regID']['title'];
	$gx = $l['time_write'];
	
	$el .= "<h6>Пациент: {$specName}</h6>";
	$el .= "<h6>Участок: {$uch}</h6>";
	$el .= "<h6>Время записи: {$gx}</h6>";
	$el .= "<button class = 'btn out-btn' onclick='localStorage.setItem(`123`. `123`)'>Принять</buttom>";
	$el .= "<button class = 'btn btn-outline-danger'>Не явился</buttom>";
	$el .= "</div>";
	
	$listMap .= $el;
}
?>

<h1>Список записавшихся на сегодня</h1>

<?= $listMap ?>

