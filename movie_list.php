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

					<img class="star star1" src="image/star.png">
					<img class="star star2" src="image/star.png">
					<img class="star star3" src="image/star.png">
					<img class="star star4" src="image/star.png">
					<img class="star star5" src="image/star.png">

					<div class="cover">
						<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="ystar ystar1" src="image/yellowstar.png"></a>
						<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="ystar ystar2" src="image/yellowstar.png"></a>
						<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="ystar ystar3" src="image/yellowstar.png"></a>
						<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="ystar ystar4" src="image/yellowstar.png"></a>
						<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="ystar ystar5" src="image/yellowstar.png"></a>
					</div>

					<br>
					<div class="recom">
					 	<h2>추천</h2> 
					</div>
					<div class="recom">
						<img id="recom"src="image/recommand.png">
						<a href="select_receiver.php?movie=<?= $movie_name ?>"><img class="hoverrecom"src="image/hoverrecommand.png"></a>
					</div>

					<div id="want1">
						<img class="heart" src="image/heart1.png">
						<a href = "save_wish_movie.php?movie=<?=$movie_name?>&mimage=<?=$movie->image?>&murl=<?=$movie->link?>"><img class="hoverheart" src="image/hoverheart.png"></a>
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