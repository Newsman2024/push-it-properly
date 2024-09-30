<?php
session_start();
$opt = $_SESSION['OTP'];

function generateOTP($length = 6) {
    return rand(pow(10, $length-1), pow(10, $length)-1);
}

function sendEmail($to, $subject, $message) {
   
    $headers = "From: rasheed@saltingstein.com\r\n";

   
    if (mail($to, $subject, $message, $headers)) {
        return true; 
        return false; 
    }
}

$to = "adewale2024@gmail.com";
$subject = "Verify-account OTP";
$message = "This is a test email.";

if (sendEmail($to, $subject, $message)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $otp = generateOTP();

    
    $subject = 'Login OTP';
    $message = "Your OTP for login is: $otp";
    $result = sendEmail($email, $subject, $message);

    if ($result) {
    
        $_SESSION['OTP'] = $otp;
        
        echo json_encode(array('message' => 'OTP sent successfully'));
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Error sending OTP'));
    }
}


else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $otp = generateOTP();
    
    $subject = 'Password Reset OTP';
    $message = "Your OTP for password reset is: $otp";
    $result = sendEmail($email, $subject, $message);

    if ($result) {
        
        $_SESSION['OTP'] = $otp;
        
        echo json_encode(array('message' => 'OTP sent successfully'));
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Error sending OTP'));
    }
}

// Invalid request method or missing parameters
// else {
// //    http_response_code(400);
//     echo json_encode(array('error' => 'Invalid request'));
// }
?>
