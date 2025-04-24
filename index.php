<?php
$debut = microtime(true);
session_start() ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
	<?php 
//connection  au serveur mysql
mysql_connect("localhost", "root", "root") or die(mysql_error());
//sélection de la base de donnée
mysql_select_db("admin") or die(mysql_error());
$SQL_nom_site = mysql_query("SELECT valeur FROM config WHERE nom='nom_site' ") or die(mysql_error());
$tableau_nom_site = mysql_fetch_array($SQL_nom_site);
$nom_site = $tableau_nom_site['valeur'];
if (isset ($_GET['page']))
{
	$nom_site_page = $_GET['page'];
}
else
{
	$nom_site_page = "index";
}
	?>
		<title><?php echo $nom_site . ' - ' . $nom_site_page; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="Essai" href="projet.css" />
	</head>
	<body>
	<div id="log">
	<?php include('log.php'); ?>
	</div>
		<h1><?php echo $nom_site ?></h1>
		<br />
		<br />
		<?php 
		$titre_status_SQL = mysql_query("SELECT valeur FROM config WHERE nom='status'");
		$tableau_status = mysql_fetch_array($titre_status_SQL);
		$status = $tableau_status['valeur'];
		if ( $status == "ouvert" ) 
		{
		?>
			<div>
				<?php
				include("menu.php"); //on ajoute le menu qui se trouve dans une autre page
				?>
			</div>
				
			<div>
				<?php


				
				
				if (isset($_GET['page']))
				{
					$page = $_GET['page'];
				}
				else
				{
					$titre_page_index_SQL = mysql_query("SELECT valeur FROM config WHERE nom='index'");
					$tableau_titre_page_index = mysql_fetch_array($titre_page_index_SQL);
					$page = $tableau_titre_page_index['valeur'];
				}
				
				

				$nbr_page_titre = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM page WHERE titre='$page'") or die(mysql_error());
				$tableau_nbr_page_titre = mysql_fetch_array($nbr_page_titre) or die(mysql_error());

				//on récupere le contenu de la table page là ou le titre est égal à la variable $page(l.29)  et on les met dans la variable ou affiche l'erreur MySQL
				$contenu = mysql_query("SELECT * FROM contenu WHERE page='$page' ORDER BY id_element") or die(mysql_error());
				//on récupere le titre d la table page là ou l'index=1 (page index)  et on les met dans la variable ou affiche l'erreur MySQL
				


				if($tableau_nbr_page_titre['nbre_entrees'] == "1")
				{

					while ($tableau_contenu = mysql_fetch_array($contenu))
					{
						if($tableau_contenu['type'] == 'texte')
						{
							echo $tableau_contenu['texte']; 
							?><br /><?php
						}
						elseif($tableau_contenu['type'] == 'lien')
						{
							?><a href="http://<?php echo $tableau_contenu['href'];?>"><?php echo $tableau_contenu['texte'];?></a>
							<br /><?php
						}
						elseif($tableau_contenu['type'] == 'image' && $tableau_contenu['href'] == false)
						{
							?><img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" />
							<br /><?php
						}
						elseif($tableau_contenu['type'] == 'image' && $tableau_contenu['href'] == true)
						{
							?><a href="http://<?php echo $tableau_contenu['href']; ?>"><img src="http://<?php echo $tableau_contenu['src']; ?>" alt="<?php echo $tableau_contenu['alt']; ?>" title="<?php echo $tableau_contenu['infobulle']; ?>" /></a>
							<br /><?php
						}
						elseif($tableau_contenu['type'] == 'video')
						{
							?><br /><?php 
							echo $tableau_contenu['src']; 
						}
						elseif($tableau_contenu['type'] == 'br')
						{
							for ($nombre_de_boucle = 1; $nombre_de_boucle <= $tableau_contenu['taille']; $nombre_de_boucle++)
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
					?></p><?php
				}
		
			
			?>
			</div>
		<?php
		}
		elseif ( $status == "maintenance" )
		{
		echo "maintenance";
		}
		elseif ( $status == "fermeture" )
		{
		echo "fermeture";
		}
		elseif ( $status == "redirection" )
		{
		echo "redirection";
		}
		elseif ( $status == "personalise" )
		{
		echo "personalise";
		}
		else
		{
		echo "PROBLEME : status du site non défini!";
		}
		mysql_close();
		
if(isset($_SESSION['pseudo']))
{
?>
		<br />
		<br />
		<br />
		<br />
		<a href="liste_page.php">Administration</a>
<?php
}
$fin = microtime(true);
echo '<p class="text">Page exécutée en '.round(($fin - $debut),5).' secondes.</p>';
?>	

	</body>
</html>