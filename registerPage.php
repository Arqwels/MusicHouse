<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: profilePage.php');
};
?>

<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
  <link rel="stylesheet" href="./assets/styles/registerPage.css">
</head>

<body class="auth">

  <?php include './components/navbar.php'; ?>

  <div class="auth__form-center">
    <div class="auth__form-container">
      <h2 class="title__form">Регистрация</h2>
      <form class="register__form">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required pattern="[А-Яа-яЁё\s\-]+">

        <label for="surname">Фамилия:</label>
        <input type="text" id="surname" name="surname" required pattern="[А-Яа-яЁё\s\-]+">

        <label for="patronymic">Отчество:</label>
        <input type="text" id="patronymic" name="patronymic" pattern="[А-Яа-яЁё\s\-]+">

        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required pattern="[A-Za-z0-9\-]+">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required minlength="6">

        <label for="password_repeat">Повторите пароль:</label>
        <input type="password" id="password_repeat" name="password_repeat" required minlength="6">


        <div class="checkbox-container">
          <input type="checkbox" id="rules" name="rules">
          <label for="rules" class="checkbox-label">Я согласен с правилами регистрации</label>
        </div>

        <button type="submit" class="btn-register">Зарегистрироваться</button>

        <p class="not-auth">
          У вас уже есть аккаунт? - <a href="<?php echo LOGIN_PAGE; ?>">авторизируйтесь!</a>
        </p>

        <p class="msg-error none"></p>

      </form>
    </div>
  </div>


  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script>
    //== Авторизация ==//
    $('.btn-register').click(function (event) {
      event.preventDefault();

      $('input').removeClass('error__input');
      $('.checkbox-container').css('color', '');

      let name = $('input[name="name"]').val(),
          surname = $('input[name="surname"]').val();
          patronymic = $('input[name="patronymic"]').val();
          login = $('input[name="login"]').val();
          email = $('input[name="email"]').val();
          password = $('input[name="password"]').val();
          password_repeat = $('input[name="password_repeat"]').val();
          rules = $('input[name="rules"]').is(':checked');

      $.ajax({
        url: './vendor/register.php',
        type: 'POST',
        dataType: 'json',
        data: {
          name: name,
          surname: surname,
          patronymic: patronymic,
          login: login,
          email: email,
          password: password,
          password_repeat: password_repeat,
          rules: rules,
        },
        success (data) {

          if (data.status) {
            document.location.href = '<?php echo LOGIN_PAGE; ?>';
          } else {

            if (data.type === "emptyField") {
              data.fields.forEach((field) => {
                $(`input[name="${field}"]`).addClass('error__input');
              })
            }
            if (data.type === "noAgree") {
              $('.checkbox-container').css('color', '#ff1f1f');
            }
            if (data.type === "passwordMismatch") {
              $('input[name="password"], input[name="password_repeat"]').addClass('error__input');
            }

            $('.msg-error').removeClass('none').text(data.message);
          }
        }
      })
    });
  </script>

</body>

</html>