<?php

// Test are comprised of two components: a simple xml response for testing
// interaction via the built-in PHP server, and PHPUnit test methods. 

// Test Server
// This code is only executed by the test server instance. It returns simple 
// JSON debug information for validating behavior. 
// if(php_sapi_name() == 'cli-server'){
//     header("Content-Type: application/json");
//     die(json_encode(array(
//         'SERVER' => $_SERVER, 
//         'REQUEST' => $_REQUEST, 
//         'POST' => $_POST, 
//         'GET' => $_GET, 
//         'body' => file_get_contents('php://input'), 
//         'headers' => getallheaders()
//     )));
// }


// Unit Tests
// 

require 'restclient.php';

    $api = new RestClient([
        'base_url' => "http://correlyce.atrium-sud.fr/redmine",
        'format' => "xml",
        'headers' => [
            'accept' => 'application/xml',
            'content-type' => 'application/xml',
            'X-Redmine-API-Key' => '1d1e9883fe746e732d3a42f87961211489f71e2b',
            // 'Authorization' => 'Bearer '.OAUTH_BEARER
        ],
    ]);

    var_dump($api);
    $result = $api->get("issues");
    var_dump($result);
    if ($result->info->http_code == 200) {
        var_dump($result->decode_response());
    } else {
        echo "Connexion n'a pas été établi !";
    }


