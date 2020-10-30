<?php

if (isset($_GET['route'])) {
	$temp = explode('/', $_GET['route']);

	if ($temp[0] == 'admin') {
		Core::$SKIN = 'admin';
		Core::$CONT = Core::$CONT.'/admin';
		unset($temp[0]);
	}

	$i = 0;
	foreach($temp as $k => $v) {
		if ($i == 0) {
			if (!empty($v)) {
				$_GET['module'] = $v;
			}
		} elseif ($i == 1) {
			if (!empty($v)) {
				$_GET['page'] = $v;
			}
		} else {
			$_GET['key'.($i-1)] = $v;
		}
		++$i;
	}
	unset($_GET['route']);
}


if(!isset($_GET['module'])) {
	$_GET['module'] = 'static';
} else {
	$res = q("
			SELECT *
			FROM `pages`
			WHERE `module` = '".es($_GET['module'])."'
			LIMIT 1
			");
	if (!mysqli_num_rows($res)) {
		header("Location: /404");
		exit();
	} else {
		$staticpage = mysqli_fetch_assoc($res);
		if ($staticpage['static'] == 1) {
			$_GET['module'] = 'staticpage';
			$_GET['page'] = 'main';
		}
	}
}

if(!isset($_GET['page'])) {
	$_GET['page'] = 'main';
}

if (!preg_match('#^[a-z-_]*$#iu', $_GET['page'])) {
	header("Location: /404");
	exit();
}

// КОСТЫЛЬ!!!
if(isset($_GET['start_over']) || isset($_GET['input_number'])) {
	$_GET['page'] = 'game';
}

if(isset($_GET['link'])) {
	$_GET['page'] = 'file_system';
}
