<?php

$res = q("
		SELECT *
		FROM `news_cat`
		ORDER BY `id`
		");

if (isset($_GET['category'])) {

	Paginator::$table = 'news';
	$strInBuilder = 'WHERE `cat` = \''.$_GET['category'].'\'';
	$resText = Paginator::builder($strInBuilder, $_GET['category']);
	$strInQ = 'WHERE `cat` = \''.$_GET['category'].'\'';
	$res2 = Paginator::Q($strInQ);

} else {

	Paginator::$table = 'news';
	$resText = Paginator::builder();
	$res2 = Paginator::Q();

}