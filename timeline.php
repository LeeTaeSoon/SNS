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
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="timeline.css">
</head>

<body>
	<div id="page-wrapper">
<?	
		include("menubar.php");
		$articleCount = 30;

		for($i = 0; $i < ceil($articleCount / 4); $i++)
		{
			//////////////////////// 한 필름 ////////////////////////
?>
			<div class="blank"></div>
<?
			include("film_div.php");
?>
			<div class="timeline-board">
<?
				for($j = 0; $j < 4; $j++)
				{
?>
					<a href="show.php">
						<div class="timeline-article" style="background-image: url('image/menu-icon.png')">
						
							사용자의 게시물을 타임라인에 정렬된 순서로 보여줍니다 <br>
							배경은 게시물마다 저장된 이미지를 사용합니다.

						</div>
					</a>
					<!-- <div class="timeline-article" style="background-image: url(<?= $articles[$i]["bgimg"] ?>)">
						
						<?= nl2br($articles[$i]["content"]); ?>

					</div> -->
<?
				}
?>
			</div>
<?
			include("film_div.php");

			/////////////////////////////////////////////////////////
		}
?>
	</div>
</body>
</html>