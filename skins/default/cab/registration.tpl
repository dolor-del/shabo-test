<div style="width: 1170px; text-align: center; margin: 20px auto">
	<form action= "" class="auth" method="post">
		Enter the login:*<br><input class="auth_text" type="text" name="login" value="<?php echo @hc($_POST['login']) ?>"><br>
		<span style="color: #ff0000">
		<?php echo @$errors['login']; ?>
		</span>
		<br><br>Enter the password:*<br><input class="auth_text" type="password" name="pass" value="<?php echo @hc($_POST['pass']) ?>"><br>
		<span style="color: #ff0000">
		<?php echo @$errors['pass']; ?>
		</span>
		<br><br>Enter yuor email:*<br><input class="auth_text" type="text" name="email" value="<?php echo @hc($_POST['email']) ?>"><br>
		<span style="color: #ff0000">
		<?php echo @$errors['email']; ?>
		</span>
		<br>
		<p style="font-size: 10px; color: #ff0000">* Fields, obligatory for filling.</p>
		<br><br><input class="auth_button" type="submit" name="submit-auth" value = "Register">
	</form>
</div>