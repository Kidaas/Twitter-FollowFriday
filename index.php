<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<title>Afficher derniers friends twitter</title>
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
</head>

<body class="page lang-fr">
	<header>
		<a class="brand" href="http://kevinsarrazin.fr/"><img src="./img/user.jpg" width="50px" /></a>
	</header>

	<aside id="reseaux">
		<a href="https://twitter.com/Kidaas" class="twitter-follow-button" data-show-count="false">Follow @Kidaas</a>
		<a href="https://twitter.com/share" class="twitter-share-button" data-via="Kidaas" data-hashtags="FollowFriday">Tweet</a>
		<a href="https://github.com/Kidaas" target="_Blank"><img src="./img/github.gif" width="100px"/></a>
	</aside>
	
	<section>
		<div class="friends" >
	<?php 
		// Paramètres de configuration
		include('./config/config.php');
		//La bibliothèque oAuth
		require_once ('./twitteroauth/twitteroauth.php'); 
		
		//Création de l'objet
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$connection->host = "https://api.twitter.com/1.1/";
		
		$i = 0;
		// -1 = Liste des derniers friends en date
		$cursor = -1;
		
		While ($i < $max && $cursor != 0){
			// Requète
			$query = 'https://api.twitter.com/1.1/friends/list.json?cursor='.$cursor.'&screen_name=xhark';
			$content = $connection->get($query);
			
			// Test si $content n'est pas vide et ne contient pas d'erreur
			if(!empty($content) && empty($content->errors[0]->code)){ 
				// Récupère le curseur permettant d'atteindre les 20 prochains enregistrements
				$cursor = $content->next_cursor_str;
				foreach($content as $list){
					if(is_array($list)){ 
						foreach($list as $user){
							if(!empty($user)){ 		
								echo '<a class="popup" href="https://twitter.com/'.$user->screen_name.'" target="_Blank">
										<img src= "'.$user->profile_image_url.'" />
										<span>
											<p>Pseudo : '.$user->screen_name.'</p>
											<p>Nom : '.$user->name.'</p>
										</span>
									  </a>';		 
							}
						}
					}
				}
			}else {
				echo '<span class="erreur"><img src="./img/warning.png" width="30px" /> Erreur limite de requète sur la base de données de twitter atteinte. (Attente de 15min maximum).</span>';
				break;
			}
			$i++;
		}
	?>
	</div>
	</section>
	<footer>
		<a href="http://kevinsarrazin.fr/">© 2014 Kidas.</a>		
	</footer>
	
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>	
	</body>
</html>
