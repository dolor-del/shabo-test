<div style="width: 1170px; margin: 20px auto">

	<?php
	echo $resText;
	?><br><br>

	<form action="" method="get">
		<input type="submit" name="categories_all" value="Все категории">
		<?php while ($row = $res->fetch_assoc()) { ?>
			<input type="submit" name="category" value="<?php echo $row['name']; ?>">
		<?php } ?>
	</form>

	<?php while ($row2 = $res2->fetch_assoc()) { ?>
		<br><span><img src="<?php echo $row2['img']; ?>" alt="image"></span><br>
		<span><?php echo $row2['header']; ?></span><br>
		<span><?php echo $row2['subheader']; ?></span><br>
		<span><?php echo $row2['content']; ?></span><br>
	<?php } ?>

</div>