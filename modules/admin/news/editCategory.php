<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
SELECT *
FROM `news_cat`
WHERE `id` = ".(int)$_GET['id']."
LIMIT 1
");

if(!$res->num_rows) {
	$_SESSION['info'] = 'Категории не существует!';
	$_SESSION['flag'] = false;
	header('Location: /admin/news');
	exit();
}

$row = $res->fetch_assoc();

if(isset($_POST['cat'], $_POST['ok'])) {

	$errors = array();

	if (empty($_POST['cat'])) {
		$errors['cat'] = 'Заполните название категории!';
	}

	if(!count($errors)) {

		$res = q("
			SELECT *
			FROM `news_cat`
			WHERE `name` 	= '".es($_POST['cat'])."'
		");

		if ($row = $res->fetch_assoc()) {
			$_SESSION['info'] = 'Такая категория уже существует!';
			$_SESSION['flag'] = false;
			header('Location: /admin/news');
			exit();
		} else {
			q("
			UPDATE `news_cat` SET
			`name` 	= '".es($_POST['cat'])."'
			WHERE `id` = ".(int)$_GET['id']."
			");

			q("
			UPDATE `news` SET
			`cat` 	= '".es($_POST['cat'])."'
			WHERE `cat_id` = ".(int)$_GET['id']."
			");

			$_SESSION['info'] = 'Категория была изменена!';
			$_SESSION['flag'] = true;
			header('Location: /admin/news');
			exit();
		}
	}

}

if(isset($_POST['cat'])) {
	$row['cat'] = $_POST['cat'];
}