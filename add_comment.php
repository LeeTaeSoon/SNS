<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

try
{
	include("function.php");

	$table = "comment";

	$comment = $db->quote($_POST["comment"]);
	$num = $_POST["num"];

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