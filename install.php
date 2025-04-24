<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); 


mysql_query("DROP DATABASE IF EXISTS admin") or die(mysql_error()); 



mysql_query("CREATE DATABASE admin") or die(mysql_error()); 

mysql_select_db("admin") or die(mysql_error());

mysql_query("CREATE TABLE page (
  id mediumint NOT NULL auto_increment,
  titre text NOT NULL,
  contenu text NOT NULL,
  timestamp int NOT NULL,
  href text NOT NULL,
  indexp smallint NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;") or die(mysql_error()); 
exit();
$test=mysql_query("SELECT titre FROM page");




mysql_query("CREATE TABLE texte (
  id mediumint NOT NULL auto_increment,
  timestamp int NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM;") or die(mysql_error()); 
$test=mysql_query("SELECT titre FROM page");


mysql_query("CREATE TABLE lien (
  id mediumint NOT NULL auto_increment,
  href text NOT NULL,
  timestamp int NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM;") or die(mysql_error()); 
$test=mysql_query("SELECT titre FROM page");


mysql_query("CREATE TABLE image (
  id mediumint NOT NULL auto_increment,
  alt text NOT NULL,
  infobulle text NOT NULL,
  lien text NOT NULL,
  href text NOT NULL,
  timestamp int NOT NULL,
  legende text NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM;") or die(mysql_error()); 
$test=mysql_query("SELECT titre FROM page");
  
  
  
  mysql_query("CREATE TABLE video (
  id mediumint NOT NULL auto_increment,
  titre text NOT NULL,
  lien text NOT NULL,
  timestamp int NOT NULL,
  legende text NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM;") or die(mysql_error()); 

$test1=mysql_query("SELECT id FROM page");
$test2=mysql_query("SELECT id FROM texte");
$test3=mysql_query("SELECT id FROM lien");
$test4=mysql_query("SELECT id FROM image");
$test5=mysql_query("SELECT id FROM video");


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
echo "installation table texte réussi";
}
else
{
echo "installation table texte échoué";
}
?>
<br />
<?php
if($test3 == true)
{
echo "installation table lien réussi";
}
else
{
echo "installation table lien échoué";
} 
?>
<br />
<?php
if($test4 == true)
{
echo "installation table image réussi";
}
else
{
echo "installation table image échoué";
}
?>
<br />
<?php
if($test5 == true)
{
echo "installation table vidéo réussi";
}
else
{
echo "installation table vidéo échoué";
}
?>
<br />
<?php
if($test1 == true && $test2 == true && $test3 == true && $test4 == true && $test5 == true)
{
echo "installation réussi";
}
else
{
echo "installation échoué";
}
?>
