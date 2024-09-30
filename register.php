<?php

require_once 'db.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    if (empty($username) || empty($password)) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode('Username and password are required');
        exit();
    }

    if (strlen($password) < 8) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array('error' => 'Password must be at least 8 characters long'));
        exit;
    }

        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param('ss', $username, $password); 
    $result = $stmt->execute();
    
    if ($result) {
        echo json_encode(array('success' => 'You registered successfully'));
    } else {
        echo json_encode(array('error' => 'Something went wrong, please contact the administrator'));
    }

    $stmt->close();
}

?>
