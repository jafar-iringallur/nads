<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $phone = $_POST['phone'] ?? "";
    $message = $_POST['message'];

    // Validate form fields
    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

  

    if (empty($phone)) {
        $errors[] = 'Phone is required.';
    }



    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If there are no validation errors, send data via email
    if (empty($errors)) {
        $to = 'info@nads.co.in'; // Replace with the recipient email address
        $subject = 'New Contact Form Submission';
        $messageBody = "Name: $name\n";
        $messageBody .= "Phone: $phone\n";
        $messageBody .= "Message: $message\n";

        // Send email
        $headers = "From: mail@nads.co.in\r\n";
        if (mail($to, $subject, $messageBody, $headers)) {
            // Email sent successfully
            $response = ['success' => true];
        } else {
            // Error sending email
            $response = ['success' => false, 'message' => 'Error sending your message. Please try again later.'];
        }
    } else {
        // Validation errors occurred
        $response = ['success' => false, 'errors' => $errors];
    }

    echo json_encode($response);
}
?>
