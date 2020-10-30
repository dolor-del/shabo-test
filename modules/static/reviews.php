<?php

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['user']) && $_SESSION['user']['active'] != 0) {
	if(isset($_POST['text1'])) {

		$errors = array();

		/*if(empty($_POST['name'])) {
			$errors['name'] = 'Empty or invalid username!';
		}

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Invalid email value!';
		}*/

		if(empty($_POST['text1'])) {
			$errors['text'] = 'Empty comment!';
		}

		if(!count($errors)) {

			class DB {
				public static $mysqli = array();
				public static $connect = array();

				public static function _($key = 0) {
					if(!isset(self::$mysqli[$key])) {
						if(!isset(self::$connect['server']))
							self::$connect['server'] = 'localhost';
						if(!isset(self::$connect['user']))
							self::$connect['user'] = 'dolor';
						if(!isset(self::$connect['pass']))
							self::$connect['pass'] = '1029';
						if(!isset(self::$connect['db']))
							self::$connect['db'] = 'main';

						self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']); // WARNING
						if (mysqli_connect_errno()) {
							echo 'Не удалось подключиться к Базе Данных';
							exit;
						}
						if(!self::$mysqli[$key]->set_charset("utf8")) {
							echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
							exit;
						}
					}
					return self::$mysqli[$key];
				}

				public static function close($key = 0) {
					self::$mysqli[$key]->close();
					unset(self::$mysqli[$key]);
				}
			}

			function q($query,$key = 0) {
				$res = DB::_($key)->query($query);
				if($res === false) {
					$info = debug_backtrace();
					$error = "QUERY: ".$query."<br>\n".DB::_($key)->error."<br>\n".
						"file: ".$info[0]['file']."<br>\n".
						"line: ".$info[0]['line']."<br>\n".
						"date: ".date("Y-m-d H:i:s")."<br>\n".
						"===================================";

					file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
					echo $error;
					exit();
				}
				return $res;
			}

			function es($el,$key = 0) {
				return DB::_($key)->real_escape_string($el);
			}

			$now = date("Y-m-d H:i:s");
			$time = time();

			q("INSERT INTO `comments` SET
			`name` = '".es($_SESSION['user']['login'])."',
			`text` = '".es($_POST['text1'])."',
			`email` = '".es($_SESSION['user']['email'])."',
			`time` = ".$time.",
			`date` = '".$now."'
			");


		}
	}

$res = q("SELECT * FROM `comments` ORDER BY `date` DESC");
$count = $res->num_rows;

} else {
$error_comment_noauth = 1;
}

if (isset($_SESSION['time'])) {
	$res2 = q("
			SELECT *
			FROM `comments`
			WHERE `time` > ".$_SESSION['time']."
			ORDER BY `date` DESC
			");

	$row2 = $res2->fetch_assoc();
}

$_SESSION['time'] = time();

/*foreach($_POST as $k => $v) {
	echo $k.' => '.$v;
}*/

if(isset($_POST['text1'])) {
	$arr = ['name' => $_SESSION['user']['login'], 'text' => $_POST['text1'], 'email' => $_SESSION['user']['email'], 'time' => $time, 'date' => $now, 'row2' => $row2['text']];

	echo json_encode($arr);
}