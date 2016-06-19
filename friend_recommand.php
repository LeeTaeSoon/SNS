

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

			$f_recommands = "select user.id, user.proimg from user,(";
			$f_recommands .= "select fid as id, count(*) as cnt from (";
			$f_recommands .= "select fid from friend where id in (";
			$f_recommands .= "select fid from friend where id=$t_id)";
			$f_recommands .= " )as t where t.fid not in (";
			$f_recommands .= "select fid from friend where (id=$t_id or fid=$t_id))";
			$f_recommands .= " group by fid";
			$f_recommands .= " order by cnt desc) as r where user.id=r.id";

			$recommands = $db->query($f_recommands);

			$recommandCount = $recommands->rowCount();

			for($i = 0; $i < ceil($recommandCount / 4); $i++)
			{
				//////////////////////// 한 필름 ////////////////////////
?>
				
				<table>
<?
					for($j = 0; $j < $recommandCount - $i*4; $j++)
					{
						if($j > 3)
							break;
	
						$recommand = $recommands->fetch();
						$fid = $db->quote($recommand["id"]);
						$fimg = $db->quote($recommand["proimg"]);
?>					<tr>	
						<td id="pimg" style="background-image: url(<?=$fimg?>);">
						</td>
						<td>
						   이름<br> <br>
						<?= stripcslashes(nl2br($recommand["id"]))?>
						</td>
						<td>
						<a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$recommand['id']?>" onclick="return confirm('친구 추가하시겠습니까?');"> 친구 추가 
						</a>
						</td>
					</tr>
<?
					}
?>					
				</table>
<?				/////////////////////////////////////////////////////////
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