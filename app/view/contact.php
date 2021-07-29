<?php
if(isset($_POST['mailform']))
{
	if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
	{
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Tati.com"<tisikacoco971@hotmail.com>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					<u>Prénom de l\'expéditeur :</u>'.$_POST['prenom'].'<br />
                    <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
					<u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
					<br />
					'.nl2br($_POST['message']).'
				</div>
			</body>
		</html>
		';

		mail("tatiana.rilcy@gmail.com", "CONTACT - Monsite.com", $message, $header);
		$msg="Votre message a bien été envoyé !";
	}
	else
	{
		$msg="Tous les champs doivent être complétés !";
	}
}
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="mailform" align="left"> 
		<p>Vous avez des questions, n'hésitez pas à me contacter en remplissant le formulaire suivant : <br />
          <h3>Contact</h3>      
			<form method="POST" action="">
					<input type="text" name="prenom" placeholder="Prenom" value="<?php if(isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" /><br /><br />
					<input type="text" name="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
					<input type="email" name="mail" placeholder="Email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
					<textarea rows="5" cols="50" name="message" placeholder="Message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
					<input type="submit" value="Envoyer" name="mailform"/>
			</form>
		</div>
		<?php
		if(isset($msg))
		{
			echo $msg;
		}
		?>
	</body>
</html>
