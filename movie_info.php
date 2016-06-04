<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");
?>

<!DOCTYPE html>

<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">	
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="movie_info.css">
</head>

<body>
	<? show_menubar(); ?>

	<div id="page-wrapper">

		<div class="poster">
			<img src="image/menu-icon.png" class="big-poster">
		</div>

		<div class="info">
			<div class="title info-content">
				주토피아
			</div>

			<div class="open-date info-content">
				2016. 02. 23
			</div>

			<div class="director info-content">
				감독
			</div>

			<div class="actors info-content">
				배우들
			</div>

			<div class="user-rate info-content">
				평점
			</div>

			<a href="" class="detail_info">더 자세한 정보를 확인하세요</a>
		</div>

	</div>

</body>
</html>