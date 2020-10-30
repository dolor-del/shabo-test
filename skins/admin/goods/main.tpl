
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

<br><a href="/admin/goods/addCategory"><input type="submit" value="Добавить категорию товара"></a><br><br>
<form action="" method="post">
	<table>
		<tr>
			<td><input type="checkbox" name="select_all_cat"></td>
			<td>ID</td>
			<td>Категория</td>
			<td>Действие</td>
		</tr>
		<?php
		while($row = $res->fetch_assoc()) { ?>
			<tr>
				<td><input type="checkbox" name="ids_cat[]" value="<?php echo $row['id']; ?>"></td>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><a href="/admin/goods?from=category&action=delete&id=<?php echo $row['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a>
					<br><a href="/admin/goods/editCategory?from=category&id=<?php echo $row['id']; ?>">ИЗМЕНИТЬ</a></td>
			</tr>
		<?php } ?>
	</table>

	<br><input type="submit" name="del_marks_cat" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onClick="return areYouSure();">
</form>

<br><hr>

<br><a href="/admin/goods/add"><input type="submit" value="Добавить товар"></a><br><br>
<form action="" method="post">
	<table>
		<tr>
			<td><input type="checkbox" name="select_all"></td>
			<td>ID</td>
			<td>Имя</td>
			<td>Производитель</td>
			<td>Артикул</td>
			<td>Категория</td>
			<td>Дата добавления</td>
			<td>Дата изменения</td>
			<td>Изображение</td>
			<td>Действие</td>
		</tr>
		<?php
		while($row2 = mysqli_fetch_assoc($res2)) { ?>
		<tr>
			<td><input type="checkbox" name="ids[]" value="<?php echo $row2['id']; ?>"></td>
			<td><?php echo $row2['id']; ?></td>
			<td><?php echo $row2['name']; ?></td>
			<td><?php echo $row2['manufacturer']; ?></td>
			<td><?php echo $row2['article']; ?></td>
			<td><?php echo $row2['category'].'('.$row2['category_id'].')'; ?></td>
			<td><?php echo $row2['date_add']; ?></td>
			<td><?php if (isset($row2['date_edit']) && !empty($row2['date_edit'])) {echo $row2['date_edit'];} else {echo '-';} ?></td>
			<td><img src="<?php echo $row2['img']; ?>" alt="image" width="100px" height="100px"></td>
			<td><a href="/admin/goods?from=goods&action=delete&id=<?php echo $row2['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a>
				<br><a href="/admin/goods/edit?from=goods&id=<?php echo $row2['id']; ?>">ИЗМЕНИТЬ</a></td>
		</tr>
		<?php } ?>
	</table>

	<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onClick="return areYouSure();">
</form>