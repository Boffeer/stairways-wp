<?php
require_once('../../../../wp-load.php');

$message_name = 'Stairways заявки';
$message_email = 'boffeer@beefheads.ru';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получаем все поля из формы и файл, если он есть
  $fields = $_POST;
  $file = $_FILES['user_file'];

  // Задаем email адреса получателей
  $to = boffeer_explode_textarea(carbon_get_theme_option('leads_emails'));
  $to = implode(',', $to);

  // Заголовки письма
  $subject = 'Новое сообщение с сайта';
  $headers = array(
    'From: ' . $message_name . ' <' . $message_email . '>',
    'Reply-To: ' . 'info@steppnz.ru',
    'Content-Type: text/html; charset=UTF-8',
    // 'multipart' => true,
    // 'Content-Type: multipart/mixed; boundary=boundary'
  );

  // Создаем тело письма
  $message = '<html><body>';
  foreach ($fields as $key => $value) {
    if ($key !== 'user_file') {
      $message .= '<p><strong>' . ucfirst($key) . ':</strong> ' . $value . '</p>';
    }
  }
  $message .= '</body></html>';

  // Если файл был загружен, добавляем его как вложение
  if ($file['size'] > 0) {
    $file_name = $file['name'];
    $file_type = $file['type'];

    // Получаем расширение файла из MIME-типа
    $mime_types = wp_get_mime_types();
    $ext = array_search($file_type, $mime_types, true);
    if (!$ext) {
      // Если не удалось получить расширение из MIME-типа, пытаемся получить его из имени файла
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    }

    // Генерируем имя файла с расширением
    $file_name_with_ext = basename($file_name, '.' . $ext) . '.' . $ext;

    // Создаем массив вложений
    $attachments = array(
      'name' => $file_name_with_ext,
      'type' => $file_type,
      'tmp_name' => $file['tmp_name'],
      'error' => $file['error'],
      'size' => $file['size']
    );
  } else {
    $attachments = array();
  }

  // Отправляем письмо через wp_mail()
  if (wp_mail($to, $subject, $message, $headers, $attachments)) {
    echo 'Сообщение успешно отправлено';
  } else {
    echo 'Ошибка при отправке сообщения';
  }
}
