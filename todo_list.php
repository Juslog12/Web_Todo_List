<?php

define('FILENAME', 'data/list.txt');

$list_items =[];

function savefile($filename, $array) {
	$handle = fopen($filename, 'w');
	foreach ($array as $item) {
		fwrite($handle, $item . PHP_EOL);		
	}
	fclose($handle);
}

function readtheFile($filename) {
	
	$array = [];

	if (filesize($filename) > 0) {
	 	if (is_readable($filename)) {
			$handle = fopen($filename, 'r');
			$contents = trim(fread($handle, filesize($filename)));
			$array = explode(PHP_EOL, $contents);
			fclose($handle);
		}
	}

	return $array;
}


?>
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
<?php
		$list_items = readtheFile(FILENAME);

		if($_POST) {
			array_push($list_items, $_POST['todo_item']);
		}

		if (isset($_GET['removeIndex'])) {
			$index = $_GET['removeIndex'];
			unset($list_items[$index]);
		}

		foreach ($list_items as $index => $item) {
			echo "<li>$item <a href=\"todo_list.php?removeIndex=$index\">Remove Item</a></li>";
		}

    	savefile(FILENAME,$list_items);
  
?>
		
	<h3>New ToDo Items</h3>
	<form method="POST" action = "todo_list.php">
		<p>
			<label for="todo_item">New Todo item</label>
			<textarea id="todo_item" name="todo_item" rows="1" cols="40" type="text" autofocus = "autofocus">
			</textarea>
		</p>
		<p>	
			<input type="submit" value="Add">		
		</p>
	</form>

	</body>	
</html>