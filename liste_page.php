<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>panel d'admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		 <style type="text/css">
        h2, th, td
        {
            text-align:center;
        }
        table
        {
            border-collapse:collapse;
            border:2px solid black;
            margin:auto;
        }
        th, td
        {
            border:1px solid black;
        }
        </style>
    </head>
   
    <body>
 
<h2><a href="rediger_page.php">Ajouter une page</a></h2> </br>
<h2><a href="index.php">Retour a l'index</a></h2> </br>
<?php
mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("admin") or die(mysql_error());
//-----------------------------------------------------
// V�rification 1 : est-ce qu'on veut poster une news ?
//-----------------------------------------------------
		  
if (isset($_POST['titre']) AND isset($_POST['contenu']) )
{
	$titre = addslashes($_POST['titre']);
    $contenu = addslashes($_POST['contenu']);

    // On v�rifie si c'est une modification de news ou pas
    if ($_POST['id_page'] == 0)
    {
        // Ce n'est pas une modification, on cr�e une nouvelle entr�e dans la table
		$href2="<a href=\"index.php?page=". $titre ."\">". $titre ."</a>" ;
        mysql_query("INSERT INTO page VALUES('', '" . $titre . "', '" . $contenu . "', '" . time() . "', '" . $href2 . "','')") or die(mysql_error()); 
    }
    else
    {
        $href = addslashes($_POST['href']);	
        // On prot�ge la variable "id_news" pour �viter une faille SQL
        $_POST['id_page'] = addslashes($_POST['id_page']);
        // C'est une modification, on met juste � jour le titre et le contenu
        mysql_query("UPDATE page SET titre='" . $titre . "',href='" .$href. "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_page'] . "'") or die(mysql_error()); 
    }
}
 
//--------------------------------------------------------
// V�rification 2 : est-ce qu'on veut supprimer une news ?
//--------------------------------------------------------
if (isset($_GET['supprimer_page'])) // Si on demande de supprimer une news
{
    // Alors on supprime la news correspondante
    // On prot�ge la variable "id_news" pour �viter une faille SQL
    $_GET['supprimer_page'] = addslashes($_GET['supprimer_page']);
    mysql_query('DELETE FROM page WHERE id=\'' . $_GET['supprimer_page'] . '\'') or die(mysql_error());
}

?>
<table><tr>
<th>Modifier</th>
<th>Supprimer</th>
<th>Titre</th>
<th>Date</th>
<th>page vide</th>
<th>Quel page doit �tre votre index ?</th>
</tr>
<?php
$retour = mysql_query('SELECT * FROM page ORDER BY id') or die(mysql_error());
while ($donnees = mysql_fetch_array($retour)) // On fait une boucle pour lister les news
{
?>
<tr>
<td><?php echo '<a href="rediger_page.php?modifier_page=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td><?php echo '<a href="liste_page.php?supprimer_page=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
<td><?php echo stripslashes($donnees['titre']); ?></td>
<td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
<td><?php
$resp=mysql_query("SELECT contenu FROM page");
$data3=mysql_fetch_array($resp);
if($data3[0] == false)
{
echo "oui";
}
else
{
echo "non";
}
?></td>
<td>
<form method="post" action="liste_page.php">
       <input type="radio" name="index" value="<?php echo $donnees['titre'] ?>" id="<?php echo $donnees['titre'] ?>" /> <label for="<?php echo $donnees['titre'] ?>"> </label>

</td>
</tr>

<?php
} // Fin de la boucle qui liste les news
?>

</table>
<br \>
<br \>
<input type="submit" value="appliquer" />
</form>
<?php
if (isset($_POST['index']) ) // Si les variables existent
{
    if ($_POST['index'] != NULL ) // Si on a quelque chose � enregistrer
    {
        mysql_query(" UPDATE page SET indexp='0' WHERE indexp='1' ") or die(mysql_error());
        $indexp = mysql_real_escape_string(htmlspecialchars($_POST['index']));
        mysql_query(" UPDATE page SET indexp='1' WHERE titre='$indexp' ") or die(mysql_error());

    }
}
?>
<br \>
<br \>
<?php
$res=mysql_query("SELECT indexp FROM page");
$a=false;
$b=false;

while($data=mysql_fetch_array($res))
{
if($data[0] == "1") //data[0] parce tu n'as qu'un champ dans le select
{
$a="1";
}
elseif($data[0] == "0")
{
$b="1";
}
}

if($b == false && $a == false) //data[0] parce tu n'as qu'un champ dans le select
{
echo "il existe aucune page!";
}

elseif($a == "1") //data[0] parce tu n'as qu'un champ dans le select
{
echo "tout � l'air op�rationnel!";
}

elseif($a == false && $b == "1")
{
echo "index non choisi!";
}
?>
</body>
</html>