<?php

require_once 'db.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = trim($_POST['name']);
    $date= trim($_POST['date']);
    $time = trim($_POST['time']);

    // if (empty($name) || empty($date) || empty($time)) {
    //     header("HTTP/1.1 400 Bad Request");
    //     echo json_encode('All fields are required');
    //     exit();
    // }

    // if (strlen($password) < 8) {
    //     header("HTTP/1.1 400 Bad Request");
    //     echo json_encode(array('error' => 'Password must be at least 8 characters long'));
    //     exit;
    // }

        $sql = "INSERT INTO booking (name, date, time) VALUES (?, ?, ?)";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param('sss', $name, $date, $time); 
    $result = $stmt->execute();
    
    if ($result) {
        echo json_encode(array('success' => 'You registered successfully'));
    } else {
        echo json_encode(array('error' => 'Something went wrong, please contact the administrator'));
    }

    $stmt->close();
}

?>
