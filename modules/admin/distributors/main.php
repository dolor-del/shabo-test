<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("SELECT * FROM `distributors` ORDER BY `id`");

if(!mysqli_num_rows($res)) {
	$no_goods = 'Список поставщиков пуст!';
}

if (isset($_POST['del_marks']) && isset($_POST['ids'])) {

	foreach($_POST['ids'] as $k => $v) {
		$k = (int)$v;
	}

	$ids = implode(',', $_POST['ids']);

	q("
	DELETE FROM `distributors`
	WHERE `id` IN (".$ids.")
	");

	q("
	DELETE FROM `distributors2goods`
	WHERE `distributor_id` IN (".$ids.")
	");

	$_SESSION['info'] = 'Выбранные поставщики были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/distributors');
	exit();

} elseif (isset($_POST['del_marks']) && !isset($_POST['ids'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одного поставщика!';
	$_SESSION['flag'] = false;
}

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {
	q("
	DELETE FROM `distributors`
	WHERE `id` = ".(int)$_GET['id']."
	");

	q("
	DELETE FROM `distributors2goods`
	WHERE `distributor_id` = ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Поставщик был удален!';
	$_SESSION['flag'] = true;
	header('Location: /admin/distributors');
	exit();
}

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	$flag = $_SESSION['flag'];
	unset($_SESSION['info']);
	unset($_SESSION['flag']);
}