
<?php if (isset($info)) { ?>
<div style="<?php
	if ($flag) {
		echo 'background-color: #57ff53;';
	} else {
		echo 'background-color: #ff333b;';
	}
	?> height: 30px; padding-top: 5px; text-align: center  ">
	<span><?php echo $info; ?></span>
</div>
<?php } ?>

<br><a href="/admin/distributors/add"><input type="submit" value="Добавить поставщика"></a><br><br>

<form action="" method="post">
	<table>
		<tr>
			<td><input type="checkbox" name="select_all"></td>
			<td>ID</td>
			<td>Имя</td>
			<td>Описание</td>
			<td>Действие</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($res)) { ?>
		<tr id="fan">
			<td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><a href="/admin/distributors?action=delete&id=<?php echo $row['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a>
				<br><a href="/admin/distributors/edit?id=<?php echo $row['id']; ?>">ИЗМЕНИТЬ</a></td>
		</tr>
		<?php } ?>

	</table>

	<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onClick="return areYouSure();">
</form>