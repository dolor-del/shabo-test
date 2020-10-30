<?php

$res = q("
		SELECT *
		FROM `goods_cat`
		ORDER BY `id`
		");

if (isset($_GET['category']) ) {

	Paginator::$table = 'goods';
	$strInBuilder = 'WHERE `category` = \''.$_GET['category'].'\'';
	$resText = Paginator::builder($strInBuilder, $_GET['category']);
	$strInQ = 'WHERE `category` = \''.$_GET['category'].'\'';
	$res2 = Paginator::Q($strInQ);

} else {

	$res = q("
		SELECT *
		FROM `goods_cat`
		");

	$res2 = q("
		SELECT *
		FROM `goods`
		ORDER BY `id`
		");
	while($row2 = $res2->fetch_assoc()) {
		$tmp[] = $row2['id'];
	}

	$res3 = q("
		SELECT *
		FROM `distributors2goods`
		");

	while($row3 = $res3->fetch_assoc()) {
		foreach($tmp as $v) {
			if ($row3['good_id'] == $v) {
				$tmp2[$row3['good_id']][] = $row3['distributor_id'];
			}
		}
	}

	$res4 = q("
		SELECT *
		FROM `distributors`
		");

	while($row4 = $res4->fetch_assoc()) {
		$tmp3[$row4['id']] = $row4['name'];
	}

	foreach ($tmp2 as $k => $v) {
		foreach ($v as $k1 => $v1) {
			foreach ($tmp3 as $k2 => $v2) {
				if ($k2 == $v1) {
					$tmp2[$k][$k1] = '<a href="/goods&name='.$v2.'">'.$v2.'</a>';;
				}
			}
		}
	}

	Paginator::$table = 'goods';
	$resText = Paginator::builder();
	$res2 = Paginator::Q();
}


// ВЫВОД ПОСТАВЩИКОВ ОДНОГО ТОВАРА ПРИ ЕГО ОТКРЫТИИ
/*$res = q("
		SELECT *
		FROM `distributors2goods`
		WHERE `good_id` = 84
		");

while($row = $res->fetch_assoc()) {
	$tmp[] = $row['distributor_id'];
}

$tmp2 = implode(', ', $tmp);

$res2 = q("
		SELECT *
		FROM `distributors`
		WHERE `id` IN (".$tmp2.")
		");

while($row2 = $res2->fetch_assoc()) {
	$tmp5[] = '<a href="/goods&name='.$row2['name'].'">'.$row2['name'].'</a>';
}

$tmp6 = implode(', ', $tmp5);*/