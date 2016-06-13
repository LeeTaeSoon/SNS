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

		$table = "alarm";
		$query = "insert into $table (sender,receiver) values ('".$id."','".$fid."')";
		$db->exec($query);

		echo "new record create successful";
		
		header("Location:friends.php");

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