<?php

if (isset($info)) { ?>
	<div style="<?php
	if (isset($flag)) {
		if ($flag) {
			echo 'background-color: #57ff53;';
		} else {
			echo 'background-color: #ff333b;';
		}
	}
	?> height: 30px; padding-top: 5px; text-align: center ">
		<span><?php echo $info; ?></span>
	</div><br>
<?php } ?>

<form action="" method="post" style="display:inline-block">
	<input type="text" name="search" value="<?php echo @$_POST['search']; ?>">
	<input type="submit" value="Поиск">
</form>

<?php
if (isset($_POST['search']) && $_POST['search'] != '') {
	echo '<a href="/admin/users"><input type="submit" value="Назад"></a>';
}

if (isset($no_users)) {
echo '<br>'.$no_users;
} else { ?>

	<br><br><form action="" method="post">
		<table>
			<tr>
				<td><input type="checkbox" name="select_all"></td>
				<td>ID</td>
				<td>Login</td>
				<td>Email</td>
				<td>Age</td>
				<td>Active</td>
				<td>Access</td>
			</tr>
			<?php
			while($row = mysqli_fetch_assoc($res)) { ?>
				<tr>
					<td><input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>"></td>
					<td><?php echo (int)$row['id']; ?></td>
					<td>
						<a href="/admin/users/edit?id=<?php echo (int)$row['id']; ?>"><?php echo es($row['login']); ?></a>
					</td>
					<td><?php echo es($row['email']); ?></td>

					<td><?php echo (int)$row['age']; ?></td>
					<td><?php echo (int)$row['active']; ?></td>
					<td><?php echo (int)$row['access']; ?></td>
					<td><a href="/admin/users?action=delete&id=<?php echo (int)$row['id']; ?>" onClick="return areYouSure();">УДАЛИТЬ</a></td>
				</tr>
			<?php } ?>

		</table>

		<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ" onClick="return areYouSure();">
	</form>

<?php } ?>