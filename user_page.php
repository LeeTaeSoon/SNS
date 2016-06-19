<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$userid = $_GET["id"];

	if(isset($_FILES))
	{
		$save_dir = "./image/profile_img/";

		if(is_uploaded_file($_FILES["uploadfile"]["tmp_name"]))
		{
			//echo "업로드한 파일 명 : " . $_FILES["uploadfile"]["name"];
			// 파일을 저장할 디렉토리 및 파일명
			$dest = $save_dir.$_FILES["uploadfile"]["name"];
			//파일을 지정한 디렉토리에 저장
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $dest))
				$imgurl = $save_dir.$_FILES["uploadfile"]["name"];
			//	echo "success";
			//else
			//	echo "fail2";
			$t_id = $db->quote($userid);
			$t_url = $db->quote($imgurl);

			$db->exec("UPDATE user SET proimg=$t_url WHERE id=$t_id");
		}
		//else
			//echo "no uploadfile";
	}

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
	<script src='//code.jquery.com/jquery.min.js'></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js'></script>
</head>

<body>
	<div id="top">
		<? show_menubar(); ?>	
	</div>


	<div id="cover">

		<div id = "my_situ_message">
		</div>

		<div id="profile_picture">

			<input type="file" id="file" name="uploadfile">
			<label for="file"><img id="profile" src="<?= $page_user['proimg'] ?>"></label>

				<script>
				$(function() {
					$('#file').bind('change', function() {
						$("<form action='' enctype='multipart/form-data' method='post'/>")
							.append( $(this) )
							.submit();
					});
				});
			</script>
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

	<br><br><br>
	<div id = "my_article" class="content">
<?
		$article_table = "article";
		$page_articles = $db->query("SELECT * FROM $article_table WHERE id = $userid");

		foreach ($page_articles as $article) {
			$article_num = $article["num"];
?>
			<a href="show.php?num=<?= $article_num ?>">
				<div class="article">
					<div class="bg" style="background-image: url(<?= $article["bgimg"] ?>)"></div>
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
	
	<div id = "saw_movie" class="content">
		<div style="text-align: center;">
			<br>
			<p><h1> <?= $page_user["name"] ?>님이 본 영화</h1></p>
		</div>
		<? show_saw_movie($userid); ?>
	</div>
	
	<div id= "interest_movie" class="content">
		<div style="text-align: center;">
			<br>
			<p><h1> <?= $page_user["name"] ?>님이 관심있는 영화</h1></p>
		</div>
		<?
		$querys = "SELECT * from wish_movie where id=$userid";
		$articles = $db->query($querys);

		foreach($articles as $article)
		{
			$movie_name = $article["movie"];
			$movie_name = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $movie_name);

		?>  <div class="interest_movie_list">
			 	<br> 
			 	<div id="interest_movie_title"><h2><?= stripslashes($article['movie'])?></h2></div>
			 	<a href="movie_list.php?search_query=<?= $movie_name ?>"><img class="molist" src="<?=$article['image']?>"></a>
				<?	
					$movie = $db->quote($article['movie']);
					$avr_grade = 0;
					$query="SELECT grade from see_movie where movie=$movie";
					$rows = $db->query($query);
					$count = $rows-> rowCount();

					foreach($rows as $row)
					{
						$total_grade = $row['grade']+$avr_grade;  
					}
					if($count!=0)
					{
					$avr_grade = $total_grade / $count;
					}
					else
					{
					$avr_grade = 0;
					$avr_grade = "평점 없음";
					}
				?>
				<br>
				<h2> SeeSaw 유저 평점 : <?=$avr_grade?></h2>
				<div class="star">
				 <?
				 	if($avr_grade == 0 )
				 	{
				 ?>
				 	<img class="g0star" src="image/star.png">
				 <?	
				 	}
					if($avr_grade == 1 )
					{
				?>
					<img class="gstar" src="image/gradestar.jpg">
				<?
					}
					if($avr_grade == 2 )
					{
				?>	<img class="gstar"src="image/gradestar.jpg"><img class="gstar"src=		"image/gradestar.jpg">
				<?
					}
					if($avr_grade == 3 )
					{
				?>
					<img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar" src="image/gradestar.jpg">
				<?
					}
				?>
				<?
					if($avr_grade == 4 )
					{
				?>
					<img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg">
				<?
					}
				?>
				<?
					if($avr_grade == 5 )
					{
				?>
					<img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg"><img class="gstar"src="image/gradestar.jpg">
				<?
					}
				?>
				</div>
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

				$t_id = $db->quote($_SESSION["id"]);

				$friend_together = $db->query("SELECT id FROM friend WHERE id=$t_id and fid in
										(SELECT fid FROM friend WHERE id=$fid)");
				$friend_n = $friend_together->rowCount();

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
					<h3> 함께 아는 친구 :  <?=$friend_n?>  명 </h3>
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