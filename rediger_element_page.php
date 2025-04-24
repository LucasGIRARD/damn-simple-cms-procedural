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
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());


// On protège la variable "modifier_news" pour éviter une faille SQL
$id_contenu = $_GET['id_contenu'];


if (isset($id_contenu)) // Si on demande de modifier une news
{
    // On récupère les infos de la news correspondante
    $contenu_recuperer = mysql_query('SELECT * FROM contenu WHERE id=\'' . $id_contenu . '\'') or die(mysql_error());
    $tableau_contenu_recuperer = mysql_fetch_array($contenu_recuperer) or die(mysql_error());
   
    // On place le titre et le contenu dans des variables simples
    $type_ajout = stripslashes($tableau_contenu_recuperer['type']);
	$texte = stripslashes($tableau_contenu_recuperer['texte']);
	$titre = stripslashes($tableau_contenu_recuperer['texte']);
	$lien = stripslashes($tableau_contenu_recuperer['href']);
	$legende = stripslashes($tableau_contenu_recuperer['legende']);
	$alt = stripslashes($tableau_contenu_recuperer['alt']);
	$infobulle = stripslashes($tableau_contenu_recuperer['infobulle']);
	$href = stripslashes($tableau_contenu_recuperer['href']);
	$timestamp = stripslashes($tableau_contenu_recuperer['timestamp']);
	$src = stripslashes($tableau_contenu_recuperer['src']);
	
  //date de la ceation
  $jour = date('d', $timestamp);
  $mois = date('m', $timestamp);
  $annee = date('Y', $timestamp);
  $heure = date('H', $timestamp);
  $minute = date('i', $timestamp);
  
  // date de la modification
  $jour_m = date("d");
  $mois_m = date("m");
  $annee_m = date("Y");
  $heure_m = date("H");
  $minute_m = date("i");  
	
}
else // C'est qu'on rédige une nouvelle news
{
    $type_ajout = ($_GET['ajout']);
    // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news
	$texte = '';
	$titre = '';
	$lien = '';
	$legende = '';
	$alt = '';
	$infobulle = '';
	$href = '';
	$id_contenu = 0;
    $id_page = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification

  $jour = date("d");
  $mois = date("m");
  $annee = date("Y");
  $heure = date("H");
  $minute = date("i");
	
}
if($type_ajout == texte)
{
?>
<form action="liste_page.php" method="post">
	<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour;?> /> <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois;?> /> <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute;?> />

<?php
if($id_contenu != 0) // Si on demande de modifier une page(on vérifie que l'on reçoit une valeur dans la variable)
{
echo "<p>Date de la modification : </p> le <input type='text' name='jour_m' size='1' maxlength='2' value=".$jour_m." /> <input type='text' name='mois_m' size='1' maxlength='2' value=".$mois_m." /> <input type='text' name='annee_m' size='2' maxlength='4' value=".$annee_m." /> à <input type='text' name='heure_m' size='1' maxlength='2' value=".$heure_m." /> H <input type='text' name='minute_m' size='1' maxlength='2' value=".$minute_m." />";
}
?>
	
	<p> id du texte : <input type="text" size="1" maxlength='2' name="id_contenu" value="<?php echo $id_contenu;?>" /> </p>
	
   <p> la page : <select name="id_page">
   <?php
   $titre_page = mysql_query('SELECT id, titre FROM page') or die(mysql_error());
while ($tableau_titre_page = mysql_fetch_array($titre_page))
{
   if($tableau_titre_page['id'] == $_GET['modifier_page'])
   {
   echo "<option value=" . $tableau_titre_page['id'] . " selected=selected>" . $tableau_titre_page['titre'] . "</option>";
   }
   else
   {
   echo "<option value=" .$tableau_titre_page['id']. ">" . $tableau_titre_page['titre'] . "</option>";
   }
	
} 
	?>
	</select>
	</p>
	
	  <p> texte :<br />
    <textarea name="texte" cols="50" rows="10"><?php echo strip_tags($texte); ?></textarea> </p>
    
	<input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />
	
    <input type="submit" value="Envoyer" />

</form>
<?php
}

elseif($type_ajout == lien)
{
?>
<form action="liste_page.php" method="post">

	<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour;?> /> <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois;?> /> <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute;?> />

<?php
if($id_contenu != 0) // Si on demande de modifier une page(on vérifie que l'on reçoit une valeur dans la variable)
{
echo "<p>Date de la modification : </p> le <input type='text' name='jour_m' size='1' maxlength='2' value=".$jour_m." /> <input type='text' name='mois_m' size='1' maxlength='2' value=".$mois_m." /> <input type='text' name='annee_m' size='2' maxlength='4' value=".$annee_m." /> à <input type='text' name='heure_m' size='1' maxlength='2' value=".$heure_m." /> H <input type='text' name='minute_m' size='1' maxlength='2' value=".$minute_m." />";
}
?>
	
	<p> id du lien : <input type="text" size="1" maxlength='2' name="id_contenu" value="<?php echo $id_contenu;?>" /> </p>
	
   <p> la page : <select name="id_page">
   <?php
   $titre_page = mysql_query('SELECT id, titre FROM page') or die(mysql_error());
while ($tableau_titre_page = mysql_fetch_array($titre_page))
{
   if($tableau_titre_page['id'] == $_GET['modifier_page'])
   {
   echo "<option value=" . $tableau_titre_page['id'] . " selected=selected>" . $tableau_titre_page['titre'] . "</option>";
   }
   else
   {
   echo "<option value=" .$tableau_titre_page['id']. ">" . $tableau_titre_page['titre'] . "</option>";
   }
	
} 
	?>
	</select>
	</p>
	

<p>texte du lien : <input type="text" size="30" name="texte" value="<?php echo $texte; ?>" /></p>
<p>lien (ne pas mettre "http://"): <input type="text" size="30" name="href" value="<?php echo $href; ?>" /></p>
<p>

    <input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />
	
    <input type="submit" value="Envoyer" />
</p>
</form>
<?php
}


elseif($type_ajout == image)
{
?>
<form action="liste_page.php" method="post">
<p>emplacement : <input type="text" size="30" name="src" value="<?php echo $src; ?>" /></p>
<p>infobulle : <input type="text" size="30" name="infobulle" value="<?php echo $infobulle; ?>" /></p>
<p>descritpion si l'image ne s'affiche pas : <input type="text" size="30" name="alt" value="<?php echo $alt; ?>" /></p>
<p>légende : <input type="text" size="30" name="legende" value="<?php echo $legende; ?>" /></p>
<p>lien : <input type="text" size="30" name="href" value="<?php echo $href; ?>" /></p>

    <input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />
	
	<input type="hidden" name="id_contenu" value="<?php echo $id_contenu; ?>" />
	
    <input type="hidden" name="id_page" value="<?php echo $_GET['modifier_page']; ?>" />
	
    <input type="submit" value="Envoyer" />
</p>
</form>
<?php
}


elseif($type_ajout == video)
{
?>
<form action="liste_page.php" method="post">
<p>Titre : <input type="text" size="30" name="texte" value="<?php echo $titre; ?>" /></p>
<p>lien : <input type="text" size="30" name="src" value="<?php echo $src; ?>" /></p>
<p>legende : <input type="text" size="30" name="legende" value="<?php echo $legende; ?>" /></p>

    <input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />

    <input type="hidden" name="id_contenu" value="<?php echo $id_contenu; ?>" />
	
    <input type="hidden" name="id_page" value="<?php echo $_GET['modifier_page']; ?>" />
	
    <input type="submit" value="Envoyer" />
</p>
</form>
<?php
}

elseif($type_ajout == br)
{
?>
<form action="liste_page.php" method="post">
<p>nombre de mise(s) à la ligne : <select name="nombre_br">
<option value="1" selected="selected">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>

    <input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />

    <input type="hidden" name="id_contenu" value="<?php echo $id_contenu; ?>" />
	
    <input type="hidden" name="id_page" value="<?php echo $_GET['modifier_page']; ?>" />
	<br />
    <input type="submit" value="Envoyer" />
</p>
</form>
<?php
}



mysql_close();
?>

</body>
</html>