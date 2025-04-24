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


$id = $_POST['id'];
$page = $_POST['page'];

$contenu_recuperer = mysql_query('SELECT * FROM contenu WHERE id=\'' . $id . '\'') or die(mysql_error());
$tableau_contenu_recuperer = mysql_fetch_array($contenu_recuperer) or die(mysql_error());

$type_ajout = $tableau_contenu_recuperer['type'];
$texte = $tableau_contenu_recuperer['texte'];
$id_element = $tableau_contenu_recuperer['id_element'];
$alt = $tableau_contenu_recuperer['alt'];
$infobulle = $tableau_contenu_recuperer['infobulle'];
$href = $tableau_contenu_recuperer['href'];
$timestamp = $tableau_contenu_recuperer['timestamp'];
$src = $tableau_contenu_recuperer['src'];

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


?>

<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>

<form action="rediger_page.php" method="post">
	
	<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour;?> /> <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois;?> /> <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute;?> />

	<p>Date de la modification : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour_m;?> /> <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois_m;?> /> <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee_m;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure_m;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute_m;?> />
	
	<p> id de l'element : <input type="text" size="1" maxlength="2" name="id_element" value="<?php echo $id_element;?>" /> </p>
	
   <p> la page : <select name="id_page">
   <?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());

$titre_page = mysql_query('SELECT id, titre FROM page') or die(mysql_error());
while ($tableau_titre_page = mysql_fetch_array($titre_page))
{
   if($tableau_titre_page['titre'] == $page)
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
		
<?php	
if($type_ajout == texte)
{ 
echo "<p>texte :<br />
<textarea name='texte' cols='50' rows='10'>" . strip_tags($texte) . "</textarea></p>";
} 
elseif($type_ajout == lien)
{
echo "<p>texte du lien : <input type='text' size='30' name='texte' value=" . $texte . " /></p>
<p>lien (ne pas mettre 'http://'): <input type='text' size='30' name='href' value=" . $href . " /></p>";

}
elseif($type_ajout == image)
{
echo "<p>emplacement : <input type='text' size='30' name='src' value=" . $src . " /></p>
<p>infobulle : <input type='text' size='30' name='infobulle' value=" . $infobulle . " /></p>
<p>descritpion si l'image ne s'affiche pas : <input type='text' size='30' name='alt' value=" . $alt . " /></p>
<p>légende : <input type='text' size='30' name='texte' value=" . $alt . " /></p>
<p>lien : <input type='text' size='30' name='href' value=" . $href . " /></p>";
}
elseif($type_ajout == video)
{
echo "<p>Titre : <input type='text' size='30' name='texte' value='" . $texte . "' /></p>
<p>lien : <br />
<textarea name='texte' cols='50' rows='10'>" . $src . "</textarea></p>
<p>legende : <input type='text' size='30' name='alt' value='" . $alt . "' /></p>";
}
elseif($type_ajout == br)
{

$taille_br = mysql_query("SELECT taille FROM contenu WHERE id='$id'") or die(mysql_error());
$tableau_taille_br = mysql_fetch_array($taille_br);


echo "<p>nombre de mise(s) à la ligne : <select name='taille'>";
$j = "1";
while ($j <= "10" )
{
if ($j == $tableau_taille_br['taille'])
{
echo "<option value=" . $j . " selected=selected >" . $j . "</option>";
}
else
{
echo "<option value=" . $j . ">" . $j . "</option>";
}
$j = $j+1;
}
echo"</select></p>";
}
mysql_close(); 
?>
	<input type="hidden" name="action" value="modif_element" />
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />
    <input type="submit" value="Envoyer" />

</form>
<?php
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>