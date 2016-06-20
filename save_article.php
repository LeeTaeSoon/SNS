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

	if($searchbox!=NULL){

		
		$m_grade = $db->quote($m_grade);
		$t_id = $db->quote($id);

		$movies = search_movie($searchbox, 1, 1, NULL, NULL, NULL, NULL, "sim");

	    foreach($movies->channel->item as $movie){

		    $searchbox_m = $db->quote($movie->image);

			$query = "SELECT * FROM see_movie WHERE id=$t_id and movie=$searchbox_m";

			$searchbox = $db->quote($searchbox);
			$sees = $db->query($query);
			
			if($sees->rowCount())
			{
				$db->exec("UPDATE see_movie SET grade=$m_grade WHERE id=$idd and movie=$searchbox_m");
			}

			else 
			{
				$query="insert into see_movie(id,movie,grade,image)";
		        $query.=" values($t_id,$searchbox,$m_grade,$searchbox_m)";
		        //echo $query;
		        $result = $db->exec($query);
			}
		}

	}else{
	//
	}

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

	header("Location: timeline.php");
}

catch (PODException $ex)
{
?>
	<p> Sorry, a database error occurred. Please try again later. </p>
	<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
}