<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
SELECT *
FROM `distributors`
WHERE `id` = ".(int)$_GET['id']."
LIMIT 1
");

if(!$res->num_rows) {
	$_SESSION['info'] = 'Поставщика не существует!';
	$_SESSION['flag'] = false;
	header('Location: /admin/distributors');
	exit();
}

$row = $res->fetch_assoc();
$res->close();

$temp = $row['name'];

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
			SELECT *
			FROM `distributors`
			WHERE `name` 	= '".es($_POST['name'])."'
		");

		if ($row = $res->fetch_assoc()) {
			$res->close();

			if ($temp == $_POST['name']) {
				q("
				UPDATE `distributors` SET
				`name` 			= '".es($_POST['name'])."',
				`description` 	= '".es($_POST['description'])."'
				WHERE `id` = ".(int)$_GET['id']."
				");

				$_SESSION['info'] = 'Информация о поставщике была изменена!';
				$_SESSION['flag'] = true;
				header('Location: /admin/distributors');
				exit();
			} else {
				$_SESSION['info'] = 'Такой поставщик уже существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/distributors');
				exit();
			}

		} else {
			$res->close();

			q("
			UPDATE `distributors` SET
			`name` 			= '".es($_POST['name'])."',
			`description` 	= '".es($_POST['description'])."'
			WHERE `id` = ".(int)$_GET['id']."
			");

			/*q("
			UPDATE `goods` SET
			`cat` 	= '".es($_POST['cat'])."'
			WHERE `cat_id` = ".(int)$_GET['id']."
			");*/

			$_SESSION['info'] = 'Информация о поставщике была изменена!';
			$_SESSION['flag'] = true;
			header('Location: /admin/distributors');
			exit();
		}
	}

}

if(isset($_POST['name'])) {
	$row['name'] = $_POST['name'];
}

if(isset($_POST['description'])) {
	$row['description'] = $_POST['description'];
}