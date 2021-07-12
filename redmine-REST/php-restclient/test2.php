<?php
require_once 'vendor/autoload.php';

$api = new RestClient([
    'base_url' => "http://correlyce.atrium-sud.fr/redmine/issues.json",
    'format' => "json",
    'headers' => [
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'X-Redmine-API-Key' => '1d1e9883fe746e732d3a42f87961211489f71e2b',
        // 'Authorization' => 'Bearer '.OAUTH_BEARER
    ],
]);
$result = $api->get("redmine/issues.json", ['q' => "#php"]);
if ($result->info->http_code == 200) {
    var_dump($result->decode_response());
} else {
    echo "Connexion n'a pas été établi !";
}
