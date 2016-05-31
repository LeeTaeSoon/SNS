<?
try {
	include("db_connect.php");

	$db = db_connect();

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	$content = $_POST["content"];
	$bgimg = $_POST["bgimg"];
	$time = date("Y-m-d h:i:s", time());
	$access = $_POST["access"];
	//$movie = $_POST["movie"];
	

	$table = "article";

	$articles = $db->query("SELECT num FROM $table");

	if($articles->rowCount() < 1)
		$num = 0;

	else
	{
		$temp = $db->query("SELECT * FROM $table ORDER BY num DESC LIMIT 1");
		$temp = $temp->fetch();
		$num = $temp["num"] + 1;
	}

	$t_id = $db->quote($id);
	$t_content = $db->quote($content);
	$t_bgimg = $db->quote($bgimg);
	$t_time = $db->quote($time);
	$t_access = $db->quote($access);
	//$t_movie = $db->quote($movie);

	$db->exec("INSERT INTO $table (num, id, content, bgimg, time, access/*, movie*/)
			values ($num, $t_id, $t_content, $t_bgimg, $t_time, $t_access)/*, $t_movie*/");

	header("Location: timeline.php");
}

catch (PODException $ex)
{
?>
	<p> Sorry, a database error occurred. Please try again later. </p>
	<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
}