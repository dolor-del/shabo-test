<?php

$res = q("SELECT * FROM `news_cat` ORDER BY `id`");
$res2 = q("SELECT * FROM `news` ORDER BY `date_add` DESC");

if(!$res->num_rows) {
	$no_cat = 'Список категорий пуст!';
}

if(!$res2->num_rows) {
	$no_news = 'Список новостей пуст!';
}

if (isset($_POST['del_marks_cat'], $_POST['ids_cat'])) {

	foreach($_POST['ids_cat'] as $k => $v) {
		$k = (int)$v;
	}

	$idsCat = implode(',', $_POST['ids_cat']);

	q("
	DELETE FROM `news_cat`
	WHERE `id` IN (".$idsCat.")
	");

	q("
	UPDATE `news` SET
	`cat`	 = '-',
	`cat_id` = 0
	WHERE `cat_id` IN (".$idsCat.")
	");

	$_SESSION['info'] = 'Выбранные категории были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/news');
	exit();

} elseif (isset($_POST['del_marks_cat']) && !isset($_POST['ids_cat'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одной категории!';
	$_SESSION['flag'] = false;
}

if (isset($_POST['del_marks'], $_POST['ids'])) {

	foreach($_POST['ids'] as $k => $v) {
		$k = (int)$v;
	}

	$idsNews = implode(',', $_POST['ids']);

	q("
	DELETE FROM `news`
	WHERE `id` IN (".$idsNews.")
	");

	$_SESSION['info'] = 'Выбранные новости были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/news');
	exit();

} elseif (isset($_POST['del_marks']) && !isset($_POST['ids'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одной новости!';
	$_SESSION['flag'] = false;
}

if (isset($_GET['from'], $_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {

	if ($_GET['from'] == 'cat') {
		q("
		DELETE FROM `news_cat`
		WHERE `id` = ".(int)$_GET['id']."
		");
		q("
		UPDATE `news` SET
		`cat`	 = '-',
		`cat_id` = 0
		WHERE `cat_id` = ".(int)$_GET['id']."
		");
		$_SESSION['info'] = 'Категория была удалена!';
		$_SESSION['flag'] = true;
		header('Location: /admin/news');
		exit();
	} elseif ($_GET['from'] == 'news') {
		q("
		DELETE FROM `news`
		WHERE `id` = ".(int)$_GET['id']."
		");
		$_SESSION['info'] = 'Новость была удалена!';
		$_SESSION['flag'] = true;
		header('Location: /admin/news');
		exit();
	}

}

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	$flag = $_SESSION['flag'];
	unset($_SESSION['info']);
	unset($_SESSION['flag']);
}