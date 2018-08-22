<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["contact-firstname"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
		$lastname = strip_tags(trim($_POST["contact-lastname"]));
				$lastname = str_replace(array("\r","\n"),array(" "," "),$lastname);
		$address = strip_tags(trim($_POST["contact-address"]));
				$address = str_replace(array("\r","\n"),array(" "," "),$address);
		$city = strip_tags(trim($_POST["contact-city"]));
				$city = str_replace(array("\r","\n"),array(" "," "),$city);
		$gender = strip_tags(trim($_POST["contact-gender"]));
				$gender = str_replace(array("\r","\n"),array(" "," "),$gender);
		$dob = strip_tags(trim($_POST["contact-dob"]));
				$dob = str_replace(array("\r","\n"),array(" "," "),$dob);
		$occupation = strip_tags(trim($_POST["contact-occupation"]));
				$occupation = str_replace(array("\r","\n"),array(" "," "),$occupation);
		$coo = strip_tags(trim($_POST["contact-coo"]));
				$coo = str_replace(array("\r","\n"),array(" "," "),$coo);
		$cl = strip_tags(trim($_POST["contact-cl"]));
				$cl = str_replace(array("\r","\n"),array(" "," "),$cl);
		$phone = strip_tags(trim($_POST["contact-phone"]));
				$phone = str_replace(array("\r","\n"),array(" "," "),$phone);		
        $email = filter_var(trim($_POST["contact-email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["contact-message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($lastname) OR empty($address) OR empty($city) OR empty($gender) OR empty($dob) OR empty($occupation) OR empty($coo) OR empty($cl) OR empty($phone) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "info@bolingo-ngo.org";

        // Set the email subject.
        $subject = "Join Us email from $name";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Surname: $lastname\n\n";
		$email_content .= "Address: $address\n\n";
		$email_content .= "City: $city\n\n";
		$email_content .= "Gender: $gender\n\n";
		$email_content .= "Date of birth: $dob\n\n";
		$email_content .= "Occupation: $occupation\n\n";
		$email_content .= "Country of origin: $coo\n\n";
		$email_content .= "Current location: $cl\n\n";
		$email_content .= "Phone number: $phone\n\n";
		$email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>