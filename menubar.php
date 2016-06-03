<div class="menu-bar">
	<a href="timeline.php">
		<div class="logo">
			<img src="image/logo.png">
		</div>
	</a>

	<input type="checkbox" id="check">

	<div class="simple-menu">
		<a href="write.php" class="menu">
			글쓰기
		</a>

		<a href="friends.php">
			<div class="icon">
				<img src="image/friend.png">
			</div>
		</a>

		<div class="icon">
			<label for="check"><img src="image/alarm.png"></label>
		</div>
	</div>

	<div class="alarm">
		ㅇㅇ
	</div>

	<div class="user-menu">
		<div class="user-name">
			<a href="user_page.php?id=<?= $id ?>"><span class="name"> <?= $name ?></span> 님 </a>
		</div>

		<div class="logout-button">
			<a href="logout.php">로그아웃</a>	
		</div>
	</div>

	<div class="all-menu-button">
		<img src="image/menu-icon.png" class="menu-icon">
	</div>
</div>