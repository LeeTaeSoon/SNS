<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$userid = $_GET["id"];

	try {
		include("db_connect.php");
		$db = db_connect();

		$table = "user";

		$userid = $db->quote($userid);
		$users = $db->query("SELECT * FROM $table WHERE id = $userid");
		if(isset($users))
			$page_user = $users->fetch();
		else
		{
			echo "Can't find user info";
			exit(1);
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="user_page.css">

</head>

<body>
	<div id="top">
		<?include("menubar.php");?>	
	</div>


	<div id="cover">
			<!-- <? ?> -->
		<div id="profile_picture">
			<!-- <? ?> -->
			<img id="profile" src="#"> <input type="file">
		</div>

		<div id="profile_name">
			<?= $page_user["name"] ?>
		</div>

		<div id="menu">
				<label class="mymenu" for="my_article">글</label>
				<label class="mymenu" for="saw_movie">본 영화</label>
				<label class="mymenu" for="interest_movie">관심 있는 영화</label>
				<label class="mymenu" for="friends">친구 목록</label>
		</div>
	</div>

	<input type="radio" id="my_article" name="tab" value="my_article">
	<input type="radio" id="saw_movie" name="tab" value="saw_movie">
	<input type="radio" id="interest_movie" name="tab" value="interest_movie">
	<input type="radio" id="friends" name="tab" value="friends">

	<div id = "my_article" class="content">
<?
		$article_table = "article";
		$page_articles = $db->query("SELECT * FROM $article_table WHERE id = $userid");

		foreach ($page_articles as $article) {
?>
			<div class="article" style="background-image: url(<?= $article["bgimg"] ?>)">
				<? show_article($article); ?>
			</div>
<?
		}
?>
	</div>
	
	<div id = "saw_movie" class="content">

		2
	</div>
	
	<div id= "interest_movie" class="content">
	3
	</div>

	<div id= "friends" class="content">
	4
	</div>


</body>
</html>

<?
	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}