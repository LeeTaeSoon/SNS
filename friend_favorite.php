<?	
		try
		{

			$t_id = $db->quote($id);

			$fa_recommands = "select DISTINCT friend.fid from friend where id in";
			$fa_recommands .= "(select friend.fid as id from friend ";
			$fa_recommands .= "where id=$t_id) and fid<>$t_id";

			$recommands = $db->query($fa_recommands);

			$recommandCount = $recommands->rowCount();

			echo "<table>";
			for($i = 0; $i < $recommandCount; $i++)
			{
				$recommand = $recommands->fetch();
				$t_id = $db->quote($recommand["fid"]);

				$users = $db->query("SELECT name, proimg FROM user WHERE id=$t_id");
				if($users->rowCount())
					$user = $users->fetch();
				//////////////////////// 한 필름 ////////////////////////
?>
				<tr class="fff">

					<td><img src=<?=$user["proimg"]?>></td>
					<td> <?=$user["name"] ?> </td>
					<td>취향 : <?= similarity($id, $recommand["fid"]); ?> % </td>
					<a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$recommand['fid']?>" onclick="return confirm('<?=$recommand['fid']?>를 친구로 추가하시겠습니까?');"></a>

				</tr>
<? 
				/////////////////////////////////////////////////////////
			}
			echo "</table>";
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
