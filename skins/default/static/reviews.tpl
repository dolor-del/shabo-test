<script>
"use strict";

window.onload = function () {

		$('#xxx').click(function myAjax() {
			let y = $('#text1').val();
			$.ajax ({
				url : '/modules/static/reviews.php',
				type : "POST",
				cache : false,
				data : { text1 : y },
				timeout : 15000,
				success : function (msg) {
					let response = JSON.parse(msg);
					document.getElementById('newComment').innerHTML += response.name + ' ' + response.date + '<div style="white-space:pre-line">' + response.text + '</div><br>';
				},
				error : function (x, t, m) {
					alert(6);
					if (t === timeout) {
						alert('timeout');
					} else {
						alert('error');
					}
				}
			});
		});

	/*setInterval(function () {
		let y = $('#text1').val();
		$.ajax ({
			url : '/modules/static/reviews.php',
			type : "POST",
			cache : false,
			data : { text1 : y },
			timeout : 15000,
			success : function (msg) {
				let response = JSON.parse(msg);
				document.getElementById('newComment').innerHTML += response.name + ' ' + response.date + '<div style="white-space:pre-line">' + response.text + '</div><br>';
			},
			error : function (x, t, m) {
				alert(6);
				if (t === timeout) {
					alert('timeout');
				} else {
					alert('error');
				}
			}
		});
	}, 3000);*/


};




/*var func = function() {
	return alert("1");
};

setInterval(func,4000);*/

</script>

<div style="width: 1170px; text-align: left; margin: 20px auto">

	<?php if (!isset($error_comment_noauth)) { ?>
	<form action="" method="post">
		<!--<div>Name: <input type="text" name="name"></div><p><?php //echo @$errors['name']; ?></p>
		<div>Email: <input type="email" name="email"></div><p><?php //echo @$errors['email']; ?></p>-->
		<div><span style="vertical-align:top">Comment: </span><textarea class="auth_text" style="height: 80px" name="text" id="text1"></textarea></div>
		<span style="color: #ff0000"><?php echo @$errors['text']; ?></span>
		<div><input class="auth_button" type="submit" name="submit" value="To send" id="send"></div>
	</form>
	<br>

	<br>
		<div id="xxx">Проверить AJAX</div>
	<br>

	<div>Comments(<?php echo $count ?>):</div><br>
	<div>

		<br><div id="newComment"></div>
	<?php

	if($count) {
		for($i = 1; $i <= $count; ++$i) {
			$row = mysqli_fetch_assoc($res);
			echo hc($row['name']).' '.hc($row['date']);
			echo '<div>'.nl2br($row['text']).'</div><br>';
		}
	}
	?>
	<?php } else { ?>
	Комментарии доступны только пользователям, прошедшим <a href="/cab/authorization">авторизацию</a> и подтверждение адреса эл.почты!
	<?php } ?>

</div>
