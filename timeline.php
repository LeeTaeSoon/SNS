<?
	include("db_connect.php");

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");
?>

<!DOCTYPE html>

<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="timeline.css">
</head>

<body>
	<div id="page-wrapper">
<?	
		include("menubar.php");

		try
		{

			$db = db_connect();

			$table = "article";
			$frined_table = "friend";

			$t_id = $db->quote($id);

			$articles = $db->query("SELECT * FROM $table WHERE id=$t_id or access='all' or (access='friend' and 
									id in (select fid from friend where id=$t_id))");

			$articleCount = $articles->rowCount();

			for($i = 0; $i < ceil($articleCount / 4); $i++)
			{
				//////////////////////// 한 필름 ////////////////////////
?>
				<div class="blank"></div>
<?
				include("film_div.php");
?>
				<div class="timeline-board">
<?
					for($j = 0; $j < $articleCount - $i*4; $j++)
					{
						if($j > 3)
							break;

						$article = $articles->fetch();
						$url = $db->quote($article["bgimg"]);
						$article_num = $article["num"];
?>
						<a href="show.php?num=<?= $article_num ?>">
							<div class="timeline-article" style="background-image: url(<?= $url ?>)">
								<div class="article-writer">
<? 
									$writers = $db->query("SELECT name FROM user INNER JOIN article ON user.id=article.id WHERE num=$article_num");
									if(isset($writers))
										$writer = $writers->fetch();
									else
										echo "Can't find a writer";
									echo $writer['name'];
?>
								</div>
<?
								$article_content = stripslashes(nl2br($article['content']));
								echo $article_content;
?>
							</div>
						</a>
<?
					}
?>
				</div>
<?
				include("film_div.php");

				/////////////////////////////////////////////////////////
			}
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