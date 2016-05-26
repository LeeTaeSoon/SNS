<?
	$db = new PDO("mysql:dbname=db_ip;host=localhost", "root", "apmsetup");		// db 와 연결
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$user_table = "member";