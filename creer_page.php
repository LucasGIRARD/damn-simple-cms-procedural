<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Création ou modification de page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
   
    <body>
<?php
//connection  au serveur mysql
mysql_connect("localhost", "root", "root") or die(mysql_error());
//sélection de la base de donnée
mysql_select_db("admin") or die(mysql_error());	


// On rentre la variable "modifier_page" dans une variable simple à la place d'une variable superglobale
$modifier_page = $_GET["modifier_page"];
if(isset($modifier_page)) // Si on demande de modifier une page (on vérifie que l'on reçoit une valeur dans la variable)
{
    // On récupère toutes les informations correpondant à la page pour pouvoir la modifier
    $retour = mysql_query("SELECT * FROM page WHERE id=" . $modifier_page . "");
    //on met les données récupérer dans un tableau pour pouvoir les exploiter
	$donnees = mysql_fetch_array($retour);

    // On place le titre, le contenu et l'id de la page dans des variables
	$titre = $donnees['titre'];
	$id = $donnees['id'];
    $id_page = $donnees['id_page'];
	$timestamp = $donnees['timestamp'];


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
else
{
	$titre = "";
	$id = 0;
	$id_page = 0;


	$jour = date("d");
	$mois = date("m");
	$annee = date("Y");
	$heure = date("H");
	$minute = date("i");
}

?>

<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>

<form action="liste_page.php" method="post">   

<p>Titre :            <input type="text" size="30" name="titre" value=<?php echo $titre; ?> > </p>

<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo  $jour;?> /> / <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  $mois;?> /> / <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  $annee;?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  $heure;?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  $minute;?> />
<?php
if(isset($modifier_page)) // Si on demande de modifier une page(on vérifie que l'on reçoit une valeur dans la variable)
{
echo "<p>Date de la modification : </p> le <input type='text' name='jour_m' size='1' maxlength='2' value=".$jour_m." /> <input type='text' name='mois_m' size='1' maxlength='2' value=".$mois_m." /> <input type='text' name='annee_m' size='2' maxlength='4' value=".$annee_m." /> à <input type='text' name='heure_m' size='1' maxlength='2' value=".$heure_m." /> H <input type='text' name='minute_m' size='1' maxlength='2' value=".$minute_m." />";
}
?>
<p>Id de la page :    <input type="text" name="id_page" size="1" value=<?php echo $id_page; ?> > </p>
	
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="Envoyer">
</form>
</body>
</html>