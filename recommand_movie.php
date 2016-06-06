<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	try 
	{
		$table = "recommand_movie";

		$sender = $db->quote($id);
		$receiver = $db->quote($_GET["receiver"]);
		$movie = $db->quote($_GET["movie"]);
		//$link = $db->quote($_GET["link"]);

		//if($db->exec("INSERT INTO $table (sender, receiver, movie, link) values ($sender, $receiver, $movie, $link)"))
		if($db->exec("INSERT INTO $table (sender, receiver, movie) values ($sender, $receiver, $movie)"))
		{
			header("Location: movie_list.php");
		}

		else
		{
			echo "Fail to insert recommand movie in datebase";
			exit(1);
		}

	}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}