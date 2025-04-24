<?php


$lien = mysql_query("SELECT titre, id FROM page ORDER BY id_page") or die(mysql_error());
$compte_page = mysql_query('SELECT COUNT(*) AS nb_page FROM page') or die(mysql_error());
$tableau_compte_page = mysql_fetch_array($compte_page) or die(mysql_error());
$totalpage = $tableau_compte_page['nb_page'];

// Avec cette boucle, on liste le menu
 
while ($tableau_compte_page = mysql_fetch_array($lien) )
{

if ( $totalpage > 1 )
{
echo " | ";

echo "<a href='index.php?page=".$tableau_compte_page['titre']."'>".$tableau_compte_page['titre']."</a>";
}

else
{
echo "<a href='index.php?page=".$tableau_compte_page['titre']."'>".$tableau_compte_page['titre']."</a>";
}

}

if ( $totalpage > 1 )
{
echo " | ";
}


?>

