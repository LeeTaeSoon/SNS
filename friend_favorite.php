

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="friend_recommand.css">

<body>
	<div id="page-wrapper">
<?	
		try
		{
			echo "<br>";
			$db = db_connect();
			$t_id = $db->quote($id);

			$f_recommands = "select * from friend where id in";
			$f_recommands .= "(select friend.fid as id ";
			$f_recommands .= "from friend";
			$f_recommands .= "where id=$t_id) and fid<>$t_id";

			$recommands = $db->query($f_recommands);

			$recommandCount = $recommands->rowCount();

			for($i = 0; $i < ceil($recommandCount / 4); $i++)
			{
				//////////////////////// 한 필름 ////////////////////////
?>
				<div class="blank"></div>
<?
				include("film_div.php");
?>
				<div class="timeline-board">
<?
					for($j = 0; $j < $recommandCount - $i*4; $j++)
					{
						if($j > 3)
							break;
	
						$recommand = $recommands->fetch();
						$fid = $db->quote($recommand["id"]);
						$fimg = $db->quote($recommand["proimg"]);
?>
						<a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$recommand['id']?>" onclick="return confirm('친구 추가하시겠습니까?');">
							<div class="timeline-article" style="background-image: url(<?=$fimg?>);">
							
								<?= stripcslashes(nl2br($recommand["id"])) ?>

							</div>
						</a>
<?
					}
?>
				</div>
<?
				include("film_div.php");

				/////////////////////////////////////////////////////////
			}
		}

		catch (PODException $ex)
		{
?>
			<p> Sorry, a database error occurred. Please try again later. </p>
			<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
		}
?>
	</div>
</body>
</html>