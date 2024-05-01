<?php
$errors = [];
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $serviceType = $_POST['serviceType'];
    $service = $_POST['service'];
    $serviceDate = $_POST['serviceDate'];
    $specialRequest = $_POST['specialRequest'];

    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($mobile)) {
        $errors[] = 'Mobile number is empty';
    }

    if (empty($serviceType)) {
        $errors[] = 'Service type is not selected';
    }

    if (empty($service)) {
        $errors[] = 'Service is not selected';
    }

    if (empty($serviceDate)) {
        $errors[] = 'Service date is empty';
    }

    if (empty($errors)) {
        $toEmail = 'magadu.com'; // Change this to your email address
        $emailSubject = 'New Service Booking';
        $emailBody = "Name: $name\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Mobile: $mobile\n";
        $emailBody .= "Service Type: $serviceType\n";
        $emailBody .= "Service: $service\n";
        $emailBody .= "Service Date: $serviceDate\n";
        $emailBody .= "Special Request: $specialRequest\n";

        if (mail($toEmail, $emailSubject, $emailBody)) {
            header('Location: thank-you.html'); // Redirect to thank you page
            exit();
        } else {
            $errorMessage = 'Oops, something went wrong. Please try again later';
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
} else {
    // Handle case when form is not submitted via POST method
    $errorMessage = 'Invalid request method';
}
?>
