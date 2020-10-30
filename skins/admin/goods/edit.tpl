
<a href="/admin/goods"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post" enctype="multipart/form-data">

	Категория:
	<select name="category" required>
		<?php while ($row2 = $res2->fetch_assoc()) { ?>
			<option <?php if ((isset($_POST['category']) && $_POST['category'] == $row2['name']) || $row2['name'] == $row['category']) {
				echo 'selected';
			}?>><?php echo $row2['name']; ?></option>
		<?php } ?>
	</select><?php echo @$errors['category'];?>
	<br><br>

	Поставщики:
	<?php while ($row4 = $res4->fetch_assoc()) { ?>
		<label><input type="checkbox" name="ids[]" value="<?php echo $row4['id']; ?>"
			<?php if (isset($idsDistributors)) {
			if (in_array($row4['id'], $idsDistributors)) {
					echo 'checked';
				}
			}?>><?php echo $row4['name']; ?></label>&nbsp;
	<?php } ?>
	<?php echo @$errors['category'];?>
	<br><br>

	Наименование: <textarea name="name"><?php echo hc($row['name']); ?></textarea><?php echo @$errors['name']; ?><br><br>
	Производитель: <textarea name="manufacturer"><?php echo @hc($row['manufacturer']); ?></textarea><?php echo @$errors['manufacturer']; ?><br><br>
	Артикул: <textarea name="article"><?php echo @hc($row['article']); ?></textarea><?php echo @$errors['article']; ?><br><br>
	Короткое описание: <textarea name="short_description"><?php echo hc($row['short_description']); ?></textarea><?php echo @$errors['short_description']; ?><br><br>
	Полное описание: <textarea name="description"><?php echo hc($row['description']); ?></textarea><?php echo @$errors['description']; ?><br><br>
	Цена: <input name="price" type="text" value="<?php echo hc($row['price']); ?>"><?php echo @$errors['price']; ?><br><br>
	Изображение: <input type="file" name="file" accept="image/*"><br><br>
	<input type="submit" name="ok" value="Сохранить">
</form>