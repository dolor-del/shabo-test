<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
		SELECT *
		FROM `goods_cat`
		");

$res2 = q("
		SELECT *
		FROM `distributors`
		");

if (isset($_POST['ok']) && isset($_POST['ids'])) {

	foreach($_POST['ids'] as $k => $v) {
		$k = (int)$v;
	}

} elseif (isset($_POST['ok']) && !isset($_POST['ids'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одного поставщика!';
	$_SESSION['flag'] = false;
}

if(isset($_POST['category'], $_POST['name'], $_POST['manufacturer'], $_POST['article'], $_POST['short_description'], $_POST['description'], $_POST['price'], $_POST['ok'])) {

	$img = upload(1, 250, 250);

	$errors = array();

	if (empty($_POST['category'])) {
		$errors['category'] = 'Выберите категорию!';
	}

	if (empty($_POST['name'])) {
		$errors['name'] = 'Заполните наименование!';
	}

	if (empty($_POST['manufacturer'])) {
		$errors['manufacturer'] = 'Заполните поле производителя!';
	}

	if (empty($_POST['article'])) {
		$errors['article'] = 'Заполните артикул!';
	}

	if (empty($_POST['short_description'])) {
		$errors['short_description'] = 'Заполните описание!';
	}

	if (empty($_POST['description'])) {
		$errors['description'] = 'Заполните описание!';
	}

	if (empty($_POST['price']) || !is_numeric($_POST['price'])) {
		$errors['price'] = 'Пустая или неверная цена!';
	}

	if(!count($errors)) {
		if ($img) {
			$res = q("
			SELECT `id`
			FROM `goods_cat`
			WHERE `name` = '".es($_POST['category'])."'
			");

			if ($row = $res->fetch_assoc()) {
				q("
					INSERT INTO `goods` SET
					`category` 			= '".es($_POST['category'])."',
					`category_id` 		= '".(int)$row['id']."',
					`name` 				= '".es($_POST['name'])."',
					`manufacturer` 		= '".es($_POST['manufacturer'])."',
					`article` 			= '".es($_POST['article'])."',
					`short_description` = '".es($_POST['short_description'])."',
					`description`	 	= '".es($_POST['description'])."',
					`price` 			= ".(float)$_POST['price'].",
					`date_add` 			= NOW(),
					`img` 				= '".$img."'
				");

				$idNewItem = DB::_()->insert_id;

				foreach ($_POST['ids'] as $v) {
					$text[] = '('.$idNewItem.','.$v.')';
				}

				$text2 = implode(', ', $text);

				q("
				INSERT INTO `distributors2goods` (good_id, distributor_id ) VALUES
				".$text2."
				");

				$_SESSION['info'] = 'Товар был добавлен!';
				$_SESSION['flag'] = true;
				header('Location: /admin/goods');
				exit();
			} else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/goods');
				exit();
			}

		} else {
			$res = q("
			SELECT `id`
			FROM `goods_cat`
			WHERE `name` = '".es($_POST['category'])."'
			");

			if ($row = $res->fetch_assoc()) {
				q("
					INSERT INTO `goods` SET
					`category` 			= '".es($_POST['category'])."',
					`category_id` 		= '".(int)$row['id']."',
					`name` 				= '".es($_POST['name'])."',
					`manufacturer` 		= '".es($_POST['manufacturer'])."',
					`article` 			= '".es($_POST['article'])."',
					`short_description` = '".es($_POST['short_description'])."',
					`description`	 	= '".es($_POST['description'])."',
					`price` 			= ".(float)$_POST['price'].",
					`date_add` 			= NOW()
				");

				$idNewItem = DB::_()->insert_id;

				foreach ($_POST['ids'] as $v) {
					$text[] = '('.$idNewItem.','.$v.')';
				}

				$text2 = implode(', ', $text);

				q("
				INSERT INTO `distributors2goods` (good_id, distributor_id ) VALUES
				".$text2."
				");

				$_SESSION['info'] = 'Товар был добавлен!';
				$_SESSION['flag'] = true;
				header('Location: /admin/goods');
				exit();
			} else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/goods');
				exit();
			}
		}
	}
}