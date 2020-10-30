
<a href="/admin/news"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post" enctype="multipart/form-data">

	Категория:
	<select name="cat" required>
		<?php while ($row2 = $res2->fetch_assoc()) { ?>
			<option <?php if ((isset($_POST['cat']) && $_POST['cat'] == $row2['name']) || $row2['name'] == $row['cat']) {
				echo 'selected';
			}?>><?php echo $row2['name']; ?></option>
		<?php } ?>
	</select><?php echo @$errors['cat'];?>
	<br><br>

	Заголовок: <textarea name="header"><?php echo @hc($row['header']); ?></textarea><?php echo @$errors['header']; ?><br><br>
	Подзаголовок: <textarea name="subheader"><?php echo @hc($row['subheader']); ?></textarea><?php echo @$errors['subheader']; ?><br><br>
	Содержание: <textarea name="content"><?php echo @hc($row['content']); ?></textarea><?php echo @$errors['content']; ?><br><br>
	Изображение: <input type="file" name="file" accept="image/*"><br><br>
	<input type="submit" name="ok" value="Изменить">
</form>