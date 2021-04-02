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
if (deletedPants($id_pants) > 0) {
    echo "<script>
            alert('Deleted Succesfully');
            window.location.href = 'pants.php?page=$activePage';
        </script>";
        
}
else{
    echo "<script>
    alert('Deleted Fail');
    document.location.href = 'pants.php';
  </script>";
}
