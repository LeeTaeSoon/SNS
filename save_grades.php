<?if(!isset($_SESSION))
	session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$movie = $_GET["movie"];
	$grade = $_GET["grade"];
	$mimage = $_GET["mimage"];
	$murl = $_GET["murl"];

	$id = $db->quote($id);
	$movie = $db->quote($movie);
    $grade = $db->quote($grade);
	$mimage = $db->quote($mimage);
	$murl = $db->quote($murl);

	$query="insert into see_movie(id,movie,grade,image,link)";
	$query.=" values($id,$movie,$grade,$mimage,$murl)";

	$result = $db->exec($query);

	//header("Location:movie_list.php");

?>