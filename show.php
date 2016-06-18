<?
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
	 	<? show_menubar(); ?>
	</div>


	<div id ="pagewrapper" >
		<? include("film_div.php") ?>
<?
	try
	{
		$num = $_GET["num"];

		$table = "article";

		$articles = $db->query("SELECT * FROM $table WHERE num=$num");
		if($articles->rowCount())
			$article = $articles->fetch();
?>
		<div id ="content">
			<div id ="article">
				<div class="bg" style="background-image: url(<?= $article["bgimg"] ?>)"></div>
				<? show_article($article); ?>
			</div>

			<div id = "comment">
				<div id="show_comment">
					<?	
						$comment_table = "comment";
						$user_table = "user";
						$comments = $db->query("SELECT * FROM $comment_table WHERE num=$num ORDER BY date desc");

						$comment_count = $comments->rowCount();
						
						foreach($comments as $comment)
						{	
							$comment_content = $comment["comment"];
							$comment_content = stripslashes($comment_content);		// 백슬래시 제거

							$c_id = $db->quote($comment["id"]);

							$comment_writers = $db->query("SELECT * FROM $user_table WHERE id=$c_id");
							if($comment_writers->rowCount())
								$comment_writer = $comment_writers->fetch();

					?>
							<table> 
								<tr>
									<th> <img src="<?= $comment_writer['proimg'] ?>"> </th>
									<th> <a href="user_page.php?id=<?= $comment_writer['id'] ?>"><?= $comment_writer["name"]; ?></a></th>
								</tr>
								<tr>
									<td colspan="2"><?= $comment_content ?></td>
								</tr>
							</table>
					<?	
						} 
					?>
				</div>
		
				<div id = "plus_comment">
					<form action="add_comment.php" method="post">
						<input type="text" name="comment" placeholder="댓글을 달아보세요.">
						<input type="hidden" name="num" value="<?= $num ?>">
						<input type="submit" value="입력"> 
					</form>
				</div>	
			</div>
		</div>
<? 
		include("film_div.php");
?>
		<div class="sub-menu">
			<form action="timeline.php" method="get">
				<input type="submit" value="목록"></input>
			</form>
<?
		if($id == $article["id"]) {
?>
			<form action="modify_article.html" method="get">
				<input type="submit" value="수정"></input>
				<input type="hidden" name="num" value="<?= $num ?>"></input>
			</form>
			<form action="delete_article.php" method="get">
				<input type="hidden" name="num" value=<?= $num ?>></input>
				<input type="submit" value="삭제"></input>
			</form>
<?
		}
?>
		</div>
<?
	} 

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
?>

	</div>
</body>

</html>