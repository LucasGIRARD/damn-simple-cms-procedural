<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); // Connexion � MySQL
mysql_select_db("admin") or die(mysql_error()); // S�lection de la base coursphp
 
$reponse = mysql_query("SELECT href, id FROM page") or die(mysql_error()); // Requ�te SQL
$retour = mysql_query('SELECT COUNT(*) AS nb_page FROM page') or die(mysql_error());
$donnees = mysql_fetch_array($retour) or die(mysql_error());
$totalpage = $donnees['nb_page'];
 
// Avec cette boucle, on liste uniquement le nom des jeux :
 
while ($donnees = mysql_fetch_array($reponse) )
{

if ( $totalpage > 1 )
{
echo " | ";
echo $donnees['href'];
}

else
{
echo $donnees['href'];
}

}

if ( $totalpage > 1 )
{
echo " | ";
}

mysql_close(); // D�connexion de MySQL
?>