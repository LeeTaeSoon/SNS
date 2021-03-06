<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$genre = $_GET["genre"];
	if(!$genre)
		$genre = NULL;	


	$search_query = $_GET["search_query"];
	if(!isset($search_query))
		$search_query = 'a';
	
	$movies = search_movie($search_query, 100, 1, $genre, NULL, NULL, NULL, "date");

?>

<!DOCTYPE html>

<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="movie_list.css">

	<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous">
	</script>
</head>

<body>
<?	
	show_menubar("movie_list", $genre);
?>
	<div id="page-wrapper">

		<div class="nav ph-line-nav">
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=19">액션</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=18">SF</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=2">판타지</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=4">공포</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=11">코미디</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=5">로맨스</a>
				<a href="movie_list.php?search_query=<?= $search_query ?>&genre=15">애니메이션</a>
				<div class="effect"></div>
		</div>
<?
	if($movies->channel->item == NULL){
		?>
		<p style="font-size : 70px; color : red; text-align : center;">DO NOT Use Korean and Space Between Keyword!!</p>
		<?
		exit(1);
	}
	foreach($movies->channel->item as $movie){
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

					<a href= "save_grades.php?movie=<?=$movie_name?>&grade=1&mimage=<?=$movie->image?>"><img class="star star1" src="image/star.png"></a>
					<a href= "save_grades.php?movie=<?=$movie_name?>&grade=2&mimage=<?=$movie->image?>"><img class="star star2" src="image/star.png"></a>
					<a href= "save_grades.php?movie=<?=$movie_name?>&grade=3&mimage=<?=$movie->image?>"><img class="star star3" src="image/star.png"></a>
					<a href= "save_grades.php?movie=<?=$movie_name?>&grade=4&mimage=<?=$movie->image?>"><img class="star star4" src="image/star.png"></a>
					<a href= "save_grades.php?movie=<?=$movie_name?>&grade=5&mimage=<?=$movie->image?>"><img class="star star5" src="image/star.png"></a>

					<script>
						$('.star').hover(function() {
							$(this).parent().prevAll().children().add(this).attr("src", "image/yellowstar.png");
						}, function(){
							$(this).parent().prevAll().children().add(this).attr("src", "image/star.png");
						});
					</script>

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
						<a href = "save_wish_movie.php?movie=<?=$movie_name?>&mimage=<?=$movie->image?>"><img class="hoverheart" src="image/hoverheart.png"></a>
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