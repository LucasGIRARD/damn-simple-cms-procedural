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
mysql_connect("localhost", "root", "root") or die(mysql_error()); // Connexion à MySQL
mysql_select_db("admin") or die(mysql_error()); 


if (isset ($_POST['action']))
{
$page = $_POST['page'];
}
else
{
$page = $_POST['page'];
}

if (isset ($_POST['action']))
{
/*--------------------------------------------------------
Vérification 1 : est-ce qu'on veut ajouter un élément?
--------------------------------------------------------*/

if ($_POST['action'] == 'ajout_element')
{
	$type_ajout = (isset($_POST['type_ajout'])?$_POST['type_ajout']:"");
	$id_element = (isset($_POST['id_element'])?$_POST['id_element']:"");
	
	$texte = (isset($_POST['texte'])?$_POST['texte']:"");
	$taille = (isset($_POST['taille'])?$_POST['taille']:"");
	$src = (isset($_POST['src'])?$_POST['src']:"") ;
	$href = (isset($_POST['href'])?$_POST['href']:"") ;
	$alt = (isset($_POST['alt'])?$_POST['alt']:"") ;
	$infobulle = (isset($_POST['infobulle'])?$_POST['infobulle']:"") ;
		
	$heure = (isset($_POST['heure'])?$_POST['heure']:"");
	$minute = (isset($_POST['minute'])?$_POST['minute']:"");
	$mois = (isset($_POST['mois'])?$_POST['mois']:"");
	$jour = (isset($_POST['jour'])?$_POST['jour']:"");
	$annee = (isset($_POST['annee'])?$_POST['annee']:"");
	
	$date = mktime ($heure, $minute, 0, $mois, $jour, $annee);
	

		
	
	mysql_query("INSERT INTO contenu VALUES('', '" . $id_element . "', '" . $date . "', '', '" . $type_ajout . "', '" . $page . "', '" . $texte . "', '" . $taille . "', '" . $src . "', '" . $href . "', '" . $alt . "', '" . $infobulle . "')") or die(mysql_error()); 
}

/*--------------------------------------------------------
Vérification 2 : est-ce qu'on veut modifier un élément?
--------------------------------------------------------*/

elseif ($_POST['action'] == 'modif_element')
{		
	$id = (isset($_POST['id'])?$_POST['id']:"") ;

	$id_element = (isset($_POST['id_element'])?$_POST['id_element']:"") ;
	$texte = (isset($_POST['texte'])?$_POST['texte']:"") ;
	$taille = (isset($_POST['taille'])?$_POST['taille']:"") ;
	$src = (isset($_POST['src'])?$_POST['src']:"") ;
	$href = (isset($_POST['href'])?$_POST['href']:"") ;
	$alt = (isset($_POST['alt'])?$_POST['alt']:"") ;
	$infobulle = (isset($_POST['infobulle'])?$_POST['infobulle']:"") ; 
	
	
	
	$heure = (isset($_POST['heure'])?$_POST['heure']:"");
	$minute = (isset($_POST['minute'])?$_POST['minute']:"");
	$mois = (isset($_POST['mois'])?$_POST['mois']:"");
	$jour = (isset($_POST['jour'])?$_POST['jour']:"");
	$annee = (isset($_POST['annee'])?$_POST['annee']:"");

	$heure_m = (isset($_POST['heure_m'])?$_POST['heure_m']:"");
	$minute_m = (isset($_POST['minute_m'])?$_POST['minute_m']:"");
	$mois_m = (isset($_POST['mois_m'])?$_POST['mois_m']:"");
	$jour_m = (isset($_POST['jour_m'])?$_POST['jour_m']:"");
	$annee_m = (isset($_POST['annee_m'])?$_POST['annee_m']:"");

	$date_c = mktime ($heure, $minute, 0, $mois, $jour, $annee);
	$date_m = mktime ($heure_m, $minute_m, 0, $mois_m, $jour_m, $annee_m);	

	
	mysql_query("UPDATE contenu SET id_element='" . $id_element . "', timestamp='" . $date_c . "', timestamp2='" . $date_m . "', page='" .$page. "', texte='" .$texte. "', taille='" .$taille. "', src='" .$src. "', href='" .$href. "', alt='" .$alt. "', infobulle='" .$infobulle. "' WHERE id='" . $id . "'") or die(mysql_error()); 
	echo "page modifiée!";
}

//--------------------------------------------------------
// Vérification 3 : est-ce qu'on veut modifier la position d'un element ?
//--------------------------------------------------------
elseif ($_POST['action'] == 'modif_position_element_+')
{
echo "+++";
	$id = $_POST['id'] ;
    $id_element = $_POST['id_element'];
	$new_position_element_sql = $id_element+1;
     mysql_query("UPDATE contenu SET id_element='" . $new_position_element_sql . "' WHERE id='" . $id . "'") or die(mysql_error()); 
}
elseif ($_POST['action'] == 'modif_position_element_-')
{
echo "---";
	$id = $_POST['id'] ;
    $id_element = $_POST['id_element'];
	$new_position_element_sql = $id_element-1;
     mysql_query("UPDATE contenu SET id_element='" . $new_position_element_sql . "' WHERE id='" . $id . "'") or die(mysql_error()); 
}

//--------------------------------------------------------
// Vérification 4 : est-ce qu'on veut supprimer un element ?
//--------------------------------------------------------
elseif ($_POST['action'] == 'supprimer_element') 
{
    $element_a_supprimer = $_POST['id'];
    mysql_query('DELETE FROM contenu WHERE id=\'' . $element_a_supprimer . '\'') or die(mysql_error());
}

/*-----------------------------------------------------
Vérification 5 : est-ce qu'on veut modifier une page ?
-----------------------------------------------------*/

elseif ($_POST['action'] == 'modifier_page' )
{

	$id = (isset($_POST['id'])?$_POST['id']:"");
	$id_page = (isset($_POST['id_page'])?$_POST['id_page']:"");
	$titre = (isset($_POST['titre'])?$_POST['titre']:"");

	$heure = (isset($_POST['heure'])?$_POST['heure']:"");
	$minute = (isset($_POST['minute'])?$_POST['minute']:"");
	$mois = (isset($_POST['mois'])?$_POST['mois']:"");
	$jour = (isset($_POST['jour'])?$_POST['jour']:"");
	$annee = (isset($_POST['annee'])?$_POST['annee']:"");

	$heure_m = (isset($_POST['heure_m'])?$_POST['heure_m']:"");
	$minute_m = (isset($_POST['minute_m'])?$_POST['minute_m']:"");
	$mois_m = (isset($_POST['mois_m'])?$_POST['mois_m']:"");
	$jour_m = (isset($_POST['jour_m'])?$_POST['jour_m']:"");
	$annee_m = (isset($_POST['annee_m'])?$_POST['annee_m']:"");

	$date_c = mktime ($heure, $minute, 0, $mois, $jour, $annee);
	$date_m = mktime ($heure_m, $minute_m, 0, $mois_m, $jour_m, $annee_m);


	
	mysql_query("UPDATE page SET id_page='" . $id_page . "', timestamp='" . $date_c . "', timestamp2='" . $date_m . "', titre='" . $titre . "' WHERE id='" . $_POST['id'] . "'") or die(mysql_error()); 
	
	echo "page modifiée!";
}
}
?>

<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>


      Page en modification: <?php echo $page; ?>

	
	<h4>ajouter du contenu à la page:</h4>
	<form method="post" action="rediger_element_page.php">
		<input type="hidden" name="type_ajout" value="texte" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="ajouter un texte" />
	</form>
	<form method="post" action="rediger_element_page.php">
		<input type="hidden" name="type_ajout" value="lien" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="ajouter un lien" />
	</form>
	<form method="post" action="rediger_element_page.php">
		<input type="hidden" name="type_ajout" value="image" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="ajouter une image" />
	</form>
	<form method="post" action="rediger_element_page.php">
		<input type="hidden" name="type_ajout" value="video" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="ajouter une vidéo" />
	</form>
	<form method="post" action="rediger_element_page.php">
		<input type="hidden" name="type_ajout" value="br" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="ajouter une ou plusieurs mise à la ligne" />
	</form>
	
	<h4>modifer titre et date de la page:</h4>
	<form method="post" action="modif_page.php">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="submit" value="modifier" />
	</form>

	<br />
	<br />
	<h3>Aperçu:</h3>
	<br />
	
<?php
$contenu = mysql_query("SELECT * FROM contenu WHERE page='$page' ORDER BY id_element") or die(mysql_error());
mysql_close();
while ($tableau_contenu = mysql_fetch_array($contenu))
{

	
	
echo "<table class='tabbelement1px'><tr><td><table class='tabbbutton1px'><tr><td><form method='post' action='rediger_page.php'>
	  <input type='hidden' name='id' value=" . $tableau_contenu['id'] . " />
	  <input type='hidden' name='id_element' value=" . $tableau_contenu['id_element'] . " />
	  <input type='hidden' name='page' value='$page' />
	  <input type='hidden' name='action' value='modif_position_element_-' />
	  <input type='submit' value='-' >
	  </form></td>"; 
	
echo "<td>" . $tableau_contenu['id_element'] . "</td>";
	
	
echo "<td><form method='post' action='rediger_page.php'>
	  <input type='hidden' name='id' value=" . $tableau_contenu['id'] . " />
	  <input type='hidden' name='id_element' value=" . $tableau_contenu['id_element'] . " />
	  <input type='hidden' name='page' value='$page' />
	  <input type='hidden' name='action' value='modif_position_element_+' />
	  <input type='submit' value='+' >
	  </form></td>"; 
	
	
echo "<td><form method='post' action='modif_element_page.php'>
	  <input type='hidden' name='page' value='$page' />
	  <input type='hidden' name='id' value=" . $tableau_contenu['id'] . " />
	  <input type='submit' value='modifier' >
	  </form></td>"; 
	  
	  
echo "<td><form method='post' action='rediger_page.php'>
	  <input type='hidden' name='id' value=" . $tableau_contenu['id'] . " />
	  <input type='hidden' name='page' value='$page' />
	  <input type='hidden' name='action' value='supprimer_element' />
	  <input type='submit' value='supprimer' >
	  </form></td></tr></table></td></tr><tr><td>"; 
	  


	if($tableau_contenu['type'] == "texte")
	{
		?>
		<br />
		<?php 
		echo $tableau_contenu['texte']; 
		?>
		<br />
		<br />
		<?php
	}
	elseif($tableau_contenu['type'] == "lien")
	{
		?>
		<br />
		<a href="<?php echo $tableau_contenu['href'];?>"><?php echo $tableau_contenu['texte'];?></a>
		<br />
		<br />
		<?php
	}
	elseif($tableau_contenu['type'] == "image" && $tableau_contenu['href'] == false)
	{
	?>
		<br />
		<img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" />

		<br />
		<?php
	}
	elseif($tableau_contenu['type'] == "image" && $tableau_contenu['href'] == true)
	{
		?>
		<br />
		<a href="http://<?php echo $tableau_contenu['href']; ?>"><img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" /></a>
		<br />
		<?php
		?>
		<br />
		<?php
	}
	elseif($tableau_contenu['type'] == "video")
	{
		?><br /><?php 
		echo $tableau_contenu['src']; 
		?><br /><?php
		?><br /><?php
		?><br /><?php
	}

	elseif($tableau_contenu['type'] == "br")
	{ 

		for ($nombre_de_boucle = 1; $nombre_de_boucle <= $tableau_contenu['taille']; $nombre_de_boucle++)
		{
			echo "<br /> remise à la ligne n°" ;
			echo $nombre_de_boucle ;
		}
		echo "<br /><br />";
	}



	echo "</td></tr></table><br />";
}

?>
	
	
<?php
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>