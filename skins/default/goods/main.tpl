<div style="width: 1170px; margin: 20px auto">

	<?php
	echo $resText;
	?><br><br>

	<form action="" method="get">
		<input type="submit" name="categories_all" value="Все товары">
		<?php while ($row = $res->fetch_assoc()) { ?>
			<input type="submit" name="category" value="<?php echo $row['name']; ?>">
		<?php } ?>
	</form>
		<?php while($row2 = $res2->fetch_assoc()) { ?>
			<br><span><img src="<?php echo $row2['img']; ?>" alt="image"></span><br>
			<span><?php echo $row2['id']; ?></span><br>
			<span><?php echo $row2['category']; ?></span><br>
			<span><?php echo $row2['name']; ?></span><br>
			<span><?php echo $row2['manufacturer']; ?></span><br>
			<span><?php echo $row2['article']; ?></span><br>
			<span><?php echo $row2['short_description']; ?></span><br>
			<span><?php echo $row2['price']; ?></span><br>
			<span><?php
				if(isset($tmp2[$row2['id']])) {
					foreach ($tmp2 as $k => $v) {
						foreach ($v as $k1 => $v1) {
							if ($k == $row2['id']) {
								$h[] = $v1;
							}
						}
					}

					$h1 = implode(', ',$h);
					echo $h1;
					unset($h);
				}
			?></span><br>
		<?php } ?>
	<br><br><br>
</div>