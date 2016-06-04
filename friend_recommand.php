<?
	include("db_connect.php");

	if(!isset($_SESSION))
		session_start();

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];

	if(!$id)
		header("Location: login.php");

	include("function.php");
?>

<!DOCTYPE html>

<html>
<head>
	<title> See Saw </title>

	<link rel="stylesheet" type="text/css" href="init-style.css">
	<link rel="stylesheet" type="text/css" href="menubar.css">
	<link rel="stylesheet" type="text/css" href="film_div.css">
	<link rel="stylesheet" type="text/css" href="timeline.css">
</head>

<body>
	<div id="page-wrapper">
<?	
		show_menubar();

		try
		{

			$db = db_connect();
			$t_id = $db->quote($id);

			$f_recommands = "select fid, count(*) as cnt from (";
			$f_recommands .= "select fid from friend where id in (";
			$f_recommands .= "select fid from friend where id=$t_id)";
			$f_recommands .= " )as t where t.fid not in (";
			$f_recommands .= "select fid from friend where id=$t_id)";
			$f_recommands .= " group by fid";
			$f_recommands .= " order by cnt desc";

			$recommands = $db->query($f_recommands);

			$recommandCount = $recommands->rowCount();

			for($i = 0; $i < ceil($recommandCount / 4); $i++)
			{
				//////////////////////// 한 필름 ////////////////////////
?>
				<div class="blank"></div>
<?
				include("film_div.php");
?>
				<div class="timeline-board">
<?
					for($j = 0; $j < $recommandCount - $i*4; $j++)
					{
						if($j > 3)
							break;

						$recommand = $recommands->fetch();
						$fid = $db->quote($recommand["fid"]);
?>
						<a href="show.php?num=<?= $recommand['num'] ?>">
							<div class="timeline-article">
							
								<?= stripcslashes(nl2br($recommand["fid"])) ?>

							</div>
						</a>
<?
					}
?>
				</div>
<?
				include("film_div.php");

				/////////////////////////////////////////////////////////
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
	</div>
</body>
</html>