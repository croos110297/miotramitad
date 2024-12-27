<?php
session_start();

// Function to send WhatsApp invitation
function sendWhatsAppInvitation($phoneNumber, $message) {
    $ch = curl_init();
    $api_key = 'YOUR_TOKY_API_KEY'; // Replace with your Toky API key
    $headers = array(
        "X-Toky-Key: {$api_key}",
        "Content-Type: application/json"
    );

    $data = array(
        "from" => "YOUR_TOKY_SMS_PHONE_NUMBER", // Replace with your Toky SMS phone number
        "to" => $phoneNumber,
        "text" => $message
    );

    $json_data = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, "https://api.toky.co/v1/sms/send");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $curl_response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($curl_response, true);
    if (!$decoded["success"]) {
        $_SESSION["verificationcode"] = "";
        displayToastMessage('Error sending WhatsApp message: ' . $decoded["error_message"], 'error');
    } else {
        displayToastMessage('WhatsApp invitation sent successfully!', 'info');
    }
}

// Function to display toast messages
function displayToastMessage($message, $type) {
    if ($type == "error") {
        echo "<script>alert('Error: " . $message . "');</script>";
    } else {
        echo "<script>alert('" . $message . "');</script>";
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile_phone = $_POST["mobile_phone"];
    $message = $_POST["message"];
    
    // Send the WhatsApp invitation
    sendWhatsAppInvitation($mobile_phone, $message);
}
?>
