<?php
$debut = microtime(true);

session_start();  
if (!isset($_SESSION['pseudo'])) 
{ 
header ('Location: index.php'); 
exit();  
}  
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>panel d'admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		 <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
    <body>

	
<?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());




/*-----------------------------------------------------
Vérification 1 : est-ce qu'on veut ajouter une page ?
-----------------------------------------------------*/
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'ajout_page' )
	{
		$id_page = $_POST['id_page'];
		$titre = $_POST['titre'];

		$heure = $_POST['heure'];
		$minute = $_POST['minute'];
		$mois = $_POST['mois'];
		$jour = $_POST['jour'];
		$annee = $_POST['annee'];

		
		$nbr_page_titre = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM page WHERE titre='$titre'") or die(mysql_error());
		$tableau_nbr_page_titre = mysql_fetch_array($nbr_page_titre) or die(mysql_error());
		
		
		if ($tableau_nbr_page_titre['nbre_entrees'] == "1")
		{
			echo "Probleme : Ce nom de page est déjà utilisé!";
		}
		else
		{
			$date = mktime ($heure, $minute, 0, $mois, $jour, $annee);

			
			mysql_query("INSERT INTO page VALUES('', '" . $id_page . "', '" . $date . "', '', '" . $titre . "')") or die(mysql_error()); 
			
			echo "page ajoutée!";
		}

	}

/*-------------------------------------------------------
Vérification 2 : est-ce qu'on veut supprimer une page ?
--------------------------------------------------------*/

	elseif ($_POST['action'] == 'supprimer_page')
	{
		$page = $_POST['page'];
		
		mysql_query("DELETE FROM contenu WHERE page='$page'") or die(mysql_error());
		mysql_query("DELETE FROM page WHERE titre='$page'") or die(mysql_error());
	}
}

?>
<h3><a href="general.php">Configuration general</a></h3>
<h3><a href="check.php">Checklist</a></h3>
<h3><a href="module.php">Module</a></h3>
<h3><a href="creer_page.php">Ajouter une page</a></h3>
<h3><a href="index.php">Retour a l'index</a></h3>

<br />
<br />

<table class="tabb1px"><tr>
<th>Titre</th>
<th>Modifier</th>
<th>Supprimer</th>
<th>Date de creation</th>
<th>Date de modification</th>
<th>page vide ?</th>
</tr>
<?php
$table_page = mysql_query('SELECT * FROM page ORDER BY id_page') or die(mysql_error());
while ($tableau_table_page = mysql_fetch_array($table_page))
{
?>
	<tr>
	<td>
		<?php echo stripslashes($tableau_table_page['titre']); ?>
	</td>
	<td>
	<form method="post" action="rediger_page.php">
		<input type="hidden" name="page" value="<?php echo $tableau_table_page['titre']; ?>" />
		<input type="submit" value="modifier" />
		</form>
	</td>
	<td>
		<form method="post" action="liste_page.php">
		<input type="hidden" name="action" value="supprimer_page" />
		<input type="hidden" name="page" value="<?php echo $tableau_table_page['titre']; ?>" />
		<input type="submit" value="supprimer" />
		</form>
	</td>
	<td>
		le <?php echo date('d/m/Y', $tableau_table_page['timestamp']); ?><br /> à <?php echo date('H:i', $tableau_table_page['timestamp']); ?>
	</td>
	<td>
		<?php
		if($tableau_table_page['timestamp2'] == '0')
		{
		  echo "aucune modification";
		}
		else
		{
		  echo "le ", date('d/m/Y', $tableau_table_page['timestamp2']); ?><br /> à <?php echo date('H:i', $tableau_table_page['timestamp2']);
		}
		 
		?>
	</td> 
	<td>
		<?php
		$contenu=mysql_query("SELECT * FROM contenu WHERE page='" . $tableau_table_page['titre'] . "'");
		$tableau_contenu=mysql_fetch_array($contenu);
		if($tableau_contenu['id'] == false)
		{
			echo "oui";
		}
			else
		{
			echo "non";
		}
		?>
	</td>
	</tr>

<?php
}
?>

</table>
<?php
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>