<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$comment_time = $_GET["time"];
	$comment_time = $db->quote($comment_time);

	$num = $_GET["num"];

	if($db->exec("DELETE FROM comment WHERE date=$comment_time"))
	{
		header("Location: show.php?num=$num");
	}

	else
	{
		echo "댓글 삭제에 실패하였습니다.";
	}
