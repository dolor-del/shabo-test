
<a href="/admin/news"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post" enctype="multipart/form-data">

	Категория:
	<select name="cat" required>
		<?php while ($row = $res->fetch_assoc()) { ?>
		<option><?php echo $row['name']; ?></option>
		<?php } ?>
	</select><?php echo @$errors['cat'];?>
	<br><br>

	Заголовок: <textarea name="header"><?php echo @hc($_POST['header']); ?></textarea><?php echo @$errors['header']; ?><br><br>
	Подзаголовок: <textarea name="subheader"><?php echo @hc($_POST['subheader']); ?></textarea><?php echo @$errors['subheader']; ?><br><br>
	Содержание: <textarea name="content"><?php echo @hc($_POST['content']); ?></textarea><?php echo @$errors['content']; ?><br><br>
	Изображение: <input type="file" name="file" accept="image/*"><br><br>
	<input type="submit" name="ok" value="Добавить">
</form>