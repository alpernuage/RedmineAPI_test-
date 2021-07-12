<?php
$url = "http://correlyce.atrium-sud.fr/redmine/issues.json";
$headers = array(
    'X-Redmine-API-Key: 1d1e9883fe746e732d3a42f87961211489f71e2b',
    'Content-type: application/json'
);

$ch = curl_init();

$options = array(
    CURLOPT_URL => $url,
    CURLOPT_CUSTOMREQUEST => "GET",
    // CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_POSTREDIR => 3, //3 means follow redirect with the same type of request both for 301 and 302 redirects.
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HEADER => $headers
);

curl_setopt_array($ch, $options);


$output = curl_exec($ch);

echo $output;

if (curl_errno($ch)) {
    print "Error: " . curl_error($ch);
    exit();
}

// Show me the result
curl_close($ch);

// $json= json_decode($output, true);
// echo $json;
