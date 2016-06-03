<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$movies = search_movie("a", 100, 1, NULL, NULL, NULL, NULL, "sim");
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
	foreach($movies->channel->item as $movie)
	{
?>
		<div class="movie">
			<div class="poster">
<?
				echo sprintf("<a href='%s' target='_blank'><img src='%s' class='poster-img'/></a>", $movie->link, $movie->image);
?>
			</div>

			<div class="movie-name">
				<?= $movie->title ?>
			</div>
		</div>
<?
	}
?>		
	</div>

</body>
</html>