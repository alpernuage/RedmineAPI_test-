<?php 
$curl = curl_init();
$apiKey = '1d1e9883fe746e732d3a42f87961211489f71e2b';

$headers = array(
    'Content-Type:application/json',
    'Authorization: '.$apiKey
 );

curl_setopt_array($curl, [
    CURLOPT_URL => 'http://correlyce.atrium-sud.fr/redmine/issues.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 1,
    CURLOPT_HTTPHEADER => $headers
]);

$result = curl_exec($curl);
// $response = json_decode($result, true);

print_r($result);
// print_r($response);

// if ($data === false) {
//     var_dump(curl_error($curl));
// } else {
//     if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
//         $data = json_decode($data, true);
//         echo 'Datas récupérés : ' . $data[0];
//     }
// }

// curl_close($curl);

$curl_errno = curl_errno($curl);
$curl_error = curl_error($curl);
if ($curl_errno > 0) {
    echo "cURL Error ($curl_errno): $curl_error <br/>";
    return "";
} else {
    $data = json_decode($result);
    if($data->code == 0){
        return $data->stdout;
    }else{
        echo "Curl Error code: $data->code <br/>";
        echo "Error message: $data->stderr <br/>";
        return "";
    };
};
?>