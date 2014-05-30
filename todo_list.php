<?php
var_dump($_FILES);
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

	if (is_readable($filename) && (filesize($filename)) > 0) {
			$handle = fopen($filename, 'r');
			$contents = trim(fread($handle, filesize($filename)));
			$array = explode(PHP_EOL, $contents);
			fclose($handle);

		}
	return $array;
}

$list_items = readtheFile(FILENAME);

if($_POST) {
	array_push($list_items, $_POST['todo_item']);
}

if (isset($_GET['removeIndex'])) {
	$index = $_GET['removeIndex'];
	unset($list_items[$index]);
}

if(count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
	$upload_dir = '/vagrant/sites/todo.dev/public/uploads/';
	$filename = basename($_FILES['file1']['name']);
	$saved_filename = $upload_dir . $filename; 
	move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
	$new_items = readtheFile($saved_filename);

	$list_items = array_merge($list_items, $new_items);

} 

if(isset($saved_filename)) {
	echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
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
	
	<h1>Upload File</h1>

<form method="POST" enctype="multipart/form-data">
    <p>
        <label for="file1">File to upload: </label>
        <input type="file" id="file1" name="file1">
    </p>
    <p>
        <input type="submit" value="Upload">
    </p>
</form>

	</body>	
</html>