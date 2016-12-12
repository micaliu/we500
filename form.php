<?php
print("hell world!");

if (!empty($_POST)):
    print_r($_POST);
    $requiredFields = array(
        "name" => "Name",
        "email" => "Email",
        "content" => "Content"
    );
    $errorMsg = "";
    foreach ($requiredFields as $key => $value) {
        if (empty($_POST[$key])) {
            $errorMsg .= $value . "is required";
        }
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email address";
    }
    $to      = "micahliu153@gmail.com";
    $subject = "Contact from " . $_POST["email"];
    $message = "Name: " . $_POST["name"];
    $message = "\nEmail: " . $_POST["email"];
    $message = "\nContent: " . $_POST["content"];
    $headers = "From: " . $_POST["email"] . "\r\n" . "Reply-To: " . $_POST["email"] . "\r\n";
    mail($to, $subject, $message, $headers);

endif;
?>