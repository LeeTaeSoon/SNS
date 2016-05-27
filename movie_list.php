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
	<link rel="stylesheet" type="text/css" href="movie_list.css">
</head>

<body>
<?	
	include("menubar.php");
?>
	<div id="page-wrapper">
<?
	for($i = 0 ; $i < 20 ; $i++)
	{
?>
		<a href="">
			<div class="movie">
				<div class="poster">
					<img src="image/menu-icon - 원본.png" class="poster-img">
				</div>

				<!-- <div class="star-score">
					
				</div> -->

				<div class="movie-name">
					주토피아
				</div>
			</div>
		</a>
<?
	}
?>		
	</div>

</body>
</html>