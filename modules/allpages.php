<?php

if (isset($_SESSION['user']) && $_SESSION['user']['access'] == 11) {
	header("Location: /errors/404");
	exit();
}

if (isset($_SESSION['user'])) {
	$res = q("SELECT *
			FROM `users`
			WHERE `id` = '".(int)$_SESSION['user']['id']."'
			LIMIT 1
			");

	if (mysqli_num_rows($res)) {
		$_SESSION['user'] = mysqli_fetch_assoc($res);
	}

	q("UPDATE `users` SET
	`date_last_act` = NOW()
	WHERE `id` = '".(int)$_SESSION['user']['id']."'
	");
} elseif (isset($_COOKIE['id'], $_COOKIE['hash'])) {
	$res = q("SELECT *
			FROM `users`
			WHERE `id` = '".(int)$_COOKIE['id']."'
			AND `hash` = '".es($_COOKIE['hash'])."'
			LIMIT 1
			");

	if (mysqli_num_rows($res)) {
		$_SESSION['user'] = mysqli_fetch_assoc($res);
	} else {
		setcookie('id', '' , time() - 3600*24*30*12);
		setcookie('hash', '' , time() - 3600*24*30*12);
	}
}