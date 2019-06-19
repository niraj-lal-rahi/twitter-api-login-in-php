<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY','iVIwJjEqCzcZUo6iq7y4LGEdQ');
define('CONSUMER_SECRET','KwE5I8xB1F2jS8ib0x0czgW3SOUHPSX1TdrQOpNMC1q1nODy5X');
define('TWITTER_CALLBACK','http://localhost/tweet/user.php');

session_start();
//$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
if($_GET['oauth_token'] || $_GET['oauth_verifier'])
{
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	
	$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_GET['oauth_verifier'],'oauth_token'=> $_GET['oauth_token']]);
	
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user_info = $connection->get('account/verify_credentials');
	echo "<pre>";
	print_r($user_info);
}