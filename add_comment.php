<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

try
{
	include("db_connect.php");
	$db = db_connect();

	$table = "comment";

	$comment = $db->quote($_POST["comment"]);

	$t_id = $db->quote($id);

	$result = $db->exec("INSERT INTO $table (num, id, comment) values ($num, $t_id, $comment)");

	header("Location:show.php?num=$num");

}

catch (PODException $ex)
{
?>
	<p> Sorry, a database error occurred. Please try again later. </p>
	<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
}

?>