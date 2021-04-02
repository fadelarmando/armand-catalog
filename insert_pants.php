<?php
session_start();
if(!isset($_SESSION["sign-in"])){
	header("Location: sign-in.php");
	exit;
}
require "functions.php";
$dataTotalPerPage = 6;
$dataTotal = count(queryClothing("SELECT * FROM pants"));
$pageTotal = ceil($dataTotal/$dataTotalPerPage);
$activePage = (isset($_GET["page"])) ? $_GET["page"]: 1;
$firstData = ($dataTotalPerPage * $activePage) - $dataTotalPerPage;

if(isset($_POST["submit"])){
  if(insertPants($_POST) > 0){
    echo "<script>
            alert('Added Succesfully');
            document.location.href = 'pants.php?page=$pageTotal';
          </script>";
  }
  else{
    echo "<script>
            alert('Invalid Input');
            document.location.href = 'pants.php';
          </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title>Insert Pants</title>
  <link rel="icon" href="logo.png">
	<link rel="stylesheet" href="insert.css">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
</head>
<body>
	
<div class="wrapper">
  <div class="title">
    <h1>Insert Pants Item</h1>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="contact-form">
    <div class="input-fields">
    <label for="name_pants" class="label">Name</label>
    <input type="text" class="input" name="name_pants" required>
    <label for="price" class="label">Price</label>
    <input type="text" class="input" name="price" placeholder="Only Number" required>
    <label for="description" class="label">Description</label>
    <input type="text" class="input" name="description_pants"  required>
    <label for="pict" class="label">Picture</label>
    <input type="file" class="input" name="pict" >
    <label for="link_buy" class="label">Link the e-commerce item</label>
      <input type="text" class="input" name="link_buy"  required>
        <button type="submit" name="submit" class="btn">insert</button>
    </div>
  </div>
  </form>
</div>
	
</body>
</html>