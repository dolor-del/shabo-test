<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
SELECT *
FROM `goods_cat`
WHERE `id` = ".(int)$_GET['id']."
LIMIT 1
");

if(!$res->num_rows) {
	$_SESSION['info'] = 'Категории не существует!';
	$_SESSION['flag'] = false;
	header('Location: /admin/goods');
	exit();
}

$row = $res->fetch_assoc();

if(isset($_POST['category'], $_POST['ok'])) {

	$errors = array();

	if (empty($_POST['category'])) {
		$errors['category'] = 'Заполните название категории!';
	}

	if(!count($errors)) {

		$res = q("
			SELECT *
			FROM `goods_cat`
			WHERE `name` 	= '".es($_POST['category'])."'
		");

		if ($row = $res->fetch_assoc()) {
			$_SESSION['info'] = 'Такая категория уже существует!';
			$_SESSION['flag'] = false;
			header('Location: /admin/goods');
			exit();
		} else {
			q("
			UPDATE `goods_cat` SET
			`name` 	= '".es($_POST['category'])."'
			WHERE `id` = ".(int)$_GET['id']."
			");

			q("
			UPDATE `goods` SET
			`category` 	= '".es($_POST['category'])."'
			WHERE `category_id` = ".(int)$_GET['id']."
			");

			$_SESSION['info'] = 'Категория была изменена!';
			$_SESSION['flag'] = true;
			header('Location: /admin/goods');
			exit();
		}
	}

}

if(isset($_POST['category'])) {
	$row['category'] = $_POST['category'];
}