<?
	
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

?>
<html>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="friends.css">

<body>
	<div id="top">
	 	<? show_menubar(); ?>
	</div>

	<div id="friends_menu">
		<div id="label_menu">
			<label class="mymenu" for="recommand">알 수도 있는 사람</label>
			<label class="mymenu" for="find">USER 검색</label>
			<label class="mymenu" for="favorite">취향 비슷한 사람</label>
		</div>
	</div>

	<input type="radio" id="recommand" name="tab" value="my_article">
	<input type="radio" id="find" name="tab" value="saw_movie" checked="checked">
	<input type="radio" id="favorite" name="tab" value="favor_person">
	
	<div id="friends_recommand">
			<? include("friend_recommand.php"); ?>
	</div>

	<div id="friends_find">
	<br><br><br>
		<h3 style="text-align:center"> 친구가 되고 싶은 USER 사용자를 검색 해보세요 </h3>

		<div id="nav">
			<form method="POST" action="">
				<input id="friend_search" type="text" name="user" >
				<input id="search_button" type="submit" value="검색">
			</form>
		</div>

		<table>
			<?	
				$abc = $_POST["user"];
				if(isset($abc))
				{
					$search_name = $db->quote('%'.$_POST["user"].'%');
					$query = "SELECT*from user where name like $search_name";
					$rows = $db->query($query); 
					$n = $rows->rowCount();
					

					for($i=0; $i < $n ; $i = $i+1)
					{	
						$row = $rows->fetch();
			?> 	    
					<tr>
						<td><img src=<?=$row["proimg"]?>></td>
						<td>NAME<br><?=$row["name"]?></td>
						<td><a href="add_friend.php?id=<?=$_SESSION['id']?>&fid=<?=$row['id']?>"
							onclick="return confirm('<?=$row['name']?>를 친구로 추가하시겠습니까?');"><input type="submit"value="친구 신청"></a>
						</td>
					</tr>
				<?  }
			    } ?>
		</table>

	</div>

	<div id="friends_favorite">
			<? include("friend_favorite.php"); ?>
	</div>

</body>


</html>