<?php
if ( isset($_POST['pseudo']) && isset($_POST['pass']) )
{
	if (empty($_POST['pseudo'])) 
	{
	echo "le champ pseudo n'a pas été remplie !";
	}
	elseif (empty($_POST['pass'])) 
	{
	echo "le champ pass n'a pas été remplie !";
	} 
	else
	{

				
		
		$sql = 'SELECT count(*) FROM user WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'" AND pass="'.md5(mysql_escape_string($_POST['pass'])).'"'; 
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
		$data = mysql_fetch_array($req);

		mysql_free_result($req);
		
		if ($data[0] == 1) {  
			$_SESSION['pseudo'] = $_POST['pseudo'];
		} 

		else
		{
			echo "mauvais pseudo ou pass!<br /><br />";
		}
	}
}

if (isset ($_POST['deco']))
{
	session_unset();  
	session_destroy(); 

	echo "<meta http-equiv='Refresh' content='2;URL=index.php'>";

	echo "delog!";
}

if (!isset($_SESSION['pseudo']))
{
?>
	<table>
		<tr>
			<td>
				<form method="post" action="index.php">
					Pseudo : <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>" /> &nbsp; Pass : <input type="text" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>" /> &nbsp; <input type="submit" value="envoyer" /> &nbsp; <input value="reset" type="reset" />
				</form>
			</td>
			<td>
				<a href="comm_inscription.php">Inscription</a>
				&nbsp;&nbsp;<a href="" >Mot de passe oublier?</a>
			</td>
		</tr>
	</table>
<?php
}
if(isset($_SESSION['pseudo']))
{
?>
	<table>
		<tr>
			<td>
			<?php echo "Bonjour ".$_SESSION['pseudo']." !"; ?>
			</td>
			<td>
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