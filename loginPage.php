<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: profilePage.php');
  exit();
};
?>

<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
  <link rel="stylesheet" href="./assets/styles/loginPage.css">
</head>

<body class="auth">

  <?php include './components/navbar.php'; ?>

  <div class="auth__form-center">
    <div class="auth__form-container">
      <h2 class="title__form">Вход</h2>

      <form class="login-form">
        <label for="login">Логин</label>
        <input 
          type="text" 
          id="login" 
          name="login" 
          placeholder="Введите свой логин"
        >

        <label for="password">Пароль</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          placeholder="Введите пароль"
        >

        <button type="submit" class="btn-login">Войти</button>
        <p class="not-auth">
          У вас нет аккаунта? - <a href="<?php echo REGISTER_PAGE; ?>">зарегистрируйтесь!</a>
        </p>

        <p class="msg-error none"></p>

      </form>
      
    </div>
  </div>

  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script>
    //== Авторизация ==//
    $('.btn-login').click(function (event) {
      event.preventDefault();

      $('input').removeClass('error__input');

      let login = $('input[name="login"]').val(),
          password = $('input[name="password"]').val();

      $.ajax({
        url: './vendor/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
          login: login,
          password: password
        },
        success (data) {

          if (data.status) {
            document.location.href = '<?php echo PROFILE_PAGE; ?>';
          } else {

            if (data.type === "emptyField") {
              data.fields.forEach((field) => {
                $(`input[name="${field}"]`).addClass('error__input');
              })
            }

            $('.msg-error').removeClass('none').text(data.message);
          }
        }
      })
    });
  </script>

</body>

</html>