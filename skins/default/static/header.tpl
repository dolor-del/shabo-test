<!-- ОТКРЫВАЕМ БЛОК С КОНТЕНТОМ -->
<div class="content">

<script>
	"use strict";

	window.onload = function () {
		document.getElementById('autho').onclick = function () {
			document.getElementById('modal').style.display = 'block';
		};
	}

		/*let timeVar='';
		let body = document.querySelector('body');
		let button = document.getElementById('autho');
		let my_blok = document.getElementById('modal');
		button.onclick = function() {
			if(my_blok.style.display === "block") {
				my_blok.style = "display: none";
			} else {
				my_blok.style = "display: block"; timeVar = 1;
			}
		};

		body.onclick = function() {
			if(!timeVar) {
				my_blok.style = "display: none";
			}
			if(timeVar) {
				setTimeout(function(){ timeVar=''; }, 100);
			}

		};*/

		/*document.onclick = function(ev) {
			myDiv = document.getElementById('modal');
			if (ev.target.id !== myDiv.id && myDiv.style.display === 'block')  {
				myDiv.style.display = 'none';
			}
		}*/
	/*};*/



	/*function check() {
		console.log(document.getElementById('login').value.length);
		if(document.getElementById('login').value.length < 2) {
			document.getElementById('errLogin').innerHTML = 'Слишком короткий логин!';
			return false;
		} else if (document.getElementById('login').value.length > 16) {
			document.getElementById('errLogin').innerHTML = 'Слишком длинный логин!';
			return false;
		} else if (document.getElementById('pass').value.length < 5) {
			document.getElementById('errPass').innerHTML = 'Слишком короткий пароль!';
			return false;
		} else {
			return true;
		}
	}*/

</script>

<header>
	<div class="container_logo">
		<a href="/">
			SPARE<span>PARTS</span>
		</a>
	</div>
	<div class="panel_1">
		<ul>
			<?php
			if (isset($_SESSION['user'])) {
				echo '<span style="font-size: 13px">You are logged in as <span style="color: #008000; font-weight:bold">'.hc($_SESSION['user']['login']).'</span></span>';
			}
			if ($_SERVER ['REMOTE_ADDR'] == '12.0.0.1' || (isset($_SESSION['user']) && $_SESSION['user']['access'] == 5)) {
				echo '<li><a href="/admin/static/authorization">ADMIN</a></li>';
			}
			?>
			<li><a id="autho" style="position:relative" <?php
			if (isset($_SESSION['user'])) { echo 'href="/static/editprofile"';}
			/*else echo '/cab/authorization';*/
			?>>MY ACCOUNT
					<?php if (!isset($_SESSION['user'])) { ?>
					<form action="" method="post" onSubmit="return check();" id="modal" style="display:none; position:absolute; width:200px; height:150px; top: 13px; left:-112px; background-color: white; border: 1px solid black; text-align:center; z-index: 100; line-height: 5px;">
						<p>Login:</p><br><input type="text" id="login" name="login"><br><span id="errLogin"></span><br>
						<p>Password:</p><br><input type="password" id="pass" name="pass"><br><span id="errPass"></span><br><br>
						<input type="submit" value="Log in">
					</form>
					</a>
					<?php } ?>
			</li>
			<?php
			if (isset($_SESSION['user'])) {
				echo '<li><a href="/static/logout">LOG OUT</a></li>';
			}
			?>
			<li><a href="#">WISHLIST</a></li>
			<li><a href="#">USD</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
		</ul>
	</div>
</header>

<div class="black_stripe_width">
	<div class="flex_black_stripe">
		<div>
			<ul>
				<li><a href="#">Specials</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Quick Links</a></li>
				<li><a href="/static/reviews">Reviews</a></li>
				<li><a href="/static/file_system">File system</a></li>
				<li><a href="/static/game">Game</a></li>
				<li><a href="/news">News</a></li>
				<li><a href="/goods">Goods</a></li>
			</ul>
		</div>
		<div class="container_search">
			<input type="text" placeholder="Search store">
			<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
	</div>
</div>