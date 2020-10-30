<div style=" display: flex; justify-content: space-evenly; width: 1170px; text-align: center; margin: 20px auto">
	<div>
		<img style="width: 300px; height: 300px" src="<?php if(isset($img_client)) echo $img_client; ?>" alt = "CLIENT IMG">
	</div>

	<div>
		<span style="font-weight: bold; font-size: 20px;">HP Client: <?php echo @$_SESSION['hp_client']; ?> |</span>
		<span style="font-weight: bold; font-size: 20px;"> HP Bot: <?php echo @$_SESSION['hp_bot']; ?></span>
		<br><br>
		<span style="font-weight: bold; font-size: 17px; color: #ff0000"><?php
		if(isset($_SESSION['damage_client'])){
			echo 'The BOT dealt: '.$_SESSION['damage_client'].' points of damage!';
		}
		?></span>
		<span style="font-weight: bold; font-size: 17px; color: #0000ff"><?php
		if(isset($_SESSION['damage_bot'])){
			echo 'The CLIENT dealt: '.$_SESSION['damage_bot'].' points of damage!';
		}
		?></span>
		<br><br>
		<form action="" method="get">
			<span style="font-weight: bold; font-size: 16px;">Enter a number from 1 to 3 and click "ATTACK":</span><br><br><input class="auth_text" type="text" name="input_number"><br>
			<span style="color: #ff0000"><?php echo @$_SESSION['error_input'];?></span><br><br>
			<input class="auth_button" type="submit" name="attack" value="ATTACK!" style="font-weight:bold">
		</form>

		<form action="" method="get">
			<br><br><span style="font-weight: bold; font-size: 14px;">To start again click "Start over":</span><br><br><input class="auth_button" type="submit" name="start_over" value="Start over" style="font-weight:bold"><br>
		</form><br><br>

		<span style="font-weight: bold; font-size: 25px; color: #ff0000"><?php echo @$_SESSION['lose']; ?></span>
	</div>

	<div>
		<img style="width: 300px; height: 300px" src="<?php if(isset($img_bot)) echo $img_bot; ?>" alt = "BOT IMG">
	</div>
</div>