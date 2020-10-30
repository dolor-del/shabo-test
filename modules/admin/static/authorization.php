<?php

if (isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) {
	header("Location: /admin/static");
	exit();
}

if(isset($_POST['login'], $_POST['pass'])) {
	$errors = array();

	if(empty($_POST['login'])) {
		$errors['login'] = 'Empty username!';
	}

	if(empty($_POST['pass'])) {
		$errors['pass'] = 'Empty password!';
	}

	if (!count($errors)) {
		$res = q("SELECT *
				FROM `users`
				WHERE `login` = '".es($_POST['login'])."'
				AND `password` = '".myHash($_POST['pass'])."'
				OR `email` = '".es($_POST['login'])."'
				AND `password` = '".myHash($_POST['pass'])."'
				LIMIT 1
				");

		if (mysqli_num_rows($res)) {
			$_SESSION['user'] = mysqli_fetch_assoc($res);

			header("Location: /admin/static/main");
			exit();
		} else {
			$errors['login'] = 'Неправильный логин или пароль!';
			$errors['pass'] = 'Неправильный логин или пароль!';
		}
	}

}