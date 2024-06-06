<?php

session_start();
require_once '../vendor/connect.php';

$username = $_POST["username"];
$password = $_POST["password"];

// Админские ники:
$adminName1 = "madmin";

if ($username != $adminName1) {
  $_SESSION["msgError"] = "Ты не похож на админа!";
  header("Location: ../admin.php");
} else {
  $check_adminUser = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$adminName1' AND `password` = '$password'");
  
  if (mysqli_num_rows($check_adminUser) > 0) {
    $adminUser = mysqli_fetch_assoc($check_adminUser);
    $_SESSION['admin'] = [
      "id" => $adminUser["id"],
      "name" => $adminUser["name"],
      "email" => $adminUser["email"]
    ];
    header("Location: adminPage.php");
  }
  else{
    $_SESSION["msgError"] = "Ты не похож на админа!!";
    header("Location: ../admin.php");
  }
}

