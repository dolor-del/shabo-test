
<a href="/admin/news"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">

	Название категории: <input name="cat" value="<?php echo @hc($row['name']); ?>"><?php echo @$errors['cat']; ?><br><br>

	<input type="submit" name="ok" value="Изменить">
</form>