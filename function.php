<?
	include("db_connect.php");
	$db = db_connect();

try
{

	function login_ok($id, $passwd)
	{
		global $db;

		$user_table = "user";

		$t_id = $db->quote($id);
		$t_passwd = $db->quote($passwd);

		$users = $db->query("SELECT * FROM $user_table WHERE id=$t_id and passwd=$t_passwd");

		if($users->rowCount())
		{
			$user = $users->fetch();
		}

		if(isset($user))
		{
			session_start();

			$_SESSION["id"] = $id;
			$_SESSION["name"] = $user["name"];
			return true;
		}

		return false;
	}

	function show_saw_movie($userid)
	{
		global $db;

		$db = db_connect();
		$querys = "SELECT * from see_movie where id=$userid";
		$rows = $db->query($querys);
		
		foreach($rows as $row)
		{
		?>  <div class="saw_movie_list">
				<br> 
			 	<h2><?=$row['movie']?></h2>
			 	<a><img class="molist" src="<?=$row['image']?>"></a>
			 	<h2> 나의 평점 : <?=$row['grade']?></h2>
			</div>
		<?
		}
	}

	function show_menubar($page = NULL)
	{
		global $id;
		global $name;
		global $db;

		$t_id = $db->quote($id);

		$recommand_table = "recommand_movie";

		$alarms = $db->query("SELECT * FROM $recommand_table WHERE receiver=$t_id ORDER BY time desc");
?>
		<div class="menu-bar">
			<a href="timeline.php">
				<div class="logo">
					<img src="image/logo.png">
				</div>
			</a>

			<input type="checkbox" id="check">

			<div class="simple-menu">
				<div class="search">
<?
					if($page == "movie_list")
					{
?>
						<form action="movie_list.php" method="get">
							<input type="text" name="search_query" placeholder="영화를 검색하세요"></input>
							<input type="submit" value="검색"></input>
						</form>
<?
					}
?>
				</div>

				<a href="write.php" class="menu">
					글쓰기
				</a>

				<a href="friends.php">
					<div class="icon">
						<img src="image/friend.png">
					</div>
				</a>

				<div class="icon">
					<label for="check"><img src="image/alarm.png"></label>
				</div>
			</div>

<?
			if($alarms->rowCount() < 6)
			{
?>
				<div class="alarm">
<?
					foreach ($alarms as $alarm)
					{
						$movie_name = $alarm["movie"];
						$movie_name = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $movie_name);
?>
						<div class="alarm-item">
							<a href="user_page.php?id=<?= $alarm['sender'] ?>"><?= $alarm["sender"] ?></a> 님 께서
							<a href="movie_list.php?search_query=<?= $movie_name ?>"><?= stripslashes($alarm["movie"]) ?></a> 를 추천하셨습니다. <br>
							<p class="center">취향 지수 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="percent"> <?= similarity($alarm["receiver"], $alarm["sender"]) ?> </span> %
							</p>
							<!-- <a href="<?= $alarm['link'] ?>"><?= stripslashes($alarm["movie"]) ?> 를 추천하셨습니다. -->
						</div>
<?
					}
?>
				</div>
<?
			}

			else
			{
?>
				<div class="alarm-full">
<?
					foreach ($alarms as $alarm)
					{
						$movie_name = $alarm["movie"];
						$movie_name = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $movie_name);
?>
						<div class="alarm-item-full">
							<a href="user_page.php?id=<?= $alarm['sender'] ?>"><?= $alarm["sender"] ?></a> 님 께서
							<a href="movie_list.php?search_query=<?= $movie_name ?>"><?= stripslashes($alarm["movie"]) ?></a> 를 추천하셨습니다. <br>
							<p class="center">취향 지수 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="percent"> <?= similarity($alarm["receiver"], $alarm["sender"]) ?> </span> %
							</p>
							<!-- <a href="<?= $alarm['link'] ?>"><?= stripslashes($alarm["movie"]) ?> 를 추천하셨습니다. -->
						</div>
<?
					}
?>
				</div>
<?
			}
?>
			<div class="user-menu">
				<div class="user-name">
					<a href="user_page.php?id=<?= $id ?>"><span class="name"> <?= $name ?></span> 님 </a>
				</div>

				<div class="logout-button">
					<a href="logout.php">로그아웃</a>	
				</div>
			</div>

			<div class="all-menu-button">
				<img src="image/menu-icon.png" class="menu-icon">
			</div>
		</div>
<?
	}

	function show_article($article)
	{
		global $db;

		$num = $article["num"];

		$writers = $db->query("SELECT user.id, name FROM user INNER JOIN article ON user.id=article.id WHERE num=$num");
		if(isset($writers))
			$writer = $writers->fetch();
		else
			echo "Can't find a writer";
?>
		<a href="user_page.php?id=<?= $writer['id'] ?>"><?= $writer['name'] ?></a>
<?
		$article_content = stripslashes(nl2br($article['content']));
		echo $article_content;
	}

	function search_movie($search_query, $display_num, $start, $genre, $country, $yearfrom, $yearto, $sort)
	{
		if($num > 100)
			$num = 100;

		$client_id = "xsNakWNmTCQTGoUCPcfF";
		$client_secret = "wnHI9MxWLt";
		//$url = "https://openapi.naver.com/v1/search/movie.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=sim";
		$url = "https://openapi.naver.com/v1/search/movie.xml?".
				"query=$search_query&display=$display_num&start=$start&genre=$genre&yearfrom=$yearfrom&yearto=$yearto&sort=$sort";
		$is_post = false;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$headers = array();
		$headers[] = "X-Naver-Client-Id: ".$client_id;
		$headers[] = "X-Naver-Client-Secret: ".$client_secret;

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec ($ch);
		if(curl_error($ch))
		{
		    echo 'error:' . curl_error($ch);
		}
		curl_close ($ch);

		//var_dump($response);

		$xml = simplexml_load_string($response) or die("Error: Cannot create object");

		return $xml;
	}

	function similarity($me, $fri)
	{
		global $db;
		$me = $db->quote($me);
		$fri = $db->quote($fri);

		$my_movies = $db->query("SELECT id movie FROM see_movie WHERE id=$me");
		$fri_movies = $db->query("SELECT id movie FROM see_movie WHERE id=$fri");

		$together_movies = $db->query("SELECT id movie FROM see_movie WHERE id=$me and
										movie in (select movie from see_movie where id=$fri)");
		$together_grade_movies = $db->query("SELECT id movie FROM see_movie WHERE id=$me and (
										( movie in (select movie from see_movie where id=$fri and grade > 3) and grade > 3 ) or
										( movie in (select movie from see_movie where id=$fri and grade < 3) and grade < 3 ) or
										( movie in (select movie from see_movie where id=$fri and grade = 3) and grade = 3 ))");

		if($together_movies->rowCount())
			$percent = $together_grade_movies->rowCount() * 100 / $together_movies->rowCount();

		return $percent;
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