<!-- navbar.php -->
<?php
include './assets/constants.php';
?>

<nav class="navbar">
	<div class="wrapper navbar_flex">

		<div class="navbar-logo">
			<img src="./assets/images/music-house-logo.png" alt="LogoImg">
			<div class="navbar-logo-head">
				<a href="<?php echo ABOUT_PAGE; ?>">Music House</a>
				<h2>Звучим в ритме будущего, строим мелодии сегодня!</h2>
			</div>
		</div>

		<ul class="nav-links">
			<li><a class="links-navbar" href="<?php echo ABOUT_PAGE; ?>">О нас</a></li>
			<li><a class="links-navbar" href="<?php echo CATALOG_PAGE; ?>">Каталог</a></li>
			<li><a class="links-navbar" href="#">Где нас найти?</a></li>
			<?php
			if (isset($_SESSION['user'])) {
				echo '<li><a class="links-navbar" href="' . BASKET_PAGE . '" class="">Корзина</a></li>';
			}
			?>
		</ul>

		<?php
		if (isset($_SESSION['user'])) {
			echo '
				<div>
					<a href="vendor/logout.php" class="logout">ВЫХОД</a>
					<a href="' . PROFILE_PAGE . '" class="">ПРОФИЛЬ</a>
				</div>
				';
		} else {
			echo '
				<div>
					<a class="links-navbar" href="' . LOGIN_PAGE . '">Вход</a>
					<a class="links-navbar" href="' . REGISTER_PAGE . '">Регистрация</a>
				</div>
				';
		}
		?>

	</div>
</nav>