<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Rédiger une news</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
   
    <body>

	<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>
	
<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); // Connexion à MySQL
mysql_select_db("admin") or die(mysql_error()); // Sélection de la base


$modifier_page = $_GET['modifier_page'];
$page_en_modification = mysql_query("SELECT titre FROM page WHERE id='$modifier_page'") or die(mysql_error());
$tableau_page_en_modification = mysql_fetch_array($page_en_modification);
$page = $tableau_page_en_modification[0];

//--------------------------------------------------------
// Vérification  : est-ce qu'on veut supprimer un element ?
//--------------------------------------------------------
if (isset($_GET['supprimer_element'])) // Si on demande de supprimer une news
{
    // Alors on supprime la news correspondante
    // On protège la variable "id_news" pour éviter une faille SQL
    $_GET['supprimer_element'] = addslashes($_GET['supprimer_element']);
    mysql_query('DELETE FROM contenu WHERE id=\'' . $_GET['supprimer_element'] . '\'') or die(mysql_error());
}

//--------------------------------------------------------
// Vérification  : est-ce qu'on veut modifier la position d'un element ?
//--------------------------------------------------------
if (isset($_GET['position_element']) && isset($_GET['new_position_element'])) // Si on demande de supprimer une news
{
    // Alors on supprime la news correspondante
    // On protège la variable "id_news" pour éviter une faille SQL
    $position_element = addslashes($_GET['position_element']);
	$new_position_element_sql = addslashes($_GET['new_position_element']);
     mysql_query("UPDATE contenu SET id_element='" . $new_position_element_sql . "' WHERE id='" . $position_element . "'") or die(mysql_error()); 
}


?>

     <center> Page en modification: <?php echo $tableau_page_en_modification[0]; ?> </center>

	<h4><a href="modifer_contenu_page.php?modifier_page=<?php echo $modifier_page; ?>">ajouter du contenu à la page</a></h4>
	<h4><a href="creer_page.php?modifier_page=<?php echo $modifier_page; ?>"/>modifer titre page</a></h4>

	
	
<?php
$contenu = mysql_query("SELECT * FROM contenu WHERE page='$page' ORDER BY id_element") or die(mysql_error());
mysql_close();
while ($tableau_contenu = mysql_fetch_array($contenu))
{
$new_position_element= $tableau_contenu['id_element'] -1;
$new_position_element2= $tableau_contenu['id_element'] +1;
echo '<a href="rediger_page.php?modifier_page=' . $modifier_page . '&amp;position_element=' . $tableau_contenu['id'] . '&amp;new_position_element=' . $new_position_element . '">'; ?> < </a>&nbsp;<?php echo $tableau_contenu['id_element'] ?>&nbsp;<?php
echo '<a href="rediger_page.php?modifier_page=' . $modifier_page . '&amp;position_element=' . $tableau_contenu['id'] . '&amp;new_position_element=' . $new_position_element2 . '">'; ?> > </a><?php
?>&nbsp;<?php
echo '<a href="rediger_element_page.php?modifier_page=' . $modifier_page . '&amp;id_contenu=' . $tableau_contenu['id'] . '">'; ?>Modifier</a><?php
?>&nbsp;<?php
echo '<a href="rediger_page.php?modifier_page=' . $modifier_page . '&amp;supprimer_element=' . $tableau_contenu['id'] . '">'; ?>Supprimer</a><?php


if($tableau_contenu['type'] == texte)
{
?>
<br />
<?php 
echo $tableau_contenu['texte']; 
?>
<br />
<?php
}
elseif($tableau_contenu['type'] == lien)
{
?>
<br />
<a href="<?php echo $tableau_contenu['href'];?>"><?php echo $tableau_contenu['texte'];?></a>
<br />
<?php
}
elseif($tableau_contenu['type'] == image && $tableau_contenu['href'] == false)
{
?>
<br />
<img src="<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" />

<br />
<?php
}
elseif($tableau_contenu['type'] == image && $tableau_contenu['href'] == true)
{
?>
<br />
<a href="<?php echo $tableau_contenu['href']; ?>"><img src="<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" /></a>
<br />
<?php
?>
<br />
<?php
}
elseif($tableau_contenu['type'] == video)
{
?><br /><?php 
echo $tableau_contenu['src']; 
?><br /><?php
?><br /><?php
?><br /><?php
}

elseif($tableau_contenu['type'] == br)
{ 

for ($nombre_de_boucle = 1; $nombre_de_boucle <= $tableau_contenu['taille']; $nombre_de_boucle++)
{
echo "<br /> remise à la ligne n°" ;
echo $nombre_de_boucle ;
}

}




}

?>
	
	

</body>
</html>