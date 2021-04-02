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

$pants = queryPants("SELECT* FROM pants LIMIT $firstData,$dataTotalPerPage");
if(isset($_POST["search"])){
	$pants = searchPants($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<title>Pants</title>
	<meta charset="utf-8">
	<link rel="icon" href="logo.png">
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
	<div>
		<nav>
			<div class="menu-icon">
				<span class="fas fa-bars"></span></div>
			<div class="logo">Armand</div>
			<div class="nav-items">
				<li><a href="home.php">Home</a></li>
				<li><a href="clothing.php">Clothing</a></li>
				<li><a href="pants.php"  id="active">Pants</a></li>
				<li><a class="sign-out" style="margin-right: 10px;" href="sign-out.php">Sign-out</a></li>
			</div>
			<div class="search-icon">
				<span class="fas fa-search"></span></div>
			<div class="cancel-icon">
				<span class="fas fa-times"></span></div>
			<form action="" method="POST">
				<input type="text" class="search-data" name="keyword" placeholder="Find The Item" required autofocus autocomplete="off">
				<button type="submit" class="fas fa-search" name="search"></button>
			</form>
		</nav>
	</div>
	<section class="product-list">
		<div>
			<h1 class="align-center">pants</h1>
			<div class="insert-item"><a href="insert_pants.php">Insert item</a><br><br></div>
		</div>
		<div class="product-container">
			<?php foreach($pants as $pant){?>
			<div class="card">
				<div class="title"><?php echo $pant["name_pants"] ?></div>
				<div class="image"> <img src="<?php echo $pant["pict"]; ?>" alt="t-shirt"></div>
				<div class="text">
					<h3>Rp <?php echo number_format($pant["price"],0,",","."); ?></h3>
				</div>
				<div class="text"><?php echo $pant["description_pants"]; ?></div>
				<div>
					<button class="buy-button"><a href="edit_pants.php?id_pants=<?php echo $pant["id_pants"]."&page=$activePage"; ?>"class="buy-link">Edit Item</a></button>
					<button class="buy-button"><a href="<?php echo $pant["link_buy"]; ?>" target="_blank" class="buy-link">Buy Now</a></button>
					<button class="buy-button"><a href="delete_pants.php?id_pants=<?php echo $pant["id_pants"]."&page=$activePage"; ?>" class="buy-link"<?php $name = $pant["name_pants"]; ?> onclick="return confirm('Apakah item <?php echo $name; ?> akan dihapus')">Delete Item</a></button>
				</div>

			</div>
			<?php }?>
		</div>
	</section>
	<div class="pagination">
 <?php for($i = 1; $i <= $pageTotal; $i++){?>
	<?php if($i == $activePage):  ?>	
		<a class="a1" style=" color: #ff3d00;" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
	<?php else : ?>
		<a class="a1" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		
	<?php endif;?>	
<?php }?>	
</div>
</body>
<script>
	const menuBtn = document.querySelector(".menu-icon span");
	const searchBtn = document.querySelector(".search-icon");
	const cancelBtn = document.querySelector(".cancel-icon");
	const items = document.querySelector(".nav-items");
	const form = document.querySelector("form");
	menuBtn.onclick = () => {
		items.classList.add("active");
		menuBtn.classList.add("hide");
		searchBtn.classList.add("hide");
		cancelBtn.classList.add("show");
	}
	cancelBtn.onclick = () => {
		items.classList.remove("active");
		menuBtn.classList.remove("hide");
		searchBtn.classList.remove("hide");
		cancelBtn.classList.remove("show");
		form.classList.remove("active");
		cancelBtn.style.color = "#ff3d00";
	}
	searchBtn.onclick = () => {
		form.classList.add("active");
		searchBtn.classList.add("hide");
		cancelBtn.classList.add("show");
	}
</script>

</html>