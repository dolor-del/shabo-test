<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
		SELECT *
		FROM `news_cat`
		");

if(isset($_POST['cat'], $_POST['header'], $_POST['subheader'], $_POST['content'], $_POST['ok'])) {

	$img = upload(1, 250, 250);

	$errors = array();

	if (empty($_POST['cat'])) {
		$errors['cat'] = 'Выберите категорию!';
	}

	if (empty($_POST['header'])) {
		$errors['header'] = 'Заполните заголовок!';
	}

	if (empty($_POST['subheader'])) {
		$errors['subheader'] = 'Заполните подзаголовок!';
	}

	if (empty($_POST['content'])) {
		$errors['content'] = 'Заполните содержание!';
	}

	if(!count($errors)) {

		if ($img) {
			$res = q("
			SELECT `id`
			FROM `news_cat`
			WHERE `name` = '".es($_POST['cat'])."'
			");

			if ($row = $res->fetch_assoc()) {
				q("
					INSERT INTO `news` SET
					`cat` 		= '".es($_POST['cat'])."',
					`cat_id` 	= '".(int)$row['id']."',
					`header` 	= '".es($_POST['header'])."',
					`subheader` = '".es($_POST['subheader'])."',
					`content`	= '".es($_POST['content'])."',
					`date_add` 	= NOW(),
					`img` 		= '".$img."'
				");

				$_SESSION['info'] = 'Новость была добавлена!';
				$_SESSION['flag'] = true;
				header('Location: /admin/news');
				exit();
			} else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/news');
				exit();
			}

		} else {
			$res = q("
			SELECT `id`
			FROM `news_cat`
			WHERE `name` = '".es($_POST['cat'])."'
			");

			if ($row = $res->fetch_assoc()) {
				q("
					INSERT INTO `news` SET
					`cat` 		= '".es($_POST['cat'])."',
					`cat_id` 	= '".$row['id']."',
					`header` 	= '".es($_POST['header'])."',
					`subheader` = '".es($_POST['subheader'])."',
					`content`	= '".es($_POST['content'])."',
					`date_add` 	= NOW()
				");

				$_SESSION['info'] = 'Новость была добавлена!';
				$_SESSION['flag'] = true;
				header('Location: /admin/news');
				exit();
			} else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/news');
				exit();
			}
		}
	}
}