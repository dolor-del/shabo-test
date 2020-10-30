<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("SELECT * FROM `goods_cat` ORDER BY `id`");
$res2 = q("SELECT * FROM `goods` ORDER BY `date_add` DESC");

if(!$res->num_rows) {
	$no_cat = 'Список категорий пуст!';
}

if(!$res2->num_rows) {
	$no_goods = 'Список товаров пуст!';
}

if (isset($_POST['del_marks_cat']) && isset($_POST['ids_cat'])) {

	foreach($_POST['ids_cat'] as $k => $v) {
		$k = (int)$v;
	}

	$idsCat = implode(',', $_POST['ids_cat']);

	q("
	DELETE FROM `goods_cat`
	WHERE `id` IN (".$idsCat.")
	");

	q("
	UPDATE `goods` SET
	`category`	 = '-',
	`category_id` = 0
	WHERE `category_id` IN (".$idsCat.")
	");

	$_SESSION['info'] = 'Выбранные категории были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/goods');
	exit();

} elseif (isset($_POST['del_marks_cat']) && !isset($_POST['ids_cat'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одной категории!';
	$_SESSION['flag'] = false;
}

if (isset($_POST['del_marks']) && isset($_POST['ids'])) {

	foreach($_POST['ids'] as $k => $v) {
		$k = (int)$v;
	}

	$ids = implode(',', $_POST['ids']);

	q("
	DELETE FROM `goods`
	WHERE `id` IN (".$ids.")
	");

	q("
	DELETE FROM `distributors2goods`
	WHERE `good_id` IN (".$ids.")
	");

	$_SESSION['info'] = 'Выбранные товары были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/goods');
	exit();

} elseif (isset($_POST['del_marks']) && !isset($_POST['ids'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одного товара!';
	$_SESSION['flag'] = false;
}

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {

	if ($_GET['from'] == 'category') {
		q("
		DELETE FROM `goods_cat`
		WHERE `id` = ".(int)$_GET['id']."
		");
		q("
		UPDATE `goods` SET
		`category`	 = '-',
		`category_id` = 0
		WHERE `category_id` = ".(int)$_GET['id']."
		");
		$_SESSION['info'] = 'Категория была удалена!';
		$_SESSION['flag'] = true;
		header('Location: /admin/goods');
		exit();
	} elseif ($_GET['from'] == 'goods') {
		q("
		DELETE FROM `goods`
		WHERE `id` = ".(int)$_GET['id']."
		");

		q("
		DELETE FROM `distributors2goods`
		WHERE `good_id` = ".(int)$_GET['id']."
		");

		$_SESSION['info'] = 'Товар был удален!';
		$_SESSION['flag'] = true;
		header('Location: /admin/goods');
		exit();
	}
}

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	$flag = $_SESSION['flag'];
	unset($_SESSION['info']);
	unset($_SESSION['flag']);
}