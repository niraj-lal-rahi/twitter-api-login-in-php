<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY','iVIwJjEqCzcZUo6iq7y4LGEdQ');
define('CONSUMER_SECRET','KwE5I8xB1F2jS8ib0x0czgW3SOUHPSX1TdrQOpNMC1q1nODy5X');
define('TWITTER_CALLBACK','http://localhost/tweet/user.php');

session_start();


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->oauth(
    'oauth/request_token', [
        'oauth_callback' => TWITTER_CALLBACK
    ]
);

if($connection->getLastHttpCode() != 200) {
    throw new \Exception('There was a problem performing this request');
}
$_SESSION['oauth_token']  = $request_token['oauth_token'];

$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// generate the URL to make request to authorize our application
$url = $connection->url(
    'oauth/authorize', [
        'oauth_token' => $request_token['oauth_token']
    ]
);
 
// and redirect
header('Location: '. $url);
exit;