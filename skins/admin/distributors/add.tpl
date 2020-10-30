
<a href="/admin/distributors"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">

	Наименование поставщика: <input name="name" value="<?php echo @hc($_POST['name']); ?>"><?php echo @$errors['name']; ?><br><br>
	Описание: <textarea name="description"><?php echo @hc($_POST['description']); ?></textarea><?php echo @$errors['description']; ?><br><br>

	<input type="submit" name="ok" value="Добавить">
</form>