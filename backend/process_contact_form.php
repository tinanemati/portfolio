<?php
// Define variables and set to empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and Validate the form data
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
      } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST['message'])) {
        $message = "";
      } else {
        $message = test_input($_POST["message"]);
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
        exit;
    } else {
        // Set an error message and redirect back to the form
        $error_message = 'There was a problem sending your message. Please try again later.';
        exit;
    }
}

function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}
?>