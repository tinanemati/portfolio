<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the data
    if (empty($name) || empty($email) || empty($message)) {
        // Set an error message and redirect back to the form
        $error_message = 'Please fill out all the fields.';
        header('Location: contact.php?error=' . urlencode($error_message));
        exit;
    }

    // Set up the email recipient and subject
    $to = 'tinanemati.tina@gmail.com';
    $subject = 'New message from ' . $name;

    // Set up the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message:\n\n$message";

    // Send the email
    $headers = "From: $name <$email>\r\nReply-To: $email\r\n";
    if (mail($to, $subject, $email_message)) {
        // Set a success message and redirect back to the form
        $success_message = 'Your message was sent successfully.';
        header('Location: contact.php?success=' . urlencode($success_message));
        exit;
    } else {
        // Set an error message and redirect back to the form
        $error_message = 'There was a problem sending your message. Please try again later.';
        header('Location: contact.php?error=' . urlencode($error_message));
        exit;
    }
}else {
    // If the form was not submitted, redirect back to the form
    header('Location: contact.php');
    exit;
}
?>