<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
			<title>TODO List</title>
	</head>	
	<body>
	<?php
    var_dump($_GET);
    var_dump($_POST);
    ?>
		<h3>TODO List</h3>
			<ul>
				<li>Learn LINUX</li>
				<li>Learn APACHE</li>
				<li>Learn MYSQL</li>
				<li>Learn PHP</li>
			</ul>	
	</body>	
	<form method="POST" Action=/"index.php">
		<p>
			<label for="todo_item">New todo item</label>
			<textarea id="todo_item" name="todo_item" rows="1" cols="40" type="text">
			</textarea>
		</p>
		<p>	
			<input type="submit" value="add">		
		</p>
	</form>

</html>