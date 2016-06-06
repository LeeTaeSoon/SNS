<?
	ob_start();
	include("db_connect.php");
	$db = db_connect();

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");
?>


<html>

<head>
	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="show.css">
</head>


<body>

	<div id="top">
	 	<? include("menubar.php") ?>
	</div>


	<div id ="pagewrapper" >
		<? include("film_div.php") ?>

<?
	try
	{
		$id = $_GET["id"];
		$fid = $_GET["fid"];

		$table = "friend";
		$query = "insert into $table (id,fid) values ('".$id."','".$fid."')";
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