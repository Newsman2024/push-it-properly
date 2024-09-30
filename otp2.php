<?php
session_start();
$otp = $_SESSION['OTP'];
function generateOTP($length = 5) {
    $characters = '0123456789';
    $otp = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
       // $otp .= $characters[random_int(0, $max)];
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

// function sendOTP($email, $otp) {
//     $to = $email;
//     $subject = 'Reset Password OTP';
//     $message = 'Your OTP for resetting the password is: ' . $otp;
//     $headers = 'From: rasheed@saltingstein.com' . "\r\n" .
//         'Reply-To: adewale2024@gmail.com' . "\r\n" .
//         'X-Mailer: PHP/' . phpversion();

  
//     return mail($to, $subject, $message, $headers);
// }


function sendOTP($email, $otp) {
    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false; 
    }

    $to = $email;
    $subject = 'Reset Password OTP';
    $message = 'Your OTP for resetting the password is: ' . $otp;
    $headers = 'From: rasheed@saltingstein.com' . "\r\n" .
        'Reply-To: adewale2024@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Send email
    return mail($to, $subject, $message, $headers);
}

function verifyOTP($email, $otp) {
    
    $otp_database = array(
        'user1@example.com' => '123456', 
        'user2@example.com' => '654321'
    );

    // Retrieve stored OTP from the database based on the user's email
    if (isset($otp_database[$email]) && $otp_database[$email] === $otp) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];

    
    $otp = generateOTP();

    // Store OTP securely (e.g., in the database)
    $otp = $_SESSION['OTP'];
    // Send OTP via email
    $success = sendOTP($email, $otp);

    if ($success) {
        echo "OTP has been sent to your email address. Please check your inbox.";
    } else {
        echo "Failed to send OTP. Please try again later.";
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['otp'])) {
    // If OTP form is submitted

    // Retrieve OTP and email from the form
    $email = $_GET['email'];
    $user_entered_otp = $_GET['otp'];

    // Verify OTP
    if (verifyOTP($email, $user_entered_otp)) {
        // OTP is valid, allow the user to reset the password
        echo "OTP is valid. Proceed with password reset process.";
        // Now you can redirect the user to the password reset form
    } else {
        // OTP is invalid
        echo "Invalid OTP. Please try again.";
    }
}

?>
