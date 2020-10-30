<?php

if (isset($_GET['key2'], $_GET['key1'])) {
	$res = q("
	SELECT * 
	FROM `users`
	WHERE `id` = ".(int)$_GET['key1']."
	AND `hash` = '".es($_GET['key2'])."'
	LIMIT 1
	");
	if (mysqli_num_rows($res)) {
		$row = mysqli_fetch_assoc($res);
		q("
		UPDATE `users` SET
		`active` = 1,
		`hash` = '".myHash($row['id'].$row['login'].$row['email'])."'
		WHERE `id` = ".(int)$_GET['key1']."
		AND `hash` = '".es($_GET['key2'])."'
		LIMIT 1
		");
		$info = 'Поздравляем, '.$row['login'].'! Ваша почта была успешно подтверждена. Добро пожаловать на наш сайт!';
	} else {
		header("Location: /errors/404");
		exit();
	}
} else {
	header("Location: /errors/404");
	exit();
}