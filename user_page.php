<!DOCTYPE html>
<html>
<!-- <?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");
	
?> -->

<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="user_page.css">

</head>

<body>
	<div id="top">
		<?include("menubar.php");?>	
	</div>


	<div id="cover">
			<!-- <? ?> -->
		<div id="profile_picture">
			<!-- <? ?> -->
			<img id="profile" src="#"> <input type="file">
		</div>

		<div id="menu">
				<label class="mymenu" for="my_article">내가 쓴글</label>
				<label class="mymenu" for="saw_movie">내가 본 영화</label>
				<label class="mymenu" for="interest_movie">관심 있는 영화</label>
				<label class="mymenu" for="friends">친구 목록</label>
		</div>
	</div>

	<input type="radio" id="my_article" name="tab" value="my_article">
	<input type="radio" id="saw_movie" name="tab" value="saw_movie">
	<input type="radio" id="interest_movie" name="tab" value="interest_movie">
	<input type="radio" id="friends" name="tab" value="friends">

	<div id = "my_article" class="content">

		12366
		

	</div>
	
	<div id = "saw_movie" class="content">

		2
	</div>
	
	<div id= "interest_movie" class="content">
	3
	</div>

	<div id= "friends" class="content">
	4
	</div>


</body>




</html>