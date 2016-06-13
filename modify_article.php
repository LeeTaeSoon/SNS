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
		$access = $_POST["access"];

		$t_content = $db->quote($content);
		$t_bgimg = $db->quote($bgimg);
		$t_access = $db->quote($access);

		$table = "article";

		$articles = $db->query("SELECT bgimg FROM $table WHERE num=$num");
		if($articles->rowCount())
			$article = $articles->fetch();

		if($article["bgimg"] != $bgimg)
		{
			$imgurl = $article["bgimg"];

			if(!$imgurl)
			{
				$t_url = $db->quote($imgurl);

				$anotherimgs = $db->query("SELECT num FROM $table WHERE bgimg=$t_url");
				if($anotherimgs->rowCount() < 2 && file_exists($imgurl))
				{
					$imgurl = substr($imgurl, 2);		// 상대 경로를 사용해서 삭제함

					unlink($imgurl);
				}
			}
		}

		$db->exec("UPDATE $table SET content=$t_content, bgimg=$t_bgimg, access=$t_access WHERE num=$num");

		header("Location: timeline.php");
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}