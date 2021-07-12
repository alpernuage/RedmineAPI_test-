<?php 
$api = new RestClient([
    'base_url' => "https://api.twitter.com/1.1", 
    'format' => "json", 
     // https://dev.twitter.com/docs/auth/application-only-auth
    'headers' => ['Authorization' => 'Bearer '.OAUTH_BEARER], 
]);
$result = $api->get("search/tweets", ['q' => "#php"]);
// GET http://api.twitter.com/1.1/search/tweets.json?q=%23php
if($result->info->http_code == 200)
    var_dump($result->decode_response());

?>