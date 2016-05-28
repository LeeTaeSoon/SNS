<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

?>


<html>

<head>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="show.css">
</head>


<body>

<div id="top">
 	<? include("menubar.php") ?>
</div>


<div id ="pagewrapper" >
	<? include("film_div.php") ?>
	
	<div id= "go-left">
		<a href ="#"><img src="left.png" width="80" height="80" ></a>
	</div>
	
	<div id ="content">
		<div id ="article">
		
	<!-- 	try{$db = new PDO("mysql:dbname=db_ip;host=localhost","root","apmsetup");
 	 			$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	
 -->
		</div>

		<div id = "comment">
			<div id="show_comment">
				<?	//$query = "select*from reply";
				// 	$rows = $db->query($query);
					
				// 	$n = $rows->rowCount();
					
				// 	for($i=0; $i < $n ; $i = $i+1)
				// 	{	
				// 		$row = $rows->fetch();
				// 		$comment = $row[1];

					?>
					<table> 
						<tr>
							<th> 작성자 </th>
						</tr>
						<tr>
							<td><? echo $comment?></td>
						</tr>
					</table>
				<?	
					//} 
				?>
			</div>
	
			<div id = "plus_comment">
				<form action="add_comment.php" method="GET">
					<input type="text" name="comment" value="댓글을 달아 보세요">
					<input type="submit" value="입력"> 
				</form>
			</div>	
		</div>

	</div>
	<? include("film_div.php") ?>
</div>
</body>
