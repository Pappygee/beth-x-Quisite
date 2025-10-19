

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo json_encode(['success' => false, 'message' => 'Invalid request.']);
	exit;
}

// Get and sanitize input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate
if (!$name || !$email || !$subject || !$message) {
	echo json_encode(['success' => false, 'message' => 'All fields are required.']);
	exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
	exit;
}

$mail = new PHPMailer(true);
try {
	// SMTP configuration
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'odugbesanelizabeth3@gmail.com'; // Replace with your Gmail address
	$mail->Password = 'mnfn puxn doxh yejp'; // Replace with your Gmail App Password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port = 587;

	// Recipients
	$mail->setFrom($email, $name);
	$mail->addAddress('odugbesanelizabeth3@gmail.com');
	$mail->addReplyTo($email, $name);

	// Content
	$mail->isHTML(false);
	$mail->Subject = "Contact Form: $subject";
	$mail->Body    = "You have received a new message from the contact form on your website.\n\n" .
		"Full Name: $name\n" .
		"Email: $email\n" .
		"Subject: $subject\n" .
		"Message:\n$message\n";

	$mail->send();
	echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully!']);
} catch (Exception $e) {
	echo json_encode(['success' => false, 'message' => 'Failed to send your message. Mailer Error: ' . $mail->ErrorInfo]);
}
exit;



