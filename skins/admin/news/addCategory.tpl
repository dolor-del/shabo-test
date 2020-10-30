
<a href="/admin/news"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">

	Название категории: <input name="cat" value="<?php echo @hc($_POST['cat']); ?>"><?php echo @$errors['cat']; ?><br><br>

	<input type="submit" name="ok" value="Добавить">
</form>