

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="friend_recommand.css">

<body>
	<div id="page-wrapper">
<?	
		try
		{

			$db = db_connect();
			$t_id = $db->quote($id);

			$f_recommands = "select user.id, user.proimg from user,(";
			$f_recommands .= "select fid as id, count(*) as cnt from (";
			$f_recommands .= "select fid from friend where id in (";
			$f_recommands .= "select fid from friend where id=$t_id)";
			$f_recommands .= " )as t where t.fid not in (";
			$f_recommands .= "select fid from friend where id=$t_id)";
			$f_recommands .= " group by fid";
			$f_recommands .= " order by cnt desc) as r where user.id=r.id";

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
						<a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$recommand['id']?>">
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