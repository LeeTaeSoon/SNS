<?
try {
	include("function.php");

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	$content = $_POST["content"];
	$bgimg = $_POST["bgimg"];
	$time = date("Y-m-d h:i:s", time());
	$access = $_POST["access"];
	//$movie = $_POST["movie"];
	$searchbox = $_POST["searchbox"]; //영화 제목
	$m_grade=$_POST["m_grade"]; //평점

	//
		
		$m_grade = $db->quote($m_grade);
		$id = $db->quote($id);

		echo $searchbox;
		$movie_image = search_movie($searchbox,100,1,NULL,NULL,NULL,NULL,NULL);
		echo $movie_image;
		//$short_url = $xml->channel->item->image; 
		//$short_url = var_dump((string) $movie_image->channel->item->image); 
		//echo "movie".$short_url;

		$searchbox = $db->quote($searchbox);

		$query = "SELECT * FROM see_movie WHERE id=$id and movie=$searchbox";
		$sees = $db->query($query);
		if($sees->rowCount())
		{
			//$db->exec("UPDATE see_movie SET grade=$m_grade WHERE id=$id and movie=$searchbox");
		}

		else 
		{
			$query="insert into see_movie(id,movie,grade,image)";
			$query.=" values($id,$searchbox,$m_grade,$mimage)";

			//$result = $db->exec($query);
		}
	//

	$table = "article";
	$articles = $db->query("SELECT num FROM $table");

	if($articles->rowCount() < 1)
		$num = 0;

	else
	{
		$temp = $db->query("SELECT * FROM $table ORDER BY num DESC LIMIT 1");
		$temp = $temp->fetch();
		$num = $temp["num"] + 1;
	}

	$t_id = $db->quote($id);
	$t_content = $db->quote($content);
	$t_bgimg = $db->quote($bgimg);
	$t_time = $db->quote($time);
	$t_access = $db->quote($access);
	//$t_movie = $db->quote($movie);

	$db->exec("INSERT INTO $table (num, id, content, bgimg, time, access/*, movie*/)
			values ($num, $t_id, $t_content, $t_bgimg, $t_time, $t_access)/*, $t_movie*/");

	//header("Location: timeline.php");
}

catch (PODException $ex)
{
?>
	<p> Sorry, a database error occurred. Please try again later. </p>
	<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
}