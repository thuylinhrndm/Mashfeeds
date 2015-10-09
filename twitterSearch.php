<?php
include "TwitterAPIExchange.php";
$settings = array(
'oauth_access_token' => "2265678453-b1hyjrgOaTtHW9QorTDf4hFNXb5SlX6rtD8gZm0",
'oauth_access_token_secret' => "HNWLhVqsm2e2OUcMhNMMkKWxMBNEHZnYt8yBRRNzJUlkv",
'consumer_key' => "cLSXLYu3ze7nGCMoIlOWA",
'consumer_secret' => "XFJG8ifjHqs8GfM5z7ktHNBRNtmM03wQl8zuP7So0"
);

if(isset($_GET['keyword'])){

	$keywords = explode(' ', $_GET['keyword']);
	$keyword = $keywords[0];
	
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';
	$getfield = '?q='.$keyword.'&result_type=recent';

	$twitter = new TwitterAPIExchange($settings);

	$api_response = $twitter ->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();


	$response = json_decode($api_response);

	echo '<div style="width:95%; word-wrap:normal;">';
	foreach($response as $tweet){
		foreach($tweet as $t){
		      echo'<div style="text-decoration-line:overline; float:left;">';
		      echo'<img src="'.$t->user->profile_image_url.'" />&nbsp;';
		      echo'</div>';
			  echo'<div style="text-decoration-line:overline; font-style:normal; text-align:justify; vAlign:top; align:left;" >';
			
			/*$user =$t->user;
			$username = explode(' ' ,$user);
			echo $user;*/
			
			$text = $t->text.''; // works
			$words = explode(' ' ,$text); // works
			for ($i = 0; $i < count($words); $i++){ // works through all words in tweet
				if($words[$i] == $keyword){ // works/case-sensitive
					$words[$i] = '<b>'.$words[$i].'</b>'; // adds b-tag to the keyword
				}
			}
			
			for ($i = 0; $i < count($words); $i++){
				echo $words[$i].' ';
			}
			
			echo '</div><br /><br/>';
			
			//echo'<img src="'.$t->user->profile_image_url.'" />'.$text.'</br>';
		}
	}
	echo '</div>';
	       
} else {
	echo 'Invalid attribute/value pair!';
}
?>