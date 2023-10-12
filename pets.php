<?php
session_start();
include_once('DbHandler.php');
$db = new DbHandler();
$db->dbConnect();

if(isset($_POST['save'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $result = $db->insert($id,$name);
}
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $result = $db->delete($id);
}

if (isset($_SESSION["username"])){
  $username= $_SESSION["username"];
  $res = $db->access($username);
  if (mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
    $auth_code=$row["accessescode"];
    /////////   (problim)
    /*

    if ($auth_code != $_COOKIE["PHPSESSID"]){
        header("location: login.php");
        exit();
      }

      */
    /////////
   
   
    if ($auth_code != $_COOKIE["PHPSESSID"]){
        header("location: login.php");
        exit();
      }
    }
    
    }
    else{
             header("location: login.php");
             exit();
    }

    if(isset($_POST['log'])){
        session_destroy();
        header('Location: login.php');
        exit();
      }

  
?>



<!DOCTYPE html>
<html>
    <head>
        <title>CRUD: PETS</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>





    <form method="post" action="pets.php">
        <h1><?php 
       
        echo "Welcome ".$username." !";
        
        ?></h1>
        <div class="input-group">
        <label>Pet ID</label>
            <input type="text" name="id" value="">  
            <br>
        <label>Pet Name</label>
            <input type="text" name="name" value="">
</div>
<?php
if(isset($result)){
    if($result)
    echo "Inserted!";
else
echo "Failed";
}
?>
<div class="input-group">
    <button class="btn" type="submit" name="save" >Save</button>
</div>
</form>
<table>
    <thead>
        <tr>
            <th>Pet ID</th>
            <th>Pet Name</th>
            <th colspan="2">Action</th>
</tr>
</thead>
<?php
$pets_list = $db->retrieve();

while ($row = $pets_list->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>
        <a href="/lab4-3/pets/edit.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
</td>
<td>
    <a href="/lab4-3/pets/pets.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
</td>
</tr>
<?php } ?>
</table>
<div class="input-group">
     <a href="logout.php">logout</a>
</div>
</body>
</html>    