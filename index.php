<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
   <title>Bienvenue sur mon site</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <style type="text/css">
   h1, h3
   {
    text-align:center;
}
h3
{
    background-color:black;
    color:white;
    font-size:0.9em;
    margin-bottom:0px;
}
.page p
{
    background-color:#CCCCCC;
    margin-top:0px;
}
.page
{
    width:70%;
    margin:auto;
}
</style>
</head>
<body>
    <p>
        <h1>Bienvenue sur mon site !</h1>
        <br />
        <br />

        <?php
        include("menu.php");
        ?>


        <div class="page">

            <?php
mysql_connect("localhost", "root", "root") or die(mysql_error()); // Connexion à MySQL
mysql_select_db("admin") or die(mysql_error()); // Sélection de la base
$existe_deja=false;
$indexa=mysql_query("SELECT contenu FROM page WHERE indexp='1'") or die(mysql_error());
if (isset($_GET['page'])) {
$page = $_GET['page'];


$res=mysql_query("SELECT titre FROM page") or die(mysql_error());
$reponse = mysql_query("SELECT contenu FROM page WHERE titre='$page'") or die(mysql_error());


while($data=mysql_fetch_array($res)) {
    if($data[0] == $page) {
        $existe_deja=1;
    }
}
} else {
    $page = "";
}


if($existe_deja == "1")
{

    while ($donnees = mysql_fetch_array($reponse) )
    {
     ?><?php
     echo $donnees['contenu'];
     ?> <?php
 }

} elseif ( $page == "" ) {
    while ($donneesb = mysql_fetch_array($indexa) )
    {
     ?><?php
     echo $donneesb['contenu'];
     ?><?php
 }
} else {
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
<a href="liste_page.php">la liste des pages</a>
</p>
</body>
</html>