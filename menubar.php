<?
	try 
	{
		include("function.php");
		$recommand_table = "recommand_table";

		$alarms = $db->query("SELECT * FROM $table");
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
?>

<div class="menu-bar">
	<a href="timeline.php">
		<div class="logo">
			<img src="image/logo.png">
		</div>
	</a>

	<input type="checkbox" id="check">

	<div class="simple-menu">
		<a href="write.php" class="menu">
			<img src="image/write.png">
		</a>

		<a href="friends.php">
			<div class="icon">
				<img src="image/friend.png">
			</div>
		</a>

		<div class="icon">
			<label for="check"><img src="image/alarm.png"></label>
		</div>
	</div>

	<div class="alarm">
<?
		if($alarms->rowCount())
		{
			foreach ($alarms as $alarm)
			{
				$movie_name = $alarm["movie"];
				// $temp = explode(" ", $movie_name);
				// $movie_name = implode("", $temp);
				var_dump(md5($movie_name));
				$movie_name = strip_tags($movie_name);		// <b>
				$temp = explode("&amp", $movie_name);
				$movie_name = implode("", $temp);
				$movie_name = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $movie_name);
?>
				<div class="alarm-item">
					<?= $alarm["sender"] ?> 님 께서 <?= $alarm["receiver"] ?> 님 께 <?= $alarm["movie"] ?> 를 추천하셨습니다.
				</div>
<?
			}

		}
?>
	</div>

	<div class="user-menu">
		<div class="user-name">
			<a href="user_page.php?id=<?= $id ?>"><span class="name"> <?= $name ?></span> 님 </a>
		</div>

		<div class="logout-button">
			<a href="logout.php">로그아웃</a>	
		</div>
	</div>

	<div class="all-menu-button">
		<img src="image/menu-icon.png" class="menu-icon">
	</div>
</div>