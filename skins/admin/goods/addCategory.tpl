
<a href="/admin/goods"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">

	Название категории: <input name="category" value="<?php echo @hc($_POST['category']); ?>"><?php echo @$errors['category']; ?><br><br>

	<input type="submit" name="ok" value="Добавить">
</form>