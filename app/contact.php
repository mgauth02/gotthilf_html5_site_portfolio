<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=utf-8">
		<title>Marin Gauthier - Étudiant IMAC</title>
		<link rel="icon" href="fav.png" type="image/png"/>
		<meta name="Description" content="CV en ligne de Marin Gauthier, étudiant IMAC" />
		<meta name="Keywords" content="cv, job, student, IMAC" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<link href="styles/font-contact.css" rel="stylesheet" type="text/css"/>
		<link href='styles/main.min.css' rel='stylesheet' type='text/css'>
		<script src="js/jquery.fittext.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<div id="header">
		    	<div class="cbp-af-header">
					<div class="cbp-af-inner">
						<nav>
							<a href="index.html"><div class="logohead"><h1>a</h1></div></a>
							<ul>
								<li><a href="cv.html">cv</a></li>
								<li><a href="photo.html">photos</a></li>
								<li><a class="selected" href="contact.php">contact</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

			<div class="content contact">
			<h1 class="fitText">CONTACT</h1>

		<?php
		echo '<form id="contact" method="post" action="'.$form_action.'">';
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$destinataire = 'marin.gauthier@me.com';

// copie ? (envoie une copie au visiteur)
$copie = 'non';

// Action du formulaire (si votre page a des paramètres dans l'URL)
// si cette page est index.php?page=contact alors mettez index.php?page=contact
// sinon, laissez vide
$form_action = '';

// Messages de confirmation du mail
$message_envoye = "Merci, je vous contacterai au plus vite !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

// Message d'erreur du formulaire
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreurs.";

/*
 * NoSpamQuestion affiche une question pour la validation d'un formulaire ...
 * $mode, mode question ou réponse par défaut tirage au sort de question {string}
 * $answer, lors de la demande d'une réponse à la question numero tant ... {int}
 *
 * @returns array
 *
 * Ajouter une question :
 * copier/coller ces lignes et remplir le contenu entre guillemets doubles :
 *
 * $array_pictures[$j]['num'] = $j; // ne pas changer cette ligne
 * $array_pictures[$j]['question'] = "mettre ici la question (correspondant à l'image si vous utilisez une image)";
 * $array_pictures[$j]['answer'] = "mettre ici la réponse à l'énigme";
 * $j++; // ne pas oublier cette ligne dans la copie :-)
 *
 * C'est tout. Question suivante ? :-)
 *
 */
function NoSpamQuestion($mode = 'ask', $answer = 0)
{
	$array_pictures = array(); $j = 0;

	$array_pictures[$j]['num'] = $j;
	$array_pictures[$j]['question'] = "Quelle est la cinquième lettre du mot Kamoulox ?";
	$array_pictures[$j]['answer'] = "u";
	$j++;

	$array_pictures[$j]['num'] = $j;
	$array_pictures[$j]['question'] = "Le soleil est-il chaud ou froid ?";
	$array_pictures[$j]['answer'] = "chaud";
	$j++;

	$array_pictures[$j]['num'] = $j;
	$array_pictures[$j]['question'] = "Ecrire 12 en toutes lettres";
	$array_pictures[$j]['answer'] = "douze";
	$j++;

	if ($mode != 'ans')
	{
		// on est en mode 'tirer au sort', on tire une image aléatoire
		$lambda = rand(0, count($array_pictures)-1);
		return $array_pictures[$lambda];
	}
	else
	{
		// on demande une vraie réponse
		foreach($array_pictures as $i => $array)
		{
			if ($i == $answer)
			{
				return $array;
				break;
			};
		};
	}; // Fin if ($mode != 'ans')
};
/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/
	// on tire au sort une question
	$nospam = NoSpamQuestion();

/*
 * cette fonction sert à nettoyer et enregistrer un texte
 */
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}

	$text = nl2br($text);
	return $text;
};

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

// formulaire envoyé, on récupère tous les champs.
$nom        = (isset($_POST['nom']))        ? Rec($_POST['nom'])        : '';
$email      = (isset($_POST['email']))      ? Rec($_POST['email'])      : '';
$objet      = (isset($_POST['objet']))      ? Rec($_POST['objet'])      : '';
$message    = (isset($_POST['message']))    ? Rec($_POST['message'])    : '';
$antispam_h = (isset($_POST['antispam_h'])) ? Rec($_POST['antispam_h']) : '';
$antispam_r = (isset($_POST['antispam_r'])) ? Rec($_POST['antispam_r']) : '';

// On va vérifier les variables et l'email ...
$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

if (isset($_POST['envoi']))
{
	// On demande la vraie réponse
	$verif_nospam = NoSpamQuestion('ans', $antispam_r);

	if (strtolower($antispam_h) != strtolower($verif_nospam['answer']))
	{
		// le formulaire s'arrête ici
		echo '<p>Vous n\'avez pas répondu correctement à la question.</p><p><a class="again" href="contact.php">REESSAYEZ</a></p>';
	}
	else
	{
		if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
		{
			// les 4 variables sont remplies, on génère puis envoie le mail
			$headers  = '[PORTFOLIO] From:'.$nom.' <'.$email.'>' . "\r\n";
			//$headers .= 'Reply-To: '.$email. "\r\n" ;
			//$headers .= 'X-Mailer:PHP/'.phpversion();

			// envoyer une copie au visiteur ?
			if ($copie == 'oui')
			{
				$cible = $destinataire.','.$email;
			}
			else
			{
				$cible = $destinataire;
			};

			// Remplacement de certains caractères spéciaux
			$message = str_replace("&#039;","'",$message);
			$message = str_replace("&#8217;","'",$message);
			$message = str_replace("&quot;",'"',$message);
			$message = str_replace('<br>','',$message);
			$message = str_replace('<br />','',$message);
			$message = str_replace("&lt;","<",$message);
			$message = str_replace("&gt;",">",$message);
			$message = str_replace("&amp;","&",$message);

			// Envoi du mail
			if (mail($cible, $objet, $message, $headers))
			{
				echo '<p>'.$message_envoye.'</p>';
			}
			else
			{
				echo '<p>'.$message_non_envoye.'</p>';
			};
		}
		else
		{
			// une des 3 variables (ou plus) est vide ...
			echo '<p>'.$message_formulaire_invalide.'</p>';
			$err_formulaire = true;
		};
	};
}; // fin du if (!isset($_POST['envoi']))

if (($err_formulaire) || (!isset($_POST['envoi'])))
{
	// afficher le formulaire
	echo '
			<label for="nom"><span class="icon-user"></span></label><input placeholder="Votre nom" type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /><br>
			<label for="email"><span class="icon-email"></span></label><input placeholder="Votre email" type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /><br>
			<label for="objet"><span class="icon-info"></span></label><input placeholder="Objet" type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /><br>

			<label for="message"><span class="icon-pencil"></span></label><textarea placeholder="Message" id="message" name="message" tabindex="4" rows="8">'.stripslashes($message).'</textarea><br>
			<label id="antispam" for="antispam_h">'.$nospam['question'].'</label><br><input type="text" name="antispam_h" id="antispam_h" /><input type="hidden" name="antispam_r" value="'.$nospam['num'].'" />

			<input class="btn" type="submit" name="envoi" value="ENVOYER LE MESSAGE" />
	</form>';
};
?>
	</div>

<!-- /Contact -->

<script type="text/javascript">
$('[placeholder]').parents('form').submit(function() {
  $(this).find('[placeholder]').each(function() {
    var input = $(this);
    if (input.val() == input.attr('placeholder')) {
      input.val('');
    }
  })
});
</script>
<script>
	jQuery(".fitText").fitText(1.0, { minFontSize: '20px', maxFontSize: '60px' });
</script>
	</body>
</html>