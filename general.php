<?php
$debut = microtime(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Rédiger une news</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
    <body>
<?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'modif')
	{		
		$page_index = $_POST['page_index'] ;
		$nom_site = $_POST['nom_site'] ;
		$status_site = $_POST['status_site'] ;
		
		mysql_query("UPDATE config SET valeur='" . $page_index . "' WHERE nom='index'") or die(mysql_error()); 
		mysql_query("UPDATE config SET valeur='" . $nom_site . "' WHERE nom='nom_site'") or die(mysql_error()); 
		mysql_query("UPDATE config SET valeur='" . $status_site . "' WHERE nom='status'") or die(mysql_error()); 
		echo "index modifiée!";
	}
}	
	
?>
<a href="liste_page.php">Retour à la liste des pages</a>

		<form action="general.php" method="post">
		   <p> 
				page index : 
				<select name="page_index">
	<?php
	$page_index = mysql_query("SELECT valeur FROM config WHERE nom='index'") or die(mysql_error());
	$tableau_page_index = mysql_fetch_array($page_index) or die(mysql_error());

	$titre_page = mysql_query('SELECT id, titre FROM page') or die(mysql_error());
	while ($tableau_titre_page = mysql_fetch_array($titre_page))
	{
	   if($tableau_page_index['valeur'] == $tableau_titre_page['titre'])
	   {
	   echo "<option value=" . $tableau_titre_page['titre'] . " selected=selected>" . $tableau_titre_page['titre'] . "</option>";
	   }
	   else
	   {
	   echo "<option value=" .$tableau_titre_page['titre']. ">" . $tableau_titre_page['titre'] . "</option>";
	   }
		
	}

	?>
				</select>
			</p>
			<br />

			<p> 
			nom du site : 
<?php
$SQL_nom_site = mysql_query("SELECT valeur FROM config WHERE nom='nom_site' ") or die(mysql_error());
$tableau_nom_site = mysql_fetch_array($SQL_nom_site);
$nom_site = $tableau_nom_site['valeur'];
?>	

<input type='text' size='25' name='nom_site' value="<?php echo $nom_site; ?>" />



			</p>
			<br />
			
			
						<p> 
			status du site : 
				<select name="status_site">
	<?php
	$status_actuel_SQL = mysql_query("SELECT valeur FROM config WHERE nom='status'") or die(mysql_error());
	$tableau_status_actuel_SQL = mysql_fetch_array($status_actuel_SQL) or die(mysql_error());
	
	$i=0;
	$tableau_status = array ("ouvert", "maintenance", "fermeture", "redirection", "personalise");
	while ($i < 5)
	{
	   if($tableau_status["$i"] == $tableau_status_actuel_SQL['valeur'])
	   {
	   echo "<option value=" . $tableau_status["$i"] . " selected=selected>" . $tableau_status["$i"] . "</option>";
	   }
	   else
	   {
	   echo "<option value=" .$tableau_status["$i"]. ">" . $tableau_status["$i"] . "</option>";
	   }
	$i=$i+1;
	}

	?>
				</select>
			</p>
			<br />
			
			<input type="hidden" name="action" value="modif" />	
			<input type="submit" value="Envoyer" />
		</form>
	</body>
</html>
<?php 
mysql_close();

$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';

?>