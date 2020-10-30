<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

$res = q("
SELECT *
FROM `goods`
WHERE `id` = ".(int)$_GET['id']."
LIMIT 1
");

if(!$res->num_rows) {
	$_SESSION['info'] = 'Товара не существует!';
	$_SESSION['flag'] = false;
	$res->close();
	header('Location: /admin/goods');
	exit();
}

$row = $res->fetch_assoc();
$res->close();

$res2 = q("
		SELECT *
		FROM `goods_cat`
		");

$res3 = q("
		SELECT *
		FROM `distributors2goods`
		WHERE `good_id` = ".(int)$_GET['id']."
		");

while($row3 = $res3->fetch_assoc()) {
	$idsDistributors[] = $row3['distributor_id'];
}
$res3->close();

$res4 = q("
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

		if($img) {
			$res = q("
			SELECT `id`
			FROM `goods_cat`
			WHERE `name` = '".es($_POST['category'])."'
			");

			if($row = $res->fetch_assoc()) {
				q("
					UPDATE `goods` SET
					`category` 			= '".es($_POST['category'])."',
					`category_id` 		= '".(int)$row['id']."',
					`name` 				= '".es($_POST['name'])."',
					`manufacturer` 		= '".es($_POST['manufacturer'])."',
					`article` 			= '".es($_POST['article'])."',
					`short_description` = '".es($_POST['short_description'])."',
					`description`	 	= '".es($_POST['description'])."',
					`price` 			= ".(float)$_POST['price'].",
					`date_edit` 		= NOW(),
					`img` 				= '".$img."'
					WHERE `id` = ".(int)$_GET['id']."
				");

				q("
					DELETE FROM `distributors2goods`
					WHERE `good_id` = ".(int)$_GET['id']."
				");

				foreach ($_POST['ids'] as $v) {
					$text[] = '('.(int)$_GET['id'].','.$v.')';
				}

				$text2 = implode(', ', $text);

				q("
				INSERT INTO `distributors2goods` (good_id, distributor_id )
				VALUES ".$text2."
				");

				$_SESSION['info'] = 'Товар был изменен!';
				$_SESSION['flag'] = true;
				header('Location: /admin/goods');
				exit();
			}
			else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/goods');
				exit();
			}
		}
		else {
			$res = q("
			SELECT `id`
			FROM `goods_cat`
			WHERE `name` = '".es($_POST['category'])."'
			");

			if($row = $res->fetch_assoc()) {
				q("
					UPDATE `goods` SET
					`category` 			= '".es($_POST['category'])."',
					`category_id` 		= '".(int)$row['id']."',
					`name` 				= '".es($_POST['name'])."',
					`manufacturer` 		= '".es($_POST['manufacturer'])."',
					`article` 			= '".es($_POST['article'])."',
					`short_description` = '".es($_POST['short_description'])."',
					`description`	 	= '".es($_POST['description'])."',
					`price` 			= ".(float)$_POST['price'].",
					`date_edit` 		= NOW()
					WHERE `id` = ".(int)$_GET['id']."
				");

				q("
					DELETE FROM `distributors2goods`
					WHERE `good_id` = ".(int)$_GET['id']."
				");

				foreach ($_POST['ids'] as $v) {
					$text[] = '('.(int)$_GET['id'].','.$v.')';
				}

				$text2 = implode(', ', $text);

				q("
				INSERT INTO `distributors2goods` (good_id, distributor_id )
				VALUES ".$text2."
				");

				$_SESSION['info'] = 'Товар был изменен!';
				$_SESSION['flag'] = true;
				header('Location: /admin/goods');
				exit();
			}
			else {
				$_SESSION['info'] = 'Такой категории не существует!';
				$_SESSION['flag'] = false;
				header('Location: /admin/goods');
				exit();
			}
		}
	}
}

if(isset($_POST['category'])) {
	$row['category'] = $_POST['category'];
}

if(isset($_POST['name'])) {
	$row['name'] = $_POST['name'];
}

if(isset($_POST['manufacturer'])) {
	$row['manufacturer'] = $_POST['manufacturer'];
}

if(isset($_POST['article'])) {
	$row['article'] = $_POST['article'];
}

if(isset($_POST['short_description'])) {
	$row['short_description'] = $_POST['short_description'];
}

if(isset($_POST['description'])) {
	$row['description'] = $_POST['description'];
}

if(isset($_POST['price'])) {
	$row['price'] = $_POST['price'];
}