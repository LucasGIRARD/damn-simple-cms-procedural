<?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); 


mysql_query("DROP DATABASE IF EXISTS admin") or die(mysql_error()); 



mysql_query("CREATE DATABASE admin") or die(mysql_error()); 
mysql_select_db("admin") or die(mysql_error());


mysql_query("CREATE TABLE config (
  nom varchar(255) NOT NULL,
  valeur text NOT NULL,
  PRIMARY KEY  (`nom`)
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


mysql_query("CREATE TABLE page (
  id mediumint NOT NULL auto_increment,
  id_page int NOT NULL,
  timestamp int NOT NULL,
  timestamp2 int NOT NULL,
  titre text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;") or die(mysql_error()); 

mysql_query("CREATE TABLE user (
  id mediumint NOT NULL auto_increment,
  pseudo text NOT NULL,
  pass text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;") or die(mysql_error()); 


mysql_query("INSERT INTO config VALUES('index','')") or die(mysql_error()); 

mysql_query("INSERT INTO config VALUES('nom_site','')") or die(mysql_error()); 

mysql_query("INSERT INTO config VALUES('status','')") or die(mysql_error()); 

mysql_query("INSERT INTO user VALUES('','root','root')") or die(mysql_error()); 


echo "OK !";


?>