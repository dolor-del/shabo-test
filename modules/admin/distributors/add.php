<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
		SELECT *
		FROM `distributors`
		");

if(isset($_POST['name'], $_POST['description'], $_POST['ok'])) {

	$errors = array();

	if (empty($_POST['name'])) {
		$errors['name'] = 'Заполните наименование!';
	}

	if (empty($_POST['description'])) {
		$errors['description'] = 'Заполните описание!';
	}

	if(!count($errors)) {

		$res = q("
			SELECT `name`
			FROM `distributors`
			WHERE `name` 	= '".es($_POST['name'])."'
		");

		if ($row = $res->fetch_assoc()) {
			$_SESSION['info'] = 'Такой поставщик уже существует!';
			$_SESSION['flag'] = false;
			header('Location: /admin/distributors');
			exit();
		} else {
			q("
			INSERT INTO `distributors` SET
			`name` 			= '".es($_POST['name'])."',
			`description` 	= '".es($_POST['description'])."'
			");

			$_SESSION['info'] = 'Новый поставщик был добавлен!';
			$_SESSION['flag'] = true;
			header('Location: /admin/distributors');
			exit();
		}
	}

}