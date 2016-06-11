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
		<? show_menubar(); ?>	
	</div>


	<div id="cover">

		<div id = "my_situ_message">
		<h1> Welcome to my page </h1>
		</div>
			<!-- <? ?> -->
		<div id="profile_picture">
			<!-- <? ?> -->
			<img id="profile" src="<?= $page_user['proimg'] ?>"> <input type="file">
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

	<input type="radio" id="my_article" name="tab" value="my_article" checked>
	<input type="radio" id="saw_movie" name="tab" value="saw_movie">
	<input type="radio" id="interest_movie" name="tab" value="interest_movie">
	<input type="radio" id="friends" name="tab" value="friends">


	<div id = "my_article" class="content">
<?
		$article_table = "article";
		$page_articles = $db->query("SELECT * FROM $article_table WHERE id = $userid");

		foreach ($page_articles as $article) {
			$article_num = $article["num"];
?>
			<a href="show.php?num=<?= $article_num ?>">
				<div class="article" style="background-image: url(<?= $article["bgimg"] ?>)">
					<h1> Your article </h1>
					<? show_article($article); ?>
				</div>
			</a>
<?
		}
?>
	</div>
	
	<div id = "saw_movie" class="content">
		<div style="text-align: center;">
			<br>
			<p> What you Saw </p>
		</div>
		<? show_saw_movie($userid); ?>
	</div>
	
	<div id= "interest_movie" class="content">
		<div style="text-align: center;">
			<br>
			<p> What you Want </p>
		</div>
		<?
		$querys = "SELECT * from wish_movie where id=$userid";
		$articles = $db->query($querys);

		foreach($articles as $article){
		?>  <div class="interest_movie_list">
			 	<br> 
			 	<div id="interest_movie_title"><h2><?= stripslashes($article['movie'])?></h2></div>
			 	<a href="<?=$article['link']?>"><img class="molist" src="<?=$article['image']?>"></a>
				<h2> SeeSaw 유저 평점 : </h2>
			</div>
		<?
		}
		?>
	</div>

	<div id= "friends" class="content">
<?
		$friend_table = "friend";
		$page_friends = $db->query("SELECT * FROM $friend_table WHERE id=$userid");

		foreach ($page_friends as $friend) {
?>
			<div class="friend">
<?
				$fid = $db->quote($friend["fid"]);
				$friends = $db->query("SELECT * FROM user WHERE id=$fid");

				if(isset($friends))
					$friend = $friends->fetch();
				else
				{
					echo "Can't find freind name";
					exit(1);
				}
?>
				<div class="friend_profile">
					<img id="fri_proimg" src="<?=$friend['proimg']?>">	
				</div>
				<div>
					<br>
					<br>
					<h2><a href="user_page.php?id=<?=$friend['id']?>"><?=$friend['name']?></a></h2>
					<br>
					<br>
					<h3> 함께 아는 친구 :    명 </h3>
				</div>
			</div>
<?
		}
?>
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