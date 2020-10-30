<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
SELECT *
FROM `news`
WHERE `id` = ".(int)$_GET['id']."
LIMIT 1
");

if(!$res->num_rows) {
	$_SESSION['info'] = 'Данной новости не существует!';
	$_SESSION['flag'] = false;
	$res->close();
	header('Location: /admin/news');
	exit();
}

$row = $res->fetch_assoc();
$res->close();

$res2 = q("
		SELECT *
		FROM `news_cat`
		");

if(isset($_POST['cat'], $_POST['header'], $_POST['subheader'], $_POST['content'], $_POST['ok'])) {

	$img = upload(1, 250, 250);

	$errors = [];

	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Выберите категорию!';
	}

	if(empty($_POST['header'])) {
		$errors['header'] = 'Заполните наименование!';
	}

	if(empty($_POST['subheader'])) {
		$errors['subheader'] = 'Заполните описание!';
	}

	if(empty($_POST['content'])) {
		$errors['content'] = 'Заполните описание!';
	}

	if(!count($errors)) {

		if($img) {
			$res = q("
			SELECT `id`
			FROM `news_cat`
			WHERE `name` = '".es($_POST['cat'])."'
			");

			if($row = $res->fetch_assoc()) {
				q("
					UPDATE `news` SET
					`cat` 		= '".es($_POST['cat'])."',
					`cat_id` 	= '".$row['id']."',
					`header` 	= '".es($_POST['header'])."',
					`subheader` = '".es($_POST['subheader'])."',
					`content`	= '".es($_POST['content'])."',
					`date_add` 	= NOW(),
					`img` 		= '".$img."'
					WHERE `id` = ".(int)$_GET['id']."
				");

				$_SESSION['info'] = 'Новость была изменена!';
				$_SESSION['flag'] = true;
				header('Location: /admin/news');
				exit();
			}
			else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/news');
				exit();
			}
		}
		else {
			$res = q("
			SELECT `id`
			FROM `news_cat`
			WHERE `name` = '".es($_POST['cat'])."'
			");

			if($row = $res->fetch_assoc()) {
				q("
					UPDATE `news` SET
					`cat` 		= '".es($_POST['cat'])."',
					`cat_id` 	= '".$row['id']."',
					`header` 	= '".es($_POST['header'])."',
					`subheader` = '".es($_POST['subheader'])."',
					`content`	= '".es($_POST['content'])."',
					`date_add` 	= NOW()
					WHERE `id` = ".(int)$_GET['id']."
				");

				$_SESSION['info'] = 'Новость была изменена!';
				$_SESSION['flag'] = true;
				header('Location: /admin/news');
				exit();
			}
			else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/news');
				exit();
			}
		}
	}
}

if(isset($_POST['cat'])) {
	$row['cat'] = $_POST['cat'];
}

if(isset($_POST['header'])) {
	$row['header'] = $_POST['header'];
}

if(isset($_POST['subheader'])) {
	$row['subheader'] = $_POST['subheader'];
}

if(isset($_POST['content'])) {
	$row['content'] = $_POST['content'];
}
