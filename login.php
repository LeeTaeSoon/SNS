<!DOCTYPE html>

<?
	include("function.php"); 

	$id = $_POST["id"];
	$passwd = $_POST["passwd"];

	if(isset($id) && isset($passwd))
	{
		$is_login = login_ok("users.txt", $id, $passwd);

		if($is_login)
			echo '<meta http-equiv="refresh" content="0;url=main_page.php">';
		else
			echo '<meta http-equiv="refresh" content="0;url=login.php">';
	}
?>

<html>

	<head>
		<title> See Saw </title>
		<link rel="stylesheet" type="text/css" href="login.css">
	</head>

	<body>
		
		<div id="page-wrapper">

			<div class="login-page">

				<form action="" method="post">
					
					<input type="text" name="id" value="id" class="idpasswd"></input>
					<input type="password" name="passwd" value="password" class="idpasswd"></input>
					<input type="submit" value="로그인"></input>

				</form>

				<a href="sign.php">
					<div class="sign-button">
						회원가입
					</div>
				</a>

			</div>

		</div>
	
	</body>

</html>