<?php 
$conn = mysqli_connect("localhost", "root", "", "pweb");
function queryClothing($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $clothes = [];
    while ($clothe = mysqli_fetch_assoc($result)) {
        $clothes[] = $clothe;
    }
    return $clothes;
}
function insertClothing($data){
    global $conn;
    //ambil data dari tiap elemen form
    $name_clothing = htmlspecialchars($data["name_clothing"]);
    $price = htmlspecialchars($data["price"]);
    $description_clothing = htmlspecialchars($data["description_clothing"]);
    $link_buy = htmlspecialchars($data["link_buy"]);
    $pict = uploadClothing();
    if(!$pict){
        return false;
    }
    
    $query = "INSERT INTO clothing VALUES (
                '','$name_clothing','$price','$description_clothing','$pict','$link_buy'
                )";
    mysqli_query($conn,$query);    
    return mysqli_affected_rows($conn);
}
function uploadCLothing(){
    $fileName = $_FILES['pict']['name'];
    $fileSize = $_FILES['pict']['size'];
    $error = $_FILES['pict']['error'];
    $tmpName = $_FILES['pict']['tmp_name'];

    if($error === 4){
        echo "<script> alert('Upload Picture First'); </script>";
        return false;
    }

    $validPictExtension = ['jpg','jpeg','png'];
    $pictExtension =  explode('.',$fileName);
    $pictExtension = strtolower(end($pictExtension));
    if(!in_array($pictExtension, $validPictExtension)){
        echo "<script> alert('You didn't upload an picture'); </script>";
        return false;
    }
    if($fileSize > 3000000){
        echo "<script> alert('Picture size is too large'); </script>";
        return false;
    }
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $pictExtension;
    move_uploaded_file($tmpName, $newFileName);
    return $newFileName;
}
function deletedClothing($id_clothing){
    global $conn;
    mysqli_query($conn, "DELETE FROM clothing WHERE id_clothing = $id_clothing");
    return mysqli_affected_rows($conn);
}
function editClothing($data){
    global $conn;
    //ambil data dari tiap elemen form
    $id_clothing = $data["id_clothing"];
    $name_clothing = htmlspecialchars($data["name_clothing"]);
    $price = htmlspecialchars($data["price"]);
    $description_clothing = htmlspecialchars($data["description_clothing"]);
    $old_pict = htmlspecialchars($data["old_pict"]);
    $link_buy = htmlspecialchars($data["link_buy"]);
    if($_FILES['pict']['error'] === 4){
        $pict = $old_pict;
    }else{
        $pict = uploadCLothing();
    }
    printf($_FILES['pict']['error']);
    
    $query = "UPDATE clothing SET 
              name_clothing= '$name_clothing',
              price = $price,
              description_clothing = '$description_clothing',
              pict = '$pict',   
              link_buy = '$link_buy'
              WHERE id_clothing = $id_clothing";
    mysqli_query($conn,$query);    
    return mysqli_affected_rows($conn);
}

function searchClothing($search){
    $query = "SELECT *FROM clothing WHERE name_clothing LIKE '%$search%' OR price LIKE '%$search%' OR description_clothing LIKE '%$search%'";
    return queryClothing($query);   
}
function queryPants($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $pants = [];
    while ($pant = mysqli_fetch_assoc($result)) {
    $pants[] = $pant;
    }
    return $pants;
}
function insertPants($data){
    global $conn;
      //ambil data dari tiap elemen form
    $name_pants = htmlspecialchars($data["name_pants"]);
    $price = htmlspecialchars($data["price"]);
    $description_pants = htmlspecialchars($data["description_pants"]);
    $link_buy = htmlspecialchars($data["link_buy"]);
    $pict = uploadPants();
    if(!$pict){
        return false;
    }

    $query = "INSERT INTO pants VALUES (
                '','$name_pants','$price','$description_pants','$pict','$link_buy'
                )";
    mysqli_query($conn,$query);    
    return mysqli_affected_rows($conn);
}
function uploadPants(){
    $fileName = $_FILES['pict']['name'];
    $fileSize = $_FILES['pict']['size'];
    $error = $_FILES['pict']['error'];
    $tmpName = $_FILES['pict']['tmp_name'];

    if($error === 4){
        echo "<script> alert('Upload Picture First'); </script>";
        return false;
    }

    $validPictExtension = ['jpg','jpeg','png'];
    $pictExtension =  explode('.',$fileName);
    $pictExtension = strtolower(end($pictExtension));
    if(!in_array($pictExtension, $validPictExtension)){
        echo "<script> alert('You didn't upload an picture'); </script>";
        return false;
    }
    if($fileSize > 3000000){
        echo "<script> alert('Picture size is too large'); </script>";
        return false;
    }
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $pictExtension;
    move_uploaded_file($tmpName, $newFileName);
    return $newFileName;
}
function deletedPants($id_pants){
    global $conn;
    mysqli_query($conn, "DELETE FROM pants WHERE id_pants = $id_pants");
    return mysqli_affected_rows($conn);
}
function editPants($data){
    global $conn;
      //ambil data dari tiap elemen form
    $id_pants = $data["id_pants"];
    $name_pants = htmlspecialchars($data["name_pants"]);
    $price = htmlspecialchars($data["price"]);
    $description_pants = htmlspecialchars($data["description_pants"]);
    $old_pict = htmlspecialchars($data["old_pict"]);
    $link_buy = htmlspecialchars($data["link_buy"]);
    if($_FILES['pict']['error'] === 4){
        $pict = $old_pict;
    }else{
        $pict = uploadPants();
    }

    $query = "UPDATE pants SET 
              name_pants= '$name_pants',
              price = $price,
              description_pants = '$description_pants',
              pict = '$pict',   
              link_buy = '$link_buy'
              WHERE id_pants = '$id_pants'";
    mysqli_query($conn,$query);    
    return mysqli_affected_rows($conn);
}
function searchPants($search){
    $query = "SELECT *FROM pants WHERE name_pants LIKE '%$search%' OR price LIKE '%$search%' OR description_pants LIKE '%$search%'";
    return queryPants($query);   
}
function signup($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $confirm_password = mysqli_real_escape_string($conn,$data["confirm_password"]);   
    $result = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('Username is Unavailable');
      </script>";
      return false; 
    }
    if($password !== $confirm_password){
        echo "<script>
        alert('Confirm Password Invalid');
      </script>";
      return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}