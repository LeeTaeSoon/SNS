<?
try
{

	function login_ok($id, $passwd)
	{
		include("db_connect.php");

		$db = db_connect();

		$user_table = "user";

		$t_id = $db->quote($id);
		$t_passwd = $db->quote($passwd);

		$users = $db->query("SELECT * FROM $user_table WHERE id=$t_id and passwd=$t_passwd");

		if($users->rowCount())
		{
			$user = $users->fetch();
		}

		if(isset($user))
		{
			session_start();

			$_SESSION["id"] = $id;
			$_SESSION["name"] = $user["name"];
			return true;
		}

		return false;
	}

	function show_article($article)
	{
		global $db;

		$num = $article["num"];

		$writers = $db->query("SELECT name FROM user INNER JOIN article ON user.id=article.id WHERE num=$num");
		if(isset($writers))
			$writer = $writers->fetch();
		else
			echo "Can't find a writer";
		echo "작성자 : ".$writer['name']."<br>";

		$article_content = stripslashes(nl2br($article['content']));
		echo $article_content;
	}

}

	catch (PODException $ex)
	{
?>
		<p> Sorry, a database error occurred. Please try again later. </p>
		<p> (Error details : <?= $ex->getMessage() ?>) </p>
<?
	}
?>