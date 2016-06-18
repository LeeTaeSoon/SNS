<?
	ob_start();

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");
?>


<html>

<body>
 <? 
	try
	{
		$id = $_GET["id"];
		$fid = $_GET["fid"];
		$movie = $_GET["movie"];

		$table = "recommand_movie";

		$query = "delete from $table where receiver='".$id."' and sender='".$fid."' and movie='".$movie."'";
		echo $query;
		$db->exec($query);
		
		header("Location:timeline.php");

	} 

	catch (PODException $ex)
	{
		echo $query;
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
	$db = null;
?>

	</div>

</body>

</html>