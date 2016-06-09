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
		
		<div id="save_message">
			<?=$_SESSION['flash']?>
			<?unset($_SESSION['flash']);?>
		</div>
<?
	foreach($movies->channel->item as $movie)
	{
?>
		<div class="movie">
			<div class="poster">
<?
				echo sprintf("<a href='%s' target='_blank'><img src='%s' class='poster-img'/></a>", $movie->link, $movie->image);
?>
				<div class="mgrade">
					
					<?
						$movie_name = strip_tags($movie->subtitle);		// <b>
						$temp = explode("&amp; ", $movie_name);
						$movie_name = implode("", $temp);
					?>

					<table>
						<td> <a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class=star src="image/star.png"></a></td>
						<td> <a href= "save_grades.php?movie=<?=$movie_name?>&grade=2&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class=star src="image/star.png"> </td>
						<td> <a href= "save_grades.php?movie=<?=$movie_name?>&grade=3&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"> <img class=star src="image/star.png"></label></td>
						<td> <a href= "save_grades.php?movie=<?=$movie_name?>&grade=4&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"> <img class=star src="image/star.png"></label></td>
						<td> <a href= "save_grades.php?movie=<?=$movie_name?>&grade=5&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"> <img class=star src="image/star.png"></label></td>
					</table>
					<br>
					<div class="recom">
					 	<h2>추천</h2> 
					</div>
					<div class="recom">
						<a href="select_receiver.php?movie=<?= $movie_name ?>"><img id="recom"src="image/recommand1.jpg"></a>
					</div>

					<div id="want1">
						<a href = "save_wish_movie.php?movie=<?=$movie_name?>&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="heart" src="image/heart1.png" </a>
					</div>

					<div id="want">
						<h2>보고<br>싶어요</h2>
					</div>

				</div>
			</div>

			<div class="movie-name">
<?
				echo $movie->title;
?>
			</div>
		</div>
<?
	}
?>		
	</div>

</body>
</html>