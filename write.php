<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	if(1)
	{
		$save_dir = "./";

		if(is_uploaded_file($_FILES["uploadfile"]["tmp_name"]))
		{
			echo "업로드한 파일 명 : " . $_FILES["uploadfile"]["name"];
			// 파일을 저장할 디렉토리 및 파일명
			$dest = $save_dir.$_FILES["uploadfile"]["name"];
			//파일을 지정한 디렉토리에 저장
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $dest))
				echo "success";
			else
				echo "fail2";
		}
		else
			echo "no uploadfile";
	}
?>

<html>

<head>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="write.css">

</head>


<body>

<div id="top">
 	<? include("menubar.php") ?>
</div>


<div id ="pagewrapper" >
	<? include("film_div.php") ?>
	
	<div id ="content">
		<div id ="article">
			
			<form enctype="multipart/form-data" action="write.php" method="post">
				<textarea id="textarea"> </textarea>
				<img src='<?= $_FILES["uploadfile"]["name"] ?>'>;
		 		<div id ="imgload" >
			 		<input name="uploadfile" type="file">
			 		<input type="submit" value="upload"></input>
			 	</div>
		 	</form>

		 </div>	
	</div>
	<? include("film_div.php") ?>
</div>
</body>