<div style="width: 1170px; text-align: center; margin: 20px auto">
	<form action= "" class="auth" method="post">
		Enter the login or email:*<br><input class="auth_text" type="text" name="login" value="<?php echo @hc($_POST['login']) ?>"><br>
		<span style="color: #ff0000">
		<?php echo @$errors['login']; ?>
		</span>
		<br><br>Enter the password:*<br><input class="auth_text" type="password" name="pass" value="<?php echo @hc($_POST['pass']) ?>"><br>
		<span style="color: #ff0000">
		<?php echo @$errors['pass']; ?>
		</span><br>
		<p style="font-size: 10px; color: #ff0000">* Fields, obligatory for filling.</p>
		<br><br><input class="auth_button" type="submit" name="submit-auth" value = "Log In">
	</form>
	<br><br><a href="/cab/registration"><input class="auth_button" type="submit" name="submit-reg" value = "Create an account"></a>
</div>