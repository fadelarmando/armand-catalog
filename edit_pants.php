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
$id_pants = $_GET["id_pants"];
$pnt = queryPants("SELECT *FROM pants WHERE id_pants = $id_pants")[0];

if(isset($_POST["submit"])){
  if(editpants($_POST) > 0){
    echo "<script>
            alert('Edit Succesfully');
            document.location.href = 'pants.php?page=$activePage';
          </script>";
  }
  else{
    echo "<script>
    alert('Edit Failed');
    document.location.href = 'pants.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Edit Pants</title>
    <link rel="icon" href="logo.png">
	<link rel="stylesheet" href="insert.css">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
</head>
<body>
	
<div class="wrapper">
  <div class="title">
    <h1>Edit Pants Item</h1>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="contact-form">
    <div class="input-fields">
        <input type="hidden" name="id_pants" value="<?php echo $pnt["id_pants"]; ?>">
        <input type="hidden" name="old_pict" value="<?php echo $pnt["pict"]; ?>">
        <label for="name_pants" class="label">Name</label>
        <input type="text" class="input" name="name_pants" placeholder="Item Name" required value="<?php echo $pnt["name_pants"]; ?>">
        <label for="price" class="label">Price</label>
        <input type="text" class="input" name="price" placeholder="Price (only number)" required value="<?php echo $pnt["price"]; ?>">
        <label for="description_pants" class="label">Description</label>
        <input type="text" class="input" name="description_pants" placeholder="Description" required value="<?php echo $pnt["description_pants"]; ?>">
        <label for="pict" class="label">Picture</label>
        <img class="edit-pict" src="<?php echo $pnt["pict"]; ?>">
        <input type="file" class="input" name="pict" placeholder="Link picture (online)" >
        <label for="link_buy" class="label">Link the e-commerce item</label>
      <input type="text" class="input" name="link_buy" placeholder="Link the e-commerce item" required value="<?php echo $pnt["link_buy"]; ?>">
        <button type="submit" name="submit" class="btn">Edit</button>
    </div>
  </div>
  </form>
</div>
	
</body>
</html>