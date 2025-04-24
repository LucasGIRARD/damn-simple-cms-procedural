<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); // Connexion à MySQL
mysql_select_db("admin") or die(mysql_error()); // Sélection de la base admin

$lien = mysql_query("SELECT href, id FROM page ORDER BY id_page") or die(mysql_error());
$compte_page = mysql_query('SELECT COUNT(*) AS nb_page FROM page') or die(mysql_error());
$tableau_compte_page = mysql_fetch_array($compte_page) or die(mysql_error());
$totalpage = $tableau_compte_page['nb_page'];

// Avec cette boucle, on liste le menu
 
while ($tableau_compte_page = mysql_fetch_array($lien) )
{

if ( $totalpage > 1 )
{
echo " | ";

echo $tableau_compte_page['href'];
}

else
{
echo $tableau_compte_page['href'];
}

}

if ( $totalpage > 1 )
{
echo " | ";
}

mysql_close(); // Déconnexion de MySQL
?>

