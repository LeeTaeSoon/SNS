<? 	if(!isset($_session)){session_start();}
	include('function.php');



	  for($i=1; $i<20;$i++)
	  {
	  		if(isset($_POST["genre$i"]))
		 	$genre.=$_POST["genre$i"]." ";
	 	}
	$genre = $db->quote($genre);
	$id = $db->quote($_POST["id"]);
	$password1 = $db->quote($_POST["password1"]);
	$password2 = $db->quote($_POST["password2"]);
	$name = $db->quote($_POST["name"]);
	$proimg = $db->quote($_POST["proimg"]);
	
	$query1 ="SELECT id from user where id!=$id";
	$result1 = $db->query($query1);
	if(isset($result1))
	{
		
		header("location:login.php");
	}
	else
	{
		$_SESSION['id_flash']="ID가 이미 있습니다.";
		header("loacation:sign.php");
	}

	if($password1 != $password2)
	{	
		unset($_SESSION['id_flash']);
		$_SESSION['flash']="비밀번호가 일치 하지 않습니다.";
		header("location:sign.php");
	}
	else
	{
		header("loacation:login.php");
	}


	 $query="insert into user(id,name,passwd,proimg)";
	 $query.="values($id,$name,$password1,$proimg)";
	
	 $result = $db->exec($query);
?>