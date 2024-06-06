<?php

session_start();
require_once 'connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];
$rules = filter_var($_POST['rules'], FILTER_VALIDATE_BOOLEAN);

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

if (mysqli_num_rows($check_login) > 0) {
  $response = [
    "status" => false,
    "type" => "candidateExists",
    "message" => "Данный логин уже занят!",
  ];

  echo  json_encode($response);

  die();
}

// Валидация
$error_fields = [];
$fields = [
  'name' => $name,
  'surname' => $surname,
  'patronymic' => $patronymic,
  'login' => $login,
  'email' => $email,
  'password' => $password,
  'password_repeat' => $password_repeat
];

foreach ($fields as $field => $value) {
  if (empty($value)) {
    $error_fields[] = $field;
  }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error_fields[] = 'email';
}

if (!empty($error_fields)) {
  $response = [
    "status" => false,
    "type" => "emptyField",
    "fields" => $error_fields,
    "message" => "Проверьте правильность полей",
  ];

  echo  json_encode($response);

  die();
}

if (!$rules) {
  $response = [
    "status" => false,
    "type" => "noAgree",
    "fields" => 'rules',
    "message" => "Нет согласия с правилами",
  ];

  echo  json_encode($response);

  die();
}


if ($password === $password_repeat) {

  $password = md5($password);

  mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `rules`) VALUES (NULL, '$name', '$surname', '$patronymic', '$login', '$email', '$password', '$rules')");


  $response = [
    "status" => true,
    "message" => "Регистрация успешна!",
  ];

  echo  json_encode($response);

} else {
  $response = [
    "status" => false,
    "type" => "passwordMismatch",
    "message" => "Пароли не совпадают!",
  ];

  echo  json_encode($response);
}
