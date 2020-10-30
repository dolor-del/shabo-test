<?php

if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header("Location: /errors/404");
	exit();
}

if (isset($_POST['delete'])) {
	q("DELETE FROM `users`
	WHERE `id` = ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Пользователь был удален!';
	$_SESSION['flag'] = true;

	header("Location: /admin/users");
}

$res = q("SELECT * FROM `users`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
		");

$row = mysqli_fetch_assoc($res);

if(isset($_POST['login']) || isset($_POST['password']) || isset($_POST['email']) || isset($_POST['search'])) {
	$errors = [];

	if(empty($_POST['login'])) {
		$errors['login'] = 'Empty or invalid username!';
	}
	elseif(mb_strlen($_POST['login']) < 2) {
		$errors['login'] = 'Username is too short!';
	}
	elseif(mb_strlen($_POST['login']) > 16) {
		$errors['login'] = 'Username is too long!';
	}

	if ($_POST['password'] == '') {

		if (!count($errors)) {

			if (isset($_POST['edit'])) {

				if ($_POST['rights'] == 'open') {
					q("UPDATE `users` SET 
				`login` = '".es($_POST['login'])."',
				`access` = 1,
				`email` = '".es($_POST['email'])."'
				WHERE `id` = ".(int)$_GET['id']."
				");
				} elseif ($_POST['rights'] == 'ban') {
					q("UPDATE `users` SET 
				`login` = '".es($_POST['login'])."',
				`access` = 11,
				`email` = '".es($_POST['email'])."'
				WHERE `id` = ".(int)$_GET['id']."
				");
				}
			}

			$_SESSION['info'] = 'Изменения были сохранены!';
			$_SESSION['flag'] = true;

			header("Location: /admin/users");
		}
	} else {

		if(mb_strlen($_POST['password']) < 5) {
			$errors['password'] = 'The password must contain at least 4 characters!';
		}

		if (!count($errors)) {

			if (isset($_POST['edit'])) {

				if ($_POST['rights'] == 'open') {
					q("UPDATE `users` SET 
				`login` = '".es($_POST['login'])."',
				`password` = '".myHash($_POST['password'])."',
				`access` = 1,
				`email` = '".es($_POST['email'])."'
				WHERE `id` = ".(int)$_GET['id']."
				");
				} elseif ($_POST['rights'] == 'ban') {
					q("UPDATE `users` SET 
				`login` = '".es($_POST['login'])."',
				`password` = '".myHash($_POST['password'])."',
				`access` = 11,
				`email` = '".es($_POST['email'])."'
				WHERE `id` = ".(int)$_GET['id']."
				");
				}
			}

			$_SESSION['info'] = 'Изменения были сохранены!';
			$_SESSION['flag'] = true;

			header("Location: /admin/users");
		}
	}
}