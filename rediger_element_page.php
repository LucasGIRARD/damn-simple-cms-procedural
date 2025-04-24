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
$type_ajout = $_POST['type_ajout'];
$page = $_POST['page'];
$id_page = 0;
$id_element = 0;

$jour = date("d");
$mois = date("m");
$annee = date("Y");
$heure = date("H");
$minute = date("i");
?>

<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>

<form action="rediger_page.php" method="post">
	
	<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour;?> /> <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois;?> /> <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute;?> />

	<p> id de l'element : <input type="text" size="1" maxlength="2" name="id_element" value="<?php echo $id_element;?>" /> </p>
	
   <p> la page : <select name="page">
   <?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());
$titre_page = mysql_query('SELECT id, titre FROM page') or die(mysql_error());
while ($tableau_titre_page = mysql_fetch_array($titre_page))
{
   if($tableau_titre_page['titre'] == $page)
   {
   echo "<option value=" . $tableau_titre_page['titre'] . " selected=selected>" . $tableau_titre_page['titre'] . "</option>";
   }
   else
   {
   echo "<option value=" .$tableau_titre_page['titre']. ">" . $tableau_titre_page['titre'] . "</option>";
   }
	
}
mysql_close(); 
	?>
	</select>
	</p>
		
<?php	
if($type_ajout == 'texte')
{ 
echo "<p>texte :<br />
<textarea name='texte' cols='50' rows='10'></textarea></p>";
} 
elseif($type_ajout == 'lien')
{
echo "<p>texte du lien : <input type='text' size='30' name='texte' value='' /></p>
<p>lien (ne pas mettre 'http://'): <input type='text' size='30' name='href' value='' /></p>";

}
elseif($type_ajout == 'image')
{
echo "<p>emplacement : <input type='text' size='30' name='src' value='' /></p>
<p>infobulle : <input type='text' size='30' name='infobulle' value='' /></p>
<p>descritpion si l'image ne s'affiche pas : <input type='text' size='30' name='alt' value='' /></p>
<p>légende : <input type='text' size='30' name='texte' value='' /></p>
<p>lien : <input type='text' size='30' name='href' value='' /></p>";
}
elseif($type_ajout == 'video')
{
echo "<p>Titre : <input type='text' size='30' name='texte' value='' /></p>
<p>lien : <input type='text' size='30' name='src' value='' /></p>
<p>legende : <input type='text' size='30' name='alt' value='' /></p>";
}
elseif($type_ajout == 'br')
{
echo "<p>nombre de mise(s) à la ligne : <select name='taille'>
<option value='1' selected='selected'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select> 
</p>";
}
?>
	<input type="hidden" name="action" value="ajout_element" />
	<input type="hidden" name="type_ajout" value="<?php echo $type_ajout; ?>" />
    <input type="submit" value="Envoyer" />

</form>
<?php
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>