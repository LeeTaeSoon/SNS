<?
	function db_connect()
	{
		$db = new PDO("mysql:dbname=seesaw;host=upgle.c912opl0pwpf.ap-northeast-2.rds.amazonaws.com", "seesaw", "xotns");		// db 와 연결
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}