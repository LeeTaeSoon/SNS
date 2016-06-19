<?	
		try
		{

			$t_id = $db->quote($id);

			$fa_recommands = "select DISTINCT friend.fid from friend where id in";
			$fa_recommands .= "(select friend.fid as id from friend ";
			$fa_recommands .= "where id=$t_id) and fid<>$t_id";

			$recommands = $db->query($fa_recommands);

			$recommandCount = $recommands->rowCount();

			for($i = 0; $i < $recommandCount; $i++)
			{
				//////////////////////// 한 필름 ////////////////////////
?>
				<div class="fff">
<?
						$recommand = $recommands->fetch();
						$fid = $db->quote($recommand["id"]);
						$fimg = $db->quote($recommand["proimg"]);
?>						
						<?= stripcslashes(nl2br($recommand["fid"])) ?>
						<br>취향 : <?= similarity($id, $recommand["fid"]); ?> %
						<a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$recommand['fid']?>" onclick="return confirm('<?=$recommand['fid']?>를 친구로 추가하시겠습니까?');"></a>

						<div class="fff_img" style="background-image: url(<?=$fimg?>);">
						</div>
<?
?>
				</div>
<? 
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

</html>
