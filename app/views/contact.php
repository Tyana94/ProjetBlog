<?php

?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="mailform" align="left"> 
		<p>Vous avez des questions, n'hésitez pas à me contacter en remplissant le formulaire suivant : <br />
          <h3>Contact</h3>      
			<form method="POST" action="/blog">
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
