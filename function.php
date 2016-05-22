<?
	function login_ok($filename, $id, $passwd)
	{
		$userfile = file_get_contents($filename);

		if($userfile)
		{
			$temp = explode(PHP_EOL, $userfile);
			$users = array();

			foreach ($temp as $key => $info)
			{
				list($users[$key]["id"], $users[$key]["passwd"]) = explode(" ", $info);
			}

			foreach ($users as $key => $user) {
				if($user["id"] == $id && $user["passwd"] == $passwd)
				//	return true;
				{
					session_start();

					$_SESSION["id"] = $id;
					$_SESSION["passwd"] = $passwd;
					return true;
				}
			}

			return false;
		}
	}
?>