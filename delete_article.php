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

		$num = $_GET["num"];

		$article_table = "article";
		$comment_table = "comment";

		$imgs = $db->query("SELECT bgimg FROM $article_table WHERE num=$num");
		if($imgs->rowCount())
			$img = $imgs->fetch();

		//$temp = explode('/', $img["bgimg"]);
		//$temp = implode('\\', $temp);

		//$path = substr($temp, 1);

		//$imgurl = '"'.getcwd().$path.'"';
		
		$imgurl = substr($img["bgimg"], 2);		// 상대 경로를 사용해서 삭제함

		unlink($imgurl);

		$db->exec("DELETE FROM $article_table WHERE num=$num");
		$db->exec("DELETE FROM $comment_table WHERE num=$num");

		echo '<meta http-equiv="refresh" content="0;url=timeline.php">';
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}