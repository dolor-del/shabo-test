<?php

if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

if (isset($_POST['search']) && $_POST['search'] != '') {
	$res = q("SELECT * FROM `users`
	WHERE `login` LIKE '%".es($_POST['search'])."%'
	ORDER BY `login`");
} else {
	$res = q("SELECT * FROM `users` ORDER BY `login`");
}

if(!mysqli_num_rows($res)) {
	$no_users = 'Список пользователей пуст';
}

if(isset($_POST['del_marks']) && isset($_POST['ids'])) {

	foreach($_POST['ids'] as $k => $v) {
		$k = (int)$v;
	}

	$ids = implode(',', $_POST['ids']);

	q("
	DELETE FROM `users`
	WHERE `id` IN (".$ids.")
	");

	$_SESSION['info'] = 'Выбранные пользователи были удалены!';
	$_SESSION['flag'] = true;
	header('Location: /admin/users');
	exit();
} elseif (isset($_POST['del_marks']) && !isset($_POST['ids'])) {
	$_SESSION['info'] = 'Вы не выбрали ни одного пользователя!';
	$_SESSION['flag'] = false;
}

if(isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {
	q("
	DELETE FROM `users`
	WHERE `id` = ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Пользователь был удален!';
	$_SESSION['flag'] = true;
	header('Location: /admin/users');
	exit();
}

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	$flag = $_SESSION['flag'];
	unset($_SESSION['info']);
	unset($_SESSION['flag']);
}