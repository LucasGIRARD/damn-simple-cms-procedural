<?php
$debut = microtime(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Modification de page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
   
    <body>
<?php
//connection  au serveur mysql
mysql_connect("localhost", "root", "root") or die(mysql_error());
//s�lection de la base de donn�e
mysql_select_db("admin") or die(mysql_error());	

$page = $_POST["page"];

    // On r�cup�re toutes les informations correpondant � la page pour pouvoir la modifier
    $retour = mysql_query("SELECT * FROM page WHERE titre='$page'") or die(mysql_error());
    //on met les donn�es r�cup�rer dans un tableau pour pouvoir les exploiter
	$donnees = mysql_fetch_array($retour);

    
	$timestamp = $donnees['timestamp'];



?>

<h3><a href="liste_page.php">Retour � la liste des pages</a></h3>

<form action="rediger_page.php" method="post">   

<p>Titre :            <input type="text" size="30" name="titre" value=<?php echo $donnees['titre']; ?> > </p>


<p>Date de cr�ation : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  date('d', $timestamp);?> /> / <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  date('m', $timestamp);?> /> / <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  date('Y', $timestamp);?> /> � <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  date('H', $timestamp);?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  date('i', $timestamp);?> />


<p>Date de la modification : </p> le <input type='text' name='jour_m' size='1' maxlength='2' value=<?php echo  date("d")?> /> / <input type='text' name='mois_m' size='1' maxlength='2' value=<?php echo  date("m")?> /> / <input type='text' name='annee_m' size='2' maxlength='4' value=<?php echo  date("Y")?> /> � <input type='text' name='heure_m' size='1' maxlength='2' value=<?php echo  date("H")?> /> H <input type='text' name='minute_m' size='1' maxlength='2' value=<?php echo  date("i")?> />


<p>Id de la page :    <input type="text" name="id_page" size="1" value=<?php echo $donnees['id_page']; ?> > </p>
	

<input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />

<input type="hidden" name="action" value="modifier_page" />


<input type="submit" value="Envoyer">


</form>
<?php
$fin = microtime(true);
echo '<p class="text">Page ex�cut�e en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>