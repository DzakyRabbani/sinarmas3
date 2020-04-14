<!DOCTYPE html>
	<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Form Login</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/style/html.css">
	</head>
	<body>
	
	<form class="box" action="<?= base_url('Auth/login_action')?>" method="post">
		<h1>Login</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="" value="Login">
	</form>

	</body>
	</html>	