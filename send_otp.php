
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.sendchamp.com/api/v1/verification/create',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "channel":"sms",
    "sender":"Sendchamp",    
    "token_type":"numeric",
    "token_length":"5",
    "expiration_time":6,
    "customer_mobile_number":"2348119974190",
    "customer_email_address":"sadiqful@gmail.com",
    "meta_data":{"first_name":"segun"}
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer SECRET_KEY',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

