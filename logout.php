<?
	if(!isset($_SESSION))
		session_start();

	if(isset($_SESSION["name"]))
	{
		session_destroy();
		session_regenerate_id(true);
		session_start();
	}

	header("Location: login.php");
?>