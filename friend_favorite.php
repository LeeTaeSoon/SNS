<?	
		try
		{

			$t_id = $db->quote($id);

			$fa_recommands = "select friend.fid from friend where id=$t_id order by similarity desc limit 5";

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
