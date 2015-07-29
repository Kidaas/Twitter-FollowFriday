Application-FollowFriday
========================

Application PHP - FollowFriday utilisant Twitter API 1.1

Cette application permet de retourner les X dernières personne que vous suivez sur Twitter. 
Elle a été créé pour faciliter l'affichage des Abonnements pour le Follow Friday.

Le fichier config/config.php contient les paramètres lambda à renseigner :
- $count : nombres de personnes à retourner
- $pseudo : pseudo (@xxxx) de la personne dont souhaite retourner les abonnements
- $cache : le chemin et nom du fichier servant de cache
- Informations de votre compte twitter dev : https://apps.twitter.com/
    - $consumer_key=''; //Application consumer key
    - $consumer_secret=''; //Application consumer secret key
    - $oauth_token = ''; //oAuth Token
    - $oauth_token_secret = ''; //oAuth Token Secret
    
