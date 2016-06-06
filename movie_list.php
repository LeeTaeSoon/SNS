<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	if(isset($_GET["search_query"]))
	{
		$search_query = $_GET["search_query"];
		$movies = search_movie($search_query, 100, 1, NULL, NULL, NULL, NULL, "date");
	}

	else
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
	show_menubar("movie_list");
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
<?
				echo $movie->title;

				$movie_name = strip_tags($movie->subtitle);		// <b>
				$temp = explode("&amp; ", $movie_name);
				$movie_name = implode("", $temp);
?>
				<a href="recommand_movie.php?receiver=nrst136&movie=<?= $movie_name ?>">추천</a>
			</div>
		</div>
<?
	}
?>		
	</div>

</body>
</html>