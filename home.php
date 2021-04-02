<?php 
session_start();
if(!isset($_SESSION["sign-in"])){
	header("Location: sign-in.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" href="navigasi.css">
	<link rel="stylesheet" href="product.css">
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="footer.css">
	<link rel="icon" href="logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body style="background-color: #dfe6e9">
	<div>
		<nav>
			<div class="menu-icon">
				<span class="fas fa-bars"></span></div>
			<div class="logo">Armand</div>
			<div class="nav-items">
				<li><a href="home.php" id="active">Home</a></li>
				<li><a href="clothing.php">Clothing</a></li>
				<li><a href="pants.php">Pants</a></li>
				<li><a style="margin-right: 0px;" href="sign-out.php">Sign-out</a></li>
			</div>
			<div class="cancel-icon">
				<span class="fas fa-times"></span></div>
		</nav>
	</div>
	<div class="landing">
		<img src="background.png" alt="">
	</div>
	<div>
		<footer style="position: relative;">
			<div class="main-content">
				<div class="left box">
					<h2>About us</h2>
					<div class="content">
						<p>Armand is a catalog website where you can find out clothes or pants and the prices.This website will be more developed in the future so the website can be better. You can also add or remove items on this website to keep the catalog updated.</p>
						<div class="social">
							<a href="https://web.facebook.com/fadel.armando" target="_blank"><span class="fab fa-facebook-f"></span></a>
							<a href="https://twitter.com/Cihueyyy" target="_blank"><span class="fab fa-twitter"></span></a>
							<a href="https://www.instagram.com/fadel_armnd/" target="_blank"><span class="fab fa-instagram"></span></a>
						</div>
					</div>
				</div>
				<div class="center box">
					<h2>Address</h2>
					<div class="content">
						<div class="place">
							<span class="fas fa-map-marker-alt"></span>
							<span class="text">Palembang, Indonesia</span>
						</div>
						<div class="phone">
							<span class="fas fa-phone-alt"></span>
							<span class="text">+62-821-7609-9584</span>
						</div>
						<div class="email">
							<span class="fas fa-envelope"></span>
							<span class="text"><a style="text-decoration: none;" href="mailto: fadelarmando3@gmail.com">fadelarmando3@gmail.com</a></span>
						</div>
					</div>
				</div>
				<div class="right box">
					<h2>Contact us</h2>
					<div class="content">
						<form action="#">
							<div class="email">
								<div class="text">Email *</div>
								<input type="email" required>
							</div>
							<div class="msg">
								<div class="text">Message *</div>
								<textarea cols="25" rows="2" required></textarea>
							</div>
							<div class="btn">
								<button type="submit">Send</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</footer>
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