<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");
?>

<!DOCTYPE html>

<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">	
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="movie-info.css">
</head>

<body>
	<? include("menubar.php") ?>

	<div id="page-wrapper">

		<div class="poster">

		</div>

		<div class="info">

		</div>

	</div>

</body>
</html>