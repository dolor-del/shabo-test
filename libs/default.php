<?php

/*
ALIAS:
q(); Запрос
es(); mysqli_real_escape_string

РАБОТА С ОБЪЕКТОМ ВЫБОРКИ
$res = q(); // Запрос с возвратом результата
$res->num_rows; // Количество возвращенных строк - mysqli_num_rows();
$res->fetch_assoc(); // достаём запись - mysqli_fetch_assoc();
$res->close(); // Очищаем результат выборки

РАБОТА С ПОДКЛЮЧЕННОЙ MYSQL
DB::_()->affected_rows; // Количество изменённых записей
DB::_()->insert_id; // Последний ID вставки
DB::_()->real_escape_string(); // аналог es();
DB::_()->query(); // аналог q
DB::_()->multi_ query(); // Множественные запросы

DB::close(); // Закрываем соединение с БД
*/

class DB {
	public static $mysqli = array();
	public static $connect = array();

	public static function _($key = 0) {
		if(!isset(self::$mysqli[$key])) {
			if(!isset(self::$connect['server']))
				self::$connect['server'] = Core::$DB_LOCAL;
			if(!isset(self::$connect['user']))
				self::$connect['user'] = Core::$DB_LOGIN;
			if(!isset(self::$connect['pass']))
				self::$connect['pass'] = Core::$DB_PASS;
			if(!isset(self::$connect['db']))
				self::$connect['db'] = Core::$DB_NAME;

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

function wtf ($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

function trimAll ($el) {
	if (is_array($el)) {
		$el = array_map('trimAll', $el);
	} else {
		$el = trim($el);
	}
	return $el;
}

function intAll ($el) {
	if (is_array($el)) {
		$el = array_map('intAll', $el);
	} else {
		$el = (int)$el;
	}
	return $el;
}

function floatAll ($el) {
	if (is_array($el)) {
		$el = array_map('floatAll', $el);
	} else {
		$el = (float)$el;
	}
	return $el;
}

function hc ($el) {
	if (is_array($el)) {
		$el = array_map('hc', $el);
	} else {
		$el = htmlspecialchars($el);
	}
	return $el;
}

spl_autoload_register(function ($class) {
	include './libs/class_'.$class.'.php';
});

function myHash ($var) {
	$salt1 = 'ABC';
	$salt2 = 'CBA';
	$var = crypt(md5($var.$salt1), $salt2);
	return $var;
}

function upload($resize = false, $w = 0, $h = 0){
	$array1 = ['image/gif', 'image/jpeg', 'image/png'];
	$array2 = ['jpg', 'jpeg', 'gif', 'png'];

	if ($_FILES['file']['error'] == 0) {
		if ($_FILES['file']['size'] > 52428800) {
			$info_error = 'Размер изображения не должен превышать 50Мб.';
		} else {
			preg_match('#\.([a-z]+)$#iu', $_FILES['file']['name'], $matches);
			if (isset($matches[1])) {
				$end = mb_strtolower($matches[1]);

				$temp = getimagesize($_FILES['file']['tmp_name']);
				$name = '/uploaded/'.date('Ymd-His').'img'.rand(10000, 99999).'.'.$end;

				if (!in_array($end, $array2)) {
					$info_error = 'Расширение изображения не подходит.';
				} elseif(!in_array($temp['mime'], $array1)) {
					$info_error = 'Тип файла не подходит (можно загружать только изображения).';
				} elseif(!move_uploaded_file($_FILES['file']['tmp_name'], '.'.$name)) {
					$info_error = 'Ошибка! Изображение не загружено.';
				} else {

					if ($resize == true) {

						$r = $temp[0] / $temp[1];

						if($w / $h > $r) {
							$newwidth = $h * $r;
							$newheight = $h;
						}
						else {
							$newheight = $w / $r;
							$newwidth = $w;
						}

						if ($temp['mime'] == 'image/jpeg') {
							$src = imagecreatefromjpeg('.'.$name);
						} elseif($temp['mime'] == 'image/png') {
							$src = imagecreatefrompng('.'.$name);
						} elseif($temp['mime'] == 'image/gif') {
							$src = imagecreatefromgif('.'.$name);
						}

						$tmp = imagecreatetruecolor($newwidth, $newheight);
						imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $temp[0], $temp[1]);
						imagejpeg($tmp, '.'.$name, 100);
						imagedestroy($tmp);
					}
				}
			} else {
				$info_error = 'Данный файл не является изображением. Принимаемые типы файлов: jpg, png, gif.';
			}
		}
	}

	if (isset($info_error)) {
		return 0;
	} elseif (isset($name)){
		return $name;
	}
}