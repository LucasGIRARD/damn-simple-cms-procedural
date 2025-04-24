<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Rédiger une news</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style type="text/css">
        h3, form
        {
            text-align:center;
        }
        </style>
    </head>
   
    <body>
<h3><a href="liste_page.php">Retour à la liste des pages</a></h3>
<?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());
if (isset($_GET['modifier_page'])) // Si on demande de modifier une news
{
    // On protège la variable "modifier_news" pour éviter une faille SQL
    $_GET['modifier_page'] = mysql_real_escape_string(htmlspecialchars($_GET['modifier_page'])) or die(mysql_error());
    // On récupère les infos de la news correspondante
    $retour = mysql_query('SELECT * FROM page WHERE id=\'' . $_GET['modifier_page'] . '\'') or die(mysql_error());
    $donnees = mysql_fetch_array($retour) or die(mysql_error());
   
    // On place le titre et le contenu dans des variables simples
    $titre = stripslashes($donnees['titre']);
    $contenu = stripslashes($donnees['contenu']);
	$href = stripslashes($donnees['href']); 
    $id_page = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification
}
else // C'est qu'on rédige une nouvelle news
{
    // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news
    $titre = '';
    $contenu = '';
    $href = '';
    $id_page = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification
}
?>
<form action="liste_page.php" method="post">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>

<a href="">texte</a> <a href="">image interne</a> <a href="">image externe</a> <a href="">video</a>
<br \>

   Contenu :<br />
    <textarea name="contenu" cols="50" rows="10"><?php echo $contenu ; ?></textarea>
	<br />
    
	<input type="hidden" name="href" value='<?php echo $href; ?>' />
	
    <input type="hidden" name="id_page" value="<?php echo $id_page; ?>" />
	
    <input type="submit" value="Envoyer" />
</p>
</form>
</body>
</html>