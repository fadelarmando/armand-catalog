<?php
session_start();
require "functions.php";
if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
  $id = $_COOKIE["id"];
  $key = $_COOKIE["key"];
  $result = mysqli_query($conn,"SELECT username FROM users id = $id");
  $row = mysqli_fetch_assoc($result);
  if($key === hash("sha256",$row["username"])){
    $_SESSION["sign-in"] = true;
  }
}
if(isset($_SESSION["sign-in"])){
	header("Location: home.php");
	exit;
}
if(isset($_POST["sign-in"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password,$row["password"])){
      $_SESSION["sign-in"] = true;
      if(isset($_POST["remember"])){
        setcookie("id",$row["id"], time() + 60);
        setcookie("key",hash("sha256",$row["username"]), time()+60);
      }

      header("Location: home.php");
    }
  }
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Sign-In</title>
    <link rel="icon" href="logo.png">
	<link rel="stylesheet" href="insert.css">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
</head>
<body>
<div class="wrapper1">
  <div class="title">
    <h1>Sign-In</h1>
    <?php if(isset($error)){?>
           <div  class="label" style="color: red; font-style:italic;"> <p>Wrong Username / Password <br> </p></div>
             
        <?php }?>
  </div>
  <form action="" method="POST">
  <div class="contact-form">
    <div class="input-fields">
    <label for="username" class="label">Username </label>
        <input type="text" class="input" name="username" placeholder="Username" required autofocus>
        <label for="password" class="label">Password </label>
        <input type="password" class="input" name="password" placeholder="Password" required>       
        <input type="checkbox" class="box" name="remember">       
        <label style="margin-left: 22px;" for="remember" class="label">Remember me <br><br></label>
        <label for="password" class="label">Don't have an account? <a style="text-decoration: none;" href="sign-up.php">Sign-up <br><br></a> </label>
        <button type="submit" name="sign-in" class="btn">Sign-In</button>
    </div>
  </div>
  </form>
</div>
	
</body>
</html>