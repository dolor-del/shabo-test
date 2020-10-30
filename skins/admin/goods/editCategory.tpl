
<a href="/admin/goods"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">

	Название категории: <input name="category" value="<?php echo @hc($row['name']); ?>"><?php echo @$errors['category']; ?><br><br>

	<input type="submit" name="ok" value="Изменить">
</form>