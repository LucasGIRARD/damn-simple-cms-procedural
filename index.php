<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   <?php $nom_page="page"; ?>
       <title><?php echo $nom_page ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
    <body>
<p>
<?php $nom_site="site"; ?>
<h1><?php echo $nom_site ?></h1>
<br />
<br />
<div class="menu">
<?php
include("menu.php"); //on ajoute le menu qui se trouve dans une autre page
?>
</div>
    
<div class="page">

<?php
//connection  au serveur mysql
mysql_connect("localhost", "root", "root") or die(mysql_error());
//sélection de la base de donnée
mysql_select_db("admin") or die(mysql_error());


// On protège la variable "page" pour éviter une faille SQL, et on le rentre dans une variable simple à la place d'une variable superglobale
$page = $_GET['page'];

//on déclare la variable afin d'éviter un bug
$page_dans_BDD = false;

$titre_page_index = false;

//on récupere les titre de la table page et on les met dans la variable ou affiche l'erreur MySQL
$titre_BDD = mysql_query("SELECT titre FROM page") or die(mysql_error());

//on récupere le contenu de la table page là ou le titre est égal à la variable $page(l.29)  et on les met dans la variable ou affiche l'erreur MySQL
$contenu = mysql_query("SELECT * FROM contenu WHERE page='$page' ORDER BY id_element") or die(mysql_error());
//on récupere le titre d la table page là ou l'index=1 (page index)  et on les met dans la variable ou affiche l'erreur MySQL
$titre_page_index = mysql_query("SELECT titre FROM page WHERE choisir_index='1' ");
//on met les données dans un tableau afin de pouvoir les lires
$tableau_titre_page_index = mysql_fetch_array($titre_page_index);

//on veut récuperer dans une variable le nom de la page qui sera l'index
$index = $tableau_titre_page_index[0];

//on veut récuperer dans une variable le contenu de la page qui sera l'index
$index2 = mysql_query("SELECT * FROM contenu WHERE page='$index' ORDER BY id_element") or die(mysql_error());
 //boucle; on utilise le tableau ligne par ligne jusqu'a la fin du tableau
while($tableau_titre_BDD=mysql_fetch_array($titre_BDD))
{
//tableau_titre_BDD[0] (=dans le tableau champ 0 selectionné) car il n'y a qu'un champ dans le select
if($tableau_titre_BDD[0] == $page)
{
// on change l'état de la variable déclarer (l.54), cette variable sert de sécurité!
$page_dans_BDD=1;
}

}


if($page_dans_BDD == "1")
{

while ($tableau_contenu = mysql_fetch_array($contenu))
{
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
<a href="http://<?php echo $tableau_contenu['href'];?>"><?php echo $tableau_contenu[texte];?></a>
<br />
<?php

}
elseif($tableau_contenu['type'] == image && $tableau_contenu['href'] == false)
{
?>
<br />
<img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" />
<br />
<?php
echo $tableau_contenu['legende'];
}

elseif($tableau_contenu['type'] == image && $tableau_contenu['href'] == true)
{
?>
<br />
<a href="http://<?php echo $tableau_contenu['href']; ?>"><img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" /></a>
<br />
<?php
echo $tableau_contenu['legende'];
?>
<br />
<?php
}
elseif($tableau_contenu['type'] == video)
{
?><br /><?php 
echo $tableau_contenu['src']; 
?><br /><?php
echo $tableau_contenu['legende'];
?><br /><?php
?><br /><?php
}

elseif($tableau_contenu['type'] == br)
{ 
	
for ($nombre_de_boucle = 1; $nombre_de_boucle <= $tableau_contenu['taille']; $nombre_de_boucle++)
{
echo "<br />" ;
}

}


}
}

elseif ( $_GET['page'] == "" )
{
while ($tableau_index = mysql_fetch_array($index2))
{
if($tableau_index['type'] == texte)
{
?>
<br />
<?php 
echo $tableau_index['texte']; 
?>
<br />
<?php
}
elseif($tableau_index['type'] == lien)
{
?>
<br />
<a href="http://<?php echo $tableau_index['href'];?>"><?php echo $tableau_index['texte'];?></a>
<br />
<?php
}
elseif($tableau_index['type'] == image && $tableau_index['href'] == false)
{
?>
<br />
<img src="http://<?php echo $tableau_index['src']; ?>" alt="<?php echo $tableau_index['alt']; ?>" title="<?php echo $tableau_index['infobulle']; ?>" />
<br />
<?php
echo $tableau_index['legende'];

}


elseif($tableau_index['type'] == image && $tableau_index['href'] == true)
{
?>
<br />
<a href="http://<?php echo $tableau_index['href']; ?>"><img src="http://<?php echo $tableau_index['src']; ?>" alt="<?php echo $tableau_index['alt']; ?>" title="<?php echo $tableau_index['infobulle']; ?>" /></a>
<br />
<?php
echo $tableau_index['legende'];
?>
<br />
<?php
}
elseif($tableau_index['type'] == video)
{
?><br /><?php 
echo $tableau_index['src']; 
?><br /><?php
}

elseif($tableau_index['type'] == br)
{ 

for ($nombre_de_boucle = 1; $nombre_de_boucle <= $tableau_index['taille']; $nombre_de_boucle++)
{
echo "<br />" ;
}

}



}
}


else
{
   ?><p><?php
echo "Cette page n'esiste pas!!!";
 ?> </p> <?php
	
}
mysql_close();
?>


</div>
<br />
<br />
<br />
<br />
<a href="liste_page.php">la liste des pages</a>
</p>
</body>
</html>