<?php
require_once('../../../../wp-load.php');


$leads_email = boffeer_explode_textarea(carbon_get_theme_option('leads_emails'));
// $to = 'boffeechane@gmail.com';
$email_from = 'boffeer@beefheads.ru';



if ($_FILES['user_file']['error'] !== UPLOAD_ERR_OK) {
    die("File upload failed: " . $_POST['user_file']['error']);
}
$ff = ($_FILES['user_file']);
if (!empty($_FILES['user_file']['tmp_name'])) {
	$filepath = $_FILES['user_file']['tmp_name'];
	$filename = $_FILES['user_file']['name'];
} else {
	$filepath = '';
	$filename = '';
}


$body = '';
foreach ($_POST as $key => $value) {
	if (($key != 'file') && ($value != "") && ($key != "project_name") && ($key != "form_subject")  && ($key != "sendMail")) {
		$customkey = $key;
		if ($key == 'user_name') {
			$customkey = "Имя:";
		} elseif ($key == 'user_phone') {
			$customkey = 'Телефон:';
		} elseif ($key == 'user_email') {
			$customkey = 'E-mail:';
		} elseif ($key == 'user_city') {
			$customkey = 'Город:';
		} elseif ($key == 'user_message') {
			$customkey = 'Сообщение:';
		} elseif ($key == 'formname') {
			$customkey = 'Форма:';
		} elseif ($key == 'page') {
			$customkey = 'Страница:';
		} elseif ($key == 'user_company') {
			$customkey = 'Компания:';
		}


		$body .= "$customkey \r\n" . $value . "\r\n\r\n";
	}
}



$subject = 'Заявка с сайта';
$boundary = "--" . md5(uniqid(time())); // генерируем разделитель
$headers = "From: " . $email_from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
$headers .= "Content-Type: multipart/mixed; charset=\"utf-8\"; boundary=\"" . $boundary . "\"\r\n";
$multipart = "--" . $boundary . "\r\n";
$multipart .= "Content-type: text/plain; charset=\"utf-8\"\r\n";
$multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

$body = $body . "\r\n\r\n";


$multipart .= $body;
$file = '';
if (!empty($filepath)) {
	$fp = fopen($filepath, "r");
	if ($fp) {
		$content = fread($fp, filesize($filepath));
		fclose($fp);
		$file .= "--" . $boundary . "\r\n";
		$file .= "Content-Type: application/octet-stream\r\n";
		$file .= "Content-Transfer-Encoding: base64\r\n";
		$file .= 'Content-Disposition: attachment; name="' . basename($filename) . '"; filename="' . basename($filename) . '"' . "\r\n\r\n";
		$file .= chunk_split(base64_encode($content)) . "\r\n";
	}
}

$multipart .= $file . "--" . $boundary . "--\r\n";

foreach ($leads_email as $email) {
	wp_mail($email, $subject, $multipart, $headers);
}

echo json_encode(array('ok' => 'ok', 'leads' => json_encode($leads_email)));
