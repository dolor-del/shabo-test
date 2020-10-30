
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

<br><a href="/admin/news/addCategory"><input type="submit" value="Добавить категорию новости"></a><br><br>
<form action="" method="post" name="formCat">
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
				<td><a href="/admin/news?from=cat&action=delete&id=<?php echo $row['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a>
					<br><a href="/admin/news/editCategory?from=cat&id=<?php echo $row['id']; ?>">ИЗМЕНИТЬ</a></td>
			</tr>
		<?php } ?>
	</table>

	<br><input type="submit" name="del_marks_cat" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onclick="return areYouSure();">
</form>

<br><hr>

<br><a href="/admin/news/addNewsItem"><input type="submit" value="Добавить новость"></a><br><br>
<form action="" method="post" name="formNews">
	<table>
		<tr>
			<td><input type="checkbox" name="select_all"></td>
			<td>Заголовок</td>
			<td>Подзаголовок</td>
			<td>Содержание</td>
			<td>Дата добавления</td>
			<td>Дата изменения</td>
			<td>Изображение</td>
			<td>Категория</td>
			<td>Действие</td>
		</tr>
		<?php
		while($row2 = $res2->fetch_assoc()) { ?>
			<tr>
				<td><input type="checkbox" name="ids[]" value="<?php echo $row2['id']; ?>"></td>
				<td><?php echo $row2['header']; ?></td>
				<td><?php echo $row2['subheader']; ?></td>
				<td><?php echo $row2['content']; ?></td>
				<td><?php echo $row2['date_add']; ?></td>
				<td><?php if (isset($row2['date_edit']) && !empty($row2['date_edit'])) {echo $row2['date_edit'];} else {echo '-';} ?></td>
				<td><img src="<?php echo $row2['img']; ?>" alt="image" width="100px" height="100px"></td>
				<td><?php echo $row2['cat'].'('.$row2['cat_id'].')'; ?></td>
				<td><a href="/admin/news?from=news&action=delete&id=<?php echo $row2['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a>
					<br><a href="/admin/news/editNewsItem?from=news&id=<?php echo $row2['id']; ?>">ИЗМЕНИТЬ</a></td>
			</tr>
		<?php } ?>
	</table>

	<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onClick="return areYouSure();">
</form>