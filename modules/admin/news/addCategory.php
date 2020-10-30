<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
		SELECT *
		FROM `news_cat`
		");

if(isset($_POST['cat'], $_POST['ok'])) {

	$errors = array();

	if (empty($_POST['cat'])) {
		$errors['cat'] = 'Заполните название категории!';
	}

	if(!count($errors)) {

		$res = q("
			SELECT `name`
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
			INSERT INTO `news_cat` SET
			`name` 	= '".es($_POST['cat'])."'
			");

			$_SESSION['info'] = 'Категория была добавлена!';
			$_SESSION['flag'] = true;
			header('Location: /admin/news');
			exit();
		}
	}

}