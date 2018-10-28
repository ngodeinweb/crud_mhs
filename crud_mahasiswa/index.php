<!DOCTYPE html>
<html>
<head>
	<title> Database </title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		form {
			padding-left: 10px;
		}

		input {
			margin: 5px;
		}

		button {
			margin: 5px;
		}

	</style>
</head>
<body>

<div class="container">
	
	<!-- form login admin -->
	<form method="post" action="generate/cek_login.php">
		<h4> Silahkan Login </h4>
		<input type="text" name="nama" id="nama" placeholder="username">
		<br>
		<input type="password" name="pass" id="pass" placeholder="pass">
		<br>
		<button id="login" type="submit"> Login </button>
	</form>

</div>


</body>
</html>