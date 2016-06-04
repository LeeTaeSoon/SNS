<?
try
{

	function login_ok($id, $passwd)
	{
		include("db_connect.php");

		$db = db_connect();

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

	function show_menubar($page = NULL)
	{
		global $id;
		global $name;
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

			<div class="alarm">
				ㅇㅇ
			</div>

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

		$writers = $db->query("SELECT name FROM user INNER JOIN article ON user.id=article.id WHERE num=$num");
		if(isset($writers))
			$writer = $writers->fetch();
		else
			echo "Can't find a writer";
		echo "작성자 : ".$writer['name']."<br>";

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

}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
?>