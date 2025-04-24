<?php
$debut = microtime(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Création de page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
   
    <body>

<a href="liste_page.php">Retour à la liste des pages</a>

<form action="liste_page.php" method="post">   

		<p>Titre :            <input type="text" size="30" name="titre" value="" > </p>

		
		<p>Date de création : </p> le <input type='text' name='jour' size='1' maxlength='2' value=<?php echo date("d"); ?> /> / <input type='text' name='mois' size='1' maxlength='2' value=<?php echo  date("m");?> /> / <input type='text' name='annee' size='2' maxlength='4' value=<?php echo  date("Y");?> /> à <input type='text' name='heure' size='1' maxlength='2' value=<?php echo  date("H");?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo  date("i");?> />


		<p>Id de la page :    <input type="text" name="id_page" size="1" value="0" > </p>

		
		<input type="hidden" name="action" value="ajout_page" />
				
<input type="submit" value="Envoyer">
</form>
<?php
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>
</body>
</html>