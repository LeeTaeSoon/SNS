<?
	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");

	if(isset($_FILES))
	{
		$save_dir = "./image/article_bg_img/";

		if(is_uploaded_file($_FILES["uploadfile"]["tmp_name"]))
		{
			//echo "업로드한 파일 명 : " . $_FILES["uploadfile"]["name"];
			// 파일을 저장할 디렉토리 및 파일명
			$dest = $save_dir.$_FILES["uploadfile"]["name"];
			//파일을 지정한 디렉토리에 저장
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $dest))
				$imgurl = $save_dir.$_FILES["uploadfile"]["name"];
			//	echo "success";
			//else
			//	echo "fail2";
		}
		//else
			//echo "no uploadfile";
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
 	<? show_menubar(); ?>
</div>


<div id ="pagewrapper" >
	<? include("film_div.php") ?>
	
	<div id ="content">
		<div id ="article" >

			<form action="save_article.php" method="post">
				<div>
				<textarea id="textarea" name="content"style="background-image: url(<?= $imgurl ?>)"></textarea>
				</div><br>
				
				<table id="menu1">
					<tr>
						<td>
							영화 제목 :
						</td>
						<td>
							<? include("autocomplete.php"); ?>
						</td>
					</tr>
					<tr>
						<td><br>
							영화 평점 :
						</td>
						<td><br>
							<select name="m_grade">
									<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
							</select>
						</td>
					</tr>

					<tr>
						<td><br>
							권한 설정 :
						</td>
						<td><br>
								<select name="access">
									<option value="all" selected>전체 공개</option>
									<option value="friend">친구 공개</option>
									<option value="secret">비공개</option>
								</select>
						</td>
					</tr>
					<tr>
			<td><br>스포 일러 :</td>
			<td><br>
				<input type="radio" name="spoiler" value="yes">있음</input>&nbsp&nbsp
				<input type="radio" name="spoiler" value="no">없음</input>
			</td>
		</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="hidden" name="bgimg" value="<?= $imgurl ?>"><br>
							<input id="submit1" type="submit" value="작        성" style="background-color: black">
						</td>
					</tr>
		
	</table><br><br>
			</form>

			
			<form enctype="multipart/form-data" action="" method="post">
		 		<table id="menu2">
		 			<tr>
		 				<td>배경 설정 :</td>
		 			</tr>
		 			<tr>
		 				<td colspan="2">
		 		<div id ="imgload">
			 		<input name="uploadfile" type="file">
			 	</td>
			 	</tr>
			 		<tr>
			 			<td colspan="2" align="right"><br>
			 		<input type="submit" value="배경 설정"></input>
			 	</div>
			 </td>
			</tr>
		</table>
		 	</form>

		 </div>	
	</div>
	<? include("film_div.php") ?>
</div>
</body>