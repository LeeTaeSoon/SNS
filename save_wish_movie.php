<?if(!isset($_SESSION))
	session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	$movie = $_GET["movie"];
	$mimage = $_GET["mimage"];

	$t_id = $db->quote($id);
	$movie = $db->quote($movie);
	$mimage = $db->quote($mimage);

	$query="insert into wish_movie(id,movie,image)";
	$query.=" values($t_id,$movie,$mimage)";

	$result = $db->exec($query);
	
	if(isset($result))
	{
		$_SESSION['flash']="성공적으로 보고싶은 영화에 추가";
	}
	header("Location:movie_list.php");

?>