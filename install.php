<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); 


mysql_query("DROP DATABASE IF EXISTS admin") or die(mysql_error()); 



mysql_query("CREATE DATABASE admin") or die(mysql_error()); 
mysql_select_db("admin") or die(mysql_error());

mysql_query("CREATE TABLE page (
  id mediumint NOT NULL auto_increment,
  id_page int NOT NULL,
  timestamp int NOT NULL,
  timestamp2 int NOT NULL,
  titre text NOT NULL,
  href text NOT NULL,
  choisir_index smallint NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;") or die(mysql_error()); 


mysql_query("CREATE TABLE contenu (
  id mediumint NOT NULL auto_increment,
  id_element int NOT NULL,
  timestamp int NOT NULL,
  timestamp2 int NOT NULL,
  type text NOT NULL,
  page text NOT NULL,
  texte text NOT NULL,
  taille text NOT NULL,
  src text NOT NULL,
  href text NOT NULL,
  alt text NOT NULL,
  infobulle text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;") or die(mysql_error()); 



mysql_query("CREATE TABLE config (
  nom varchar(255) NOT NULL,
  valeur text NOT NULL,
  PRIMARY KEY  (`nom`)
) TYPE=MyISAM;") or die(mysql_error()); 

$test1=mysql_query("SELECT id FROM page");
$test2=mysql_query("SELECT id FROM contenu");
$test3=mysql_query("SELECT nom FROM config");


if($test1 == true)
{
echo "installation table page reussie";
}
else
{
echo "installation table page échoué";
}
?>
<br />
<?php
if($test2 == true)
{
echo "installation table contenu reussie";
}
else
{
echo "installation table contenu échoué";
}
?>
<br />
<?php
if($test3 == true)
{
echo "installation table config reussie";
}
else
{
echo "installation table config échoué";
}
?>
<br />
<?php
if($test1 == true && $test2 == true && $test3 == true)
{
echo "installation reussie";
}
else
{
echo "installation échoué";
}
?>