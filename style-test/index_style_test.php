<?php

require_once 'include/config_session.inc.php';
require_once 'include/login_view.inc.php';

?>

<!DOCTYPE html>
<html>
	<div class="container">
	<head>
			<title>Login</title>
	</head>
	<link rel="stylesheet" type="text/css" href="resources/styles/login-style.css" />	<div class="screen">
		<table>
			<tr>
				<th>
					<img src="resources/img/solo-colorato.png" alt="Logo" class="logo">
				</th>
			</tr>

		</table>
		<div class="screen__content">
			<form class="login" action="include/login.inc.php" method="post">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="username" class="login__input" placeholder="Username">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="pwd" class="login__input" placeholder="Password">
				</div>
				<button class="button login__submit" name="login">
					<span class="button__text">Accedi</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
		
		<?php
		check_login_errors();
		?>

		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</html>
