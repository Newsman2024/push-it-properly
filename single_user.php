
<?php

require_once 'db.php'; 
require_once 'jwt_utils.php'; 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
error_reporting(E_ALL);

$bearer_token = get_bearer_token();

$is_jwt_valid = is_jwt_valid($bearer_token);

if ($is_jwt_valid) {
   
    $decoded_token = decode_jwt($bearer_token);

    if ($decoded_token !== null && isset($decoded_token['username'])) {
       
        $username = $decoded_token['username'];
        
        $sql = "SELECT * FROM user WHERE username = ? AND password_hash;

        if (!password_verify($data['password'], $user['password_hash'])) {
            http_response_code(401);
                echo json_encode(["message" => "invalid authentication"]);
                 exit;
             }
        $results = dbQuery($sql, array($username));

       
        $rows = array();
        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array('error' => 'Invalid token payload'));
    }
} else {
    echo json_encode(array('error' => 'Access denied'));
}


function decode_jwt($token) {
    
    $token_parts = explode('.', $token);
    
    
    $payload = base64_decode($token_parts[1]);
    
    
    return json_decode($payload, true);
}
?>
