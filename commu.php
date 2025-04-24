<?php

if ( isset($_POST['pseudo']) && isset($_POST['pass']) )
{
	mysql_connect("localhost", "root", "root") or die(mysql_error());
	mysql_select_db("admin") or die(mysql_error());
	$pseudo = $_POST['pseudo'];
	$data = mysql_query("SELECT pseudo, pass FROM comm WHERE pseudo='$pseudo'") or die(mysql_error());
	$tableau_data = mysql_fetch_array($data);
	
	
	if ($tableau_data['pass'] == $_POST['pass'] && $tableau_data['pseudo'] == $_POST['pseudo'] )
	{
		echo "logging!";
		$_SESSION['pseudo']= $_POST['pseudo'];
		$_SESSION['pass']= $_POST['pass'];
		echo "<meta http-equiv='Refresh' content='5;URL=index.php'>";
	}

	else
	{
		echo "mauvais pseudo ou pass!<br /><br />";
	}
}



if (isset ($_POST['deco']))
{
session_destroy();

echo "<meta http-equiv='Refresh' content='2;URL=index.php'>";

echo "delog!";
}

if (!isset($_SESSION['pseudo']) && !isset($_SESSION['pass']))
{
?>
<table width="100%" style="border:0px;">
	<tr>
		<td style="border:0px;" >
			<form method="post" action="index.php">
				Pseudo : <input type="text" name="pseudo" /> &nbsp; Pass : <input type="text" name="pass" /> &nbsp; <input type="submit" value="envoyer" /> &nbsp; <input value="reset" type="reset" />
			</form>
		</td>
	</tr>
</table>
		<?php
}
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
{
?>
<table width="100%" style="border:0px;">
	<tr>
		<td style="border:0px;">
		<?php echo "Bonjour ".$_SESSION['pseudo']." !"; ?>
		</td>
		<td style="border:0px;" width="70%" align="right">
			<form method="post" action="index.php">
				<input type="hidden" name="deco" value="1" />
				<input type="submit" value="deconnection" />
			</form>
		</td>
	</tr>
</table>
<?php
}

?>