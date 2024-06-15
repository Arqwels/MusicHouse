<?php
session_start();

if (isset($_SESSION['user'])) {
  $response = [
    "status" => true,
    "user" => $_SESSION['user']
  ];
} else {
  $response = [
    "status" => false,
    "message" => "Пользователь не авторизован"
  ];
}

echo json_encode($response);
?>