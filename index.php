<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<meta name="description" content="Application FollowFriday en PHP. Disponible sur mon Github" />
	<title>Follow Friday</title>
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
</head>

<body>

	<nav id="reseaux">
		<ul>
			<li><a href="https://twitter.com/Kidaas" target="_blank">- Follow @Kidaas -</a></li>
			<li><a href="https://twitter.com/share" target="_blank">- Tweeter -</a></li>
			<li><a href="https://github.com/Kidaas" target="_blank">- Github -</a></li>
		</ul>
	</nav>
	
	<section>
		<div class="friends" >
			<?php 
				// Paramètres de configuration
				include('./config/config.php');
				//La bibliothèque oAuth
				require_once ('./twitteroauth/twitteroauth.php'); 
				
				$new = false;

				// Test si le fichier temporaire existe
				// Si il n'existe pas, le créer
				if (!file_exists($cache)){ 
					fclose(fopen($cache, 'w'));
					$new = true;
				}

				if ($new || time() - filemtime($cache) > 600){
						//Création de l'objet
						$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
						$connection->host = "https://api.twitter.com/1.1/";
						// Requete
						$content = $connection->get('friends/list', array('count' => $count, 'screen_name' => $pseudo));
						// Met en cache
						file_put_contents($cache, serialize($content));

				}else{ // Récupère les données en cache
					$content = unserialize(file_get_contents($cache));
				}

				// Parcour les tweets et les affiches
				foreach ($content->users as $key => $user){
					echo '<a class="popup" href="https://twitter.com/'.$user->screen_name.'" target="_blank">
							<img src= "'.$user->profile_image_url.'" />
							<span>
								<strong>'.$user->name.'</strong>
								<p class="pseudo">@'.$user->screen_name.'</p>
								<p class="description">'.$user->description.'</p>
							</span>
						  </a>';	
				}
			?>
		</div>
	</section>
	<footer>
		<a href="http://kevinsarrazin.fr/" target="_blank">© 2014 Kidas.</a>		
	</footer>
	
	</body>
</html>
