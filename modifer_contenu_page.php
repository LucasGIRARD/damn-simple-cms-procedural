<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Bienvenue sur mon site</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
    </head>
    <body>
	<p>
    
<div class="page">

<?php
//aficher la page en modification, comme dans l'index
$modifier_page = $_GET['modifier_page'];
?>


</div>
    <h4><a href="rediger_element_page.php?ajout=texte&amp;modifier_page=<?php echo $modifier_page; ?>">ajouter un texte sur la page</a></h4>
	<h4><a href="rediger_element_page.php?ajout=lien&amp;modifier_page=<?php echo $modifier_page; ?>">ajouter un lien sur la page</a></h4>
	<h4><a href="rediger_element_page.php?ajout=image&amp;modifier_page=<?php echo $modifier_page; ?>">ajouter une image sur la page</a></h4>
	<h4><a href="rediger_element_page.php?ajout=video&amp;modifier_page=<?php echo $modifier_page; ?>">ajouter une vidéo sur la page</a></h4>
    <h4><a href="rediger_element_page.php?ajout=br&amp;modifier_page=<?php echo $modifier_page; ?>">ajouter une ou des mise(s) à la ligne sur la page</a></h4>
	
<br />
<br />
<br />
<a href="liste_page.php">Retour à la liste des page</a>
</p>
</body>
</html>