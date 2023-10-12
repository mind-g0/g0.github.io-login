<?php 
include_once('DbHandler.php');

$db = new DbHandler();
$db->dbConnect();

if (isset($_GET['edit'])){

	$id = $_GET['edit'];

	$result_i = $db->search_id($id);
	
}

if(isset($_POST['update_id'])){
	$id = $_POST['id'];
	$name = $_POST['name'];

	$update_result = $db->update_i($id, $name);
	
	if($update_result){
		header("Location: pets.php");
		}
		$result_n = $db->search_name($name);
	}else if(isset($_POST['update_name'])){
		$id = $_POST['id'];
		$name = $_POST['name'];

		$update_result = $db->update_n($id, $name);
		
		if($update_result){
			header("Location: pets.php");
			}
		}
		
		
	
	

?>
<!DOCTYPE html>
<html>
<head>

	<title>CRUD: PETS - UPDATE</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<form method="post" action="edit.php" >
		<h1>CRUD: PETS UPDATE</h1>
<?php $row = $result_i->fetch_assoc();?>


		
		<div class="input-group" >
			<label >Pet ID</label>
			<input type="text" name="id" value="<?php echo $row['id']; ?> ">	
		</div>		
		<div class="input-group" >
			<label >Pet Name</label>
			<input type="text" name="name" value="<?php echo $row['name']; ?> ">
		</div>
		<div class="input-group">
			<button class="btn1" type="submit" name="update_id">Update the id</button>
			<br>
			<button class="btn2" type="submit" name="update_name">Update the name</button>
		</div>
	</form>
</body>
</html>