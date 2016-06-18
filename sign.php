<?
	if(!isset($_session)){session_start();}
?>

<!DOCTYPE html>

<html>

	<head>
		<title> See Saw </title>
		<link rel="stylesheet" type="text/css" href="init-style.css">
		<link rel="stylesheet" type="text/css" href="sign.css">
		<link rel="stylesheet" type="text/css" href="menubar.css">
	</head>

	<body>
		
		<div id="page-wrapper">

			

			<div class="sign-page">
				<div id ="sign-menubar">
					<img src="image/logo.png"></img>
					<h1>See Saw </h1>
				</div>
				
				
				
				
				<div id="sign-title">
					<h1>See Saw 회원가입</h1>
				</div>

				 <form action="member.php" method="post">
				 	<table border="1">
				 	<tr>
				 		<th align="right">*&nbsp아이디&nbsp:&nbsp</th>
				 		<td colspan="4" width="500"><input type="text" size="15"maxlength="12"name="id">
				 			<div id="id_flash">
								<?=$_SESSION['id_flash']?>
							</div>
							<? unset($_SESSION['id_flash']);?>
						<br/></td>
				 	</tr>
				 	 <tr>
				 		<th align="right">*&nbsp이름&nbsp:&nbsp</th>
				 		<td colspan="4"><input type="text" size="15"maxlength="12"name="name"><br/></td>
				 	</tr>
				 	 <tr>
				 		<th align="right">*&nbsp비밀번호&nbsp:&nbsp</th>
				 		<td colspan="4"><input type="password" size="15"maxlength="10"name="password1">
				 			<div id="passwd_flash">
								<?=$_SESSION['flash']?>
							</div>	
							<? unset($_SESSION['flash']);?>
				 		<br/></td>
				 	</tr>
				 	<tr>
				 		<th align="right">*&nbsp비밀번호 확인&nbsp:&nbsp</th>
				 		<td colspan="4"><input type="password" size="15"maxlength="10"name="password2"><br/></td>
				 	</tr>
				 	<tr>
				 		<th align="right">* &nbsp좋아하는 장르 &nbsp:&nbsp</th>
						<td class="genre" style="border-left: 1px solid; border-right: 0px none; border-top: 1px solid; border-bottom: 1px solid" bordercolor="#CCCCCC" >
							<input type="checkbox" name="genre1" value="action" checked>액션</input><br>
							<input type="checkbox" name="genre2" value="adventure">모험</input><br>
							<input type="checkbox" name="genre3" value="animation">애니메이션</input><br>
							<input type="checkbox" name="genre4" value="comedy">코미디</input><br>
							<input type="checkbox" name="genre5" value="crime">범죄</input></td>
						<td class="genre" style="border-left: 0px none; border-right: 0px none; border-top: 1px solid; border-bottom: 1px solid" bordercolor="#CCCCCC" >
							<input type="checkbox" name="genre6" value="doucumentary">다큐멘터리</input><br>
							<input type="checkbox" name="genre7" value="drama">드라마</input><br>
							<input type="checkbox" name="genre8" value="family">가족</input><br>
							<input type="checkbox" name="genre9" value="fantasy">판타지</input><br>
							<input type="checkbox" name="genre10" value="noir">느와르</input></td>
						<td class="genre"style="border-left: 0px none; border-right: 0px none; border-top: 1px solid; border-bottom: 1px solid" bordercolor="#CCCCCC">
							<input type="checkbox" name="genre11" value="history">역사</input><br>
							<input type="checkbox" name="genre12" value="horror">공포</input><br>
							<input type="checkbox" name="genre13" value="musical">뮤지컬</input><br>
							<input type="checkbox" name="genre14" value="mystery">미스터리</input><br>
							<input type="checkbox" name="genre15" value="romance">로맨스</input></td>
						<td class="genre" style="border-left: 0px none; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid" bordercolor="#CCCCCC" >
							<input type="checkbox" name="genre16" value="sciencefiction">공상 과학</input><br>
							<input type="checkbox" name="genre17" value="sport">스포츠</input><br>
							<input type="checkbox" name="genre18" value="thriller">스릴러</input><br>
							<input type="checkbox" name="genre19" value="westemdrama">서부극</input><br>
							<input type="checkbox" name="genre20" value="war">전쟁</input>
						</td>
				 	</tr>
				 	</table>
				 	<input type="hidden" name="proimg" value="./image/profile_img/profile.png">
				 	<input type="submit" value="회원 가입"></input>
				</form>
			</div>

		</div>
	
	</body>

</html>