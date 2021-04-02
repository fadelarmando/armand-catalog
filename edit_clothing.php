<?php
session_start();
if(!isset($_SESSION["sign-in"])){
	header("Location: sign-in.php");
	exit;
}
require "functions.php";
$dataTotalPerPage = 6;
$dataTotal = count(queryClothing("SELECT * FROM clothing"));
$pageTotal = ceil($dataTotal/$dataTotalPerPage);
$activePage = (isset($_GET["page"])) ? $_GET["page"]: 1;
$firstData = ($dataTotalPerPage * $activePage) - $dataTotalPerPage;
$id_clothing = $_GET["id_clothing"];
$clt = queryClothing("SELECT *FROM clothing WHERE id_clothing = $id_clothing")[0];

if(isset($_POST["submit"])){
  if(editClothing($_POST) > 0){
    echo "<script>
            alert('Edit Succesfully');
            document.location.href = 'clothing.php?page=$activePage';
          </script>";
  }
  else{
    echo "<script>
    alert('Edit Failed');
    document.location.href = 'clothing.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
	<meta charset="UTF-8">
    <title>Edit Clothing</title>
    <link rel="icon" href="logo.png">
	<link rel="stylesheet" href="insert.css">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
</head>
<body>
	
<div class="wrapper">
  <div class="title">
    <h1>Edit Clothing Item</h1>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="contact-form">
    <div class="input-fields">
        <input type="hidden" name="id_clothing" value="<?php echo $clt["id_clothing"]; ?>">
        <input type="hidden" name="old_pict" value="<?php echo $clt["pict"]; ?>">
        <label for="name_clothing" class="label">Name</label>
        <input type="text" class="input" name="name_clothing" placeholder="Item Name" required value="<?php echo $clt["name_clothing"]; ?>">
        <label for="price" class="label">Price</label>
        <input type="text" class="input" name="price" placeholder="Price (only number)" required value="<?php echo $clt["price"]; ?>">
        <label for="description_clothing" class="label">Description</label>
        <input type="text" class="input" name="description_clothing" placeholder="Description" required value="<?php echo $clt["description_clothing"]; ?>">
        <label for="pict" class="label">Picture</label>
        <img class="edit-pict" src="<?php echo $clt["pict"]; ?>">
        <input type="file" class="input" name="pict" placeholder="Link picture (online)" >
        <label for="link_buy" class="label">Link the e-commerce item</label>
      <input type="text" class="input" name="link_buy" placeholder="Link the e-commerce item" required value="<?php echo $clt["link_buy"]; ?>">
        <button type="submit" name="submit" class="btn">Edit</button>
    </div>
  </div>
  </form>
</div>
	
</body>
</html>