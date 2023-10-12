<?php 
    include_once('DbHandler.php');
    require('login.php');
 
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
      if(isset($error) && $error == 1) { 
        header('Location: login.php');
    }
  }
  

?>