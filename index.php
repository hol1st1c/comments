<?
//пожключение к базе данных
$db = mysqli_connect('localhost', 'root', '', 'coment'); 
// если не подключились то почему
if (mysqli_connect_errno() )
{
	echo 'причина ошибки в подключении ('.mysqli_connect_errno().') ';
	exit();
}
$sql = "select * from com order by id desc limit 10";
$result = mysqli_query($db, $sql);
?>

<html>
	<head>
		<link rel="stylesheet" href="css/test1.css" type="text/css"/>
		<meta charset="utf-8">
		<title>Комментарии</title>
	</head>
	
	<body>
		<div id="block">
			<div id="name_page">
				<span id="name_text">Оставляйте свои комментарии</span>
			</div>
			<br />
			<div id="content_img">
				<img src="img/corvet.png" alt="Тут был синий корвет(" width="700" title="Blue Chevrolet Corvette Z06 Top " /> 
				<div id="opis_img">Blue Chevrolet Corvette Z06 Top</div>
			</div>
			<br />
			<div id="comments">
				<div id="new_comments">
				<?
				 if (isset($_POST["name"])&&isset($_POST["text"])) {
					 if ( ( $_POST["name"]!="")&& ($_POST["text"]!="")&&($_POST["c2"]!="") )
					{
						if ( $_POST["c1"]==$_POST["c2"]  ) 
						{
						 		//echo '<script>alert("c1='.$_POST["c1"].' c2='.$_POST["c2"].'");</script>';
								$id="null";
								$date="now()";
								$iamge="";
								$sql = mysqli_query($db, "INSERT INTO `com` (`id`, `date`, `name`, `text`, `image`)
								VALUES ({$id}, {$date}, '{$_POST['name']}', '{$_POST['text']}', '{$image}')");
								echo '<meta http-equiv="refresh" content="0;URL=/index.php?">';
								
						}
						else
						{
							//echo '<script>alert("c1='.$_POST["c1"].' c2='.$_POST["c2"].'");</script>';
							echo '<script>alert("Капча введена не верно");</script>';
						}
					}
					else
					{
						echo '<script>alert("Заполните все поля ввода");</script>';
					}
				}
				?>
					<form id="add_com" action="index.php" method="post">
						<input name="name" id="name "type="text" maxlength="20" placeholder="Ваше имя"></input>
						<br />
						<textarea name="text" id="text" maxlength="256"  placeholder="Ваш комментарий"></textarea>
						<br />
						<div  id="capth">
							<p style="margin-left:25px; margin-top:0px; margin-bottom:0px; color:white;">Введите капчу</p>
							<input name="c1" id="v_capth" readonly></input>
						</div>
						<input name="c2" id="kapch" maxlength="6" type="text" placeholder="Капча"></input>
						<br />
						<input id="subform"  type="submit" onclick="enter()" value="Оставить комментарий"></input>
					</form>
				</div>
				<div id="all_comments">
					<div id="other_com">Комментарии</div>
					<div id="bl_com">
					<form method="get" action="">
					<?
						while ($row = mysqli_fetch_array($result, 1) )
							{
								echo '<div id="u_c"  >';
								echo "<div id='n_c'>".$row["name"]."</div> ";
								echo "<input type=date id='d_c' disabled value=".$row["date"]."></input><br /><br />";
								echo "<div id='t_c'>".$row["text"]."</div> ";
								echo "<a  href='/index.php?id=".$row["id"]."'>Удалить комментарий</a>";
								echo "</div>";
							}
							if (isset($_GET["id"]) )
							{
							$result = mysqli_query($db, "DELETE FROM `com` WHERE id = ".$_GET["id"]." ");
							echo '<meta http-equiv="refresh" content="0;URL=/index.php">';
							}
					?>
					</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="js/test1.js"></script>
	<a id="info" target="_blank" href=" info.html">(описание возможностей сайта)</a>
</html>