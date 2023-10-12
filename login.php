<?php
session_start();
include_once('DbHandler.php');
$db = new DbHandler();
$db->dbConnect();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $result = $db->login($username,$password);
    if(mysqli_num_rows($result)==1){
      $auth_code =session_id();
      $_SESSION['username'] = $username;
      $res=$db->updateAccess($auth_code,$username);
      if($res){
        header('Location: pets.php');
        exit();
      }

    } else {
      $error=1;
    }
}





?>



<!DOCTYPE html>
<head>
  <title>Login to CRUD: PETS</title>
  <link rel="stylesheet" href="styles-login.css">

</head>

<body>
<div class="login-box">
  <h2>Login</h2>
  <?php if(isset($error) && $error == 1) { ?>
    <p style="color:aliceblue">Incorrect username/password</p>
  <?php } ?>
  <form method="post" action="login.php">
    <div class="user-box">
      <input type="text" name="username" >
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" >
      <label>Password</label>
    </div>
    <a name="login2" href="login2.php" >
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      login
    </a>
    <button class="btn" type="submit" name="login" >Login</button>
   
  

</div>
</form>
</body>

</html>