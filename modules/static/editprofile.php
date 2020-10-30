<?php

if (isset($_SESSION['user'])) {

	if (isset($_POST['submit'])) {

		$photo = upload(1, 100, 100);

		if ($photo) {
			q("
				UPDATE `users` SET
				`age` 		= '".$_POST['age']."',
				`photo` 	= '".$photo."'
				WHERE `id` = ".(int)$_SESSION['user']['id']."
			");
			$_SESSION['user']['photo'] = $photo;
			$_SESSION['user']['age'] = $_POST['age'];
		} else {
			q("
				UPDATE `users` SET
				`age` 		= '".$_POST['age']."'
				WHERE `id` = ".(int)$_SESSION['user']['id']."
			");
			$_SESSION['user']['age'] = $_POST['age'];
		}

		if (isset($_POST['auto_auth']) && $_POST['auto_auth'] == 'on') {
			setcookie('auto_auth', 'on', time() + 3600*24*30*12, '/');
			setcookie('id', $_SESSION['user']['id'], time() + 3600*24*30*12, '/');
			setcookie('hash', $_SESSION['user']['hash'], time() + 3600*24*30*12, '/');

			header("Location: /static/editprofile");
			exit();
		}

		if (isset($_POST['auto_auth']) && $_POST['auto_auth'] == 'off') {
			setcookie('auto_auth', '', time() - 3600*24*30*12, '/');
			unset($_COOKIE['auto_auth']);
			setcookie('id', '' , time() - 3600*24*30*12, '/');
			setcookie('hash', '' , time() - 3600*24*30*12, '/');

			header("Location: /static/editprofile");
			exit();
		}
	}

} else {
	header("Location: /errors/404");
	exit();
}