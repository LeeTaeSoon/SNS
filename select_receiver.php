<?
	
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");


	$movie_name = $_REQUEST["movie"];
?>
<html>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="friends.css">

<body>

	<div id="top">
	 	<? show_menubar(); ?>
	</div>

	<div id="friends_find">
	<br>
		<h3 style="text-align:center"> 누구에게 추천할까요? </h3>

		<div id="nav">
			<form method="POST" action="">
				<input id="friend_search" type="text" name="user">
				<input id="search_button" type="submit" value="검색">
				<input type="hidden" name="movie" value="<?= $movie_name ?>">
			</form>
		</div>

		<table>
			<?	
				$abc = $_POST["user"];
				if(isset($abc))
				{
					$search_name = $db->quote($_POST["user"]);
					$query = "SELECT*from user where name=$search_name";
					$rows = $db->query($query); 
					$n = $rows->rowCount();
					

					for($i=0; $i < $n ; $i = $i+1)
					{	
						$row = $rows->fetch();
						$temp_id = $row["id"];
			?> 	    
					<tr>
						<td><img src=<?=$row["proimg"]?>></td>
						<td>NAME<br><?=$row["name"]?></td>
						<td>ID<br><?=$row["id"]?></td>
						<td><input type="button" value="추천" onclick=
							"location.href='recommand_movie.php?receiver=<?= $temp_id ?>&movie=<?= $movie_name ?>';"></td>
					</tr>
				<?  }
			    } ?>
		</table>

	</div>

</body>


</html>