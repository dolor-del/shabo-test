<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Admin panel</title>
	<meta name="description" content="<?php echo hc(Core::$META['description']); ?>">
	<meta name="keywords" content="<?php echo hc(Core::$META['keywords']); ?>">
	<link href="/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/skins/admin/css/cms_style.css" rel="stylesheet" type="text/css">
	<?php if (count(Core::$CSS)) { echo implode("\n", Core::$CSS); }?>
	<?php if (count(Core::$JS)) { echo implode("\n", Core::$JS); }?>
	<link href="/img/favicon_adm.png" rel="shortcut icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>

		"use strict";

		function areYouSure() {
			return confirm('Вы действительно хотите удалить?');
		}

		window.onload = function () {
			let selectAll = document.getElementsByName('select_all');
			let selectAllCat = document.getElementsByName('select_all_cat');
			let ids = document.getElementsByName('ids[]');
			let idsCat = document.getElementsByName('ids_cat[]');

			selectAll[0].onclick = function () {
				if (selectAll[0].checked) {
					for (let i = 0; i < ids.length; i++) {
						ids[i].checked = 1;
					}
				} else {
					for (let i = 0; i < ids.length; i++) {
						ids[i].checked = 0;
					}
				}
			};

			selectAllCat[0].onclick = function () {
				if (selectAllCat[0].checked) {
					for (let i = 0; i < idsCat.length; i++) {
						idsCat[i].checked = 1;
					}
				} else {
					for (let i = 0; i < ids.length; i++) {
						idsCat[i].checked = 0;
					}
				}
			};

		};

	</script>
</head>
<body>

<div class="wrapper">
	<div class="content">
		<header>
			<div class="container_header">
				<div class="container_head_adm">
					<a href="/admin">ADMIN</a>
				</div>
				<div class="container_head_main">
					<a href="/">ГЛАВНАЯ</a>
				</div>
				<?php if (isset($_SESSION['user'])) { ?>
				<div class="container_head_profile">
					<span class="profile">Hello, <?php echo '<span>'.$_SESSION['user']['login'].'</span>'; ?>!</span>
				</div>
				<?php } ?>
			</div>
		</header>

		<div style="width: 1170px; margin: 20px auto ">
			<?php
			echo $content;
			?>
		</div>

	</div>

	<div class="footer">
		<footer>

		</footer>
	</div>
</div>