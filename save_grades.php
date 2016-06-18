<?if(!isset($_SESSION))
	session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$movie = $_GET["movie"];
	$grade = $_GET["grade"];
	$mimage = $_GET["mimage"];

	try
	{

		$t_id = $db->quote($id);
		$movie = $db->quote($movie);
	    $grade = $db->quote($grade);
		$mimage = $db->quote($mimage);

		$query="insert into see_movie(id,movie,grade,image)";
		$query.=" values($t_id,$movie,$grade,$mimage)";

		$result = $db->exec($query);


		$friends = $db->query("SELECT fid FROM friend WHERE id=$t_id");

		foreach ($friends as $friend) {
			$similarity = similarity($id, $friend["fid"]);

			$fri = $db->quote($friend["fid"]);
			$db->exec("UPDATE friend SET similarity=$similarity WHERE (id=$t_id and fid=$fri) or (id=$fri and fid=$t_id)");
		}


		if(isset($result))
		{
			$_SESSION['flash']="성공적으로 저장";
		}
		header("Location:movie_list.php");
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
?>

?>