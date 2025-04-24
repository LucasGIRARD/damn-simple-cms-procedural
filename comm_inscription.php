<?php
// on teste si le visiteur a soumis le formulaire  
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription')
{ 
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides 
	if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])))
	{ 
		// on teste les deux mots de passe 
		if ($_POST['pass'] != $_POST['pass_confirm'])
		{ 
			echo 'Les 2 mots de passe sont différents.'; 
		} 
		else 
		{ 
			mysql_connect("localhost", "root", "root") or die(mysql_error());
			mysql_select_db("admin") or die(mysql_error());

			// on recherche si ce pseudo est déjà utilisé par un autre membre  
			$sql = mysql_query('SELECT count(*) FROM user WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'"') or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
			$data = mysql_fetch_array($sql); 

			if ($data[0] == 0) 
			{ 
				mysql_query('INSERT INTO user VALUES("", "'.mysql_escape_string($_POST['pseudo']).'", "'.md5(mysql_escape_string($_POST['pass'])).'")') or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 

				session_start(); 
				$_SESSION['pseudo'] = $_POST['pseudo']; 
				header('Location: index.php'); 
				exit(); 
			} 
			else 
			{ 
				echo 'Un membre possède déjà ce pseudo.'; 
			} 
		} 
	} 
	else 
	{ 
		echo 'Au moins un des champs est vide.'; 
	}  
}  
 ?>
 <html>
	<head>
		<title>Inscription</title>
	</head>

	<body>
		Inscription à l'espace membre :<br />
		<form action="comm_inscription.php" method="post">
		Pseudo : <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>"><br />
		Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
		Confirmation du mot de passe : <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>"><br />
		<input type="submit" name="inscription" value="Inscription">
		</form>
		<?php
		if (isset($erreur)) echo '<br />',$erreur;  
		?>
	</body>
</html> 