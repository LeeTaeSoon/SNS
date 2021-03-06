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
	show_menubar("timeline");

	if(isset($_GET["sort"]))
		$sort_type = $_GET["sort"];
	else
		$sort_type = "date";
?>
	<div id="page-wrapper">
<?	
		try
		{
			$table = "article";
			$frined_table = "friend";

			$t_id = $db->quote($id);

			if ($sort_type == "date") {
				$articles = $db->query("SELECT * FROM $table WHERE id=$t_id or access='all' or (access='friend' and 
									id in (select fid from friend where id=$t_id)) ORDER BY time desc");
			}

			else if ($sort_type == "prefer") {
				$articles = $db->query("SELECT * FROM $table INNER JOIN friend ON $table.id=friend.id WHERE $table.id=$t_id or access='all' or (access='friend' and 
									$table.id in (select fid from friend where id=$t_id)) GROUP BY $table.num ORDER BY friend.similarity desc, $table.time desc");
			}

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

						$writers = $db->query("SELECT user.id, name, proimg, spoiler FROM user INNER JOIN article ON user.id=article.id WHERE num=$article_num");
						if(isset($writers))
							$writer = $writers->fetch();
						else
							echo "Can't find a writer";
?>
						<div class="timeline-article">
							<a href="show.php?num=<?= $article_num ?>">
								<div class="article">
									<div class="bg" style="background-image: url(<?= $url ?>)"></div>
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
							<a href="user_page.php?id=<?= $writer['id'] ?>">
								<div class="article-writer">
									<img src="<?= $writer['proimg'] ?>">
									<div class="name"><?= $writer['name'] ?></div>
								</div>
							</a>
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