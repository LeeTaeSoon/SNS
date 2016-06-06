<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	try {
		$num = $_POST["num"];
		$content = $_POST["content"];
		$bgimg = $_POST["bgimg"];
		$time = date("Y-m-d h:i:s", time());
		$access = $_POST["access"];

		$t_content = $db->quote($content);
		$t_bgimg = $db->quote($bgimg);
		$t_time = $db->quote($time);
		$t_access = $db->quote($access);

		$table = "article";

		$db->exec("UPDATE $table SET content=$t_content, bgimg=$t_bgimg, time=$t_time, access=$t_access WHERE num=$num");

		header("Location: timeline.php");
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}