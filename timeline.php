<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");
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
<?
	show_menubar();
?>
	<div id="page-wrapper">
<?	
		try
		{


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

						$writers = $db->query("SELECT user.id, name, spoiler FROM user INNER JOIN article ON user.id=article.id WHERE num=$article_num");
						if(isset($writers))
							$writer = $writers->fetch();
						else
							echo "Can't find a writer";
?>
						<div class="timeline-article">
							<a href="show.php?num=<?= $article_num ?>">
								<div class="article" style="background-image: url(<?= $url ?>)">
<?
									$article_content = stripslashes(nl2br($article['content']));
									echo $article_content;
?>
								</div>
							</a>
<?
							if ($article["spoiler"] == "YES")
							{
?>								
								<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
								<script type="text/javascript">
								$(function(){
									$('.article<?= $article['num']?>').click(function(){
										$('.article<?= $article['num']?>').hide();
									});
								});
								</script>

								<div class="spoiler article<?= $article['num']?>">
									<img src="image/caution.png">
								</div>
<?
							}
?>
							<div class="article-writer">
								<a href="user_page.php?id=<?= $writer['id'] ?>"><?= $writer['id'] ?></a>
							</div>
						</div>
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