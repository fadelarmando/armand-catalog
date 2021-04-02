<?php 
  require "functions.php";
  if(isset($_POST["signup"])){
    if(signup($_POST) > 0){
      echo "<script>
      alert('Sign-Up Succes');
    </script>";    
    header("Location: sign-in.php");
  }
  }else{
    echo mysqli_error($conn);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Sign-Up</title>
    <link rel="icon" href="logo.png">
	<link rel="stylesheet" href="insert.css">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
</head>
<body>
	
<div class="wrapper1">
  <div class="title">
    <h1>Sign Up</h1>
  </div>
  <form action="" method="POST">
  <div class="contact-form">
    <div class="input-fields">
    <label for="username" class="label">Username </label>
        <input type="text" class="input" name="username" placeholder="Username" required autofocus>
        <label for="password" class="label">Password </label>
        <input type="password" class="input" name="password" placeholder="Password" required>
        <label for="confirm_password" class="label">Confirm Password </label>
        <input type="password" class="input" name="confirm_password" placeholder="Password" required>
        <label for="password" class="label">Have an account? <a style="text-decoration: none;" href="sign-in.php">Sign-in <br><br></a> </label>
        <button type="submit" name="signup" class="btn">Sign Up</button>
    </div>
  </div>
  </form>
</div>
	
</body>
</html>