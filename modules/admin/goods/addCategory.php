<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
		SELECT *
		FROM `goods_cat`
		");

if(isset($_POST['category'], $_POST['ok'])) {

	$errors = array();

	if (empty($_POST['category'])) {
		$errors['category'] = 'Заполните название категории!';
	}

	if(!count($errors)) {

		$res = q("
			SELECT `name`
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
			INSERT INTO `goods_cat` SET
			`name` 	= '".es($_POST['category'])."'
			");

			$_SESSION['info'] = 'Категория была добавлена!';
			$_SESSION['flag'] = true;
			header('Location: /admin/goods');
			exit();
		}
	}

}