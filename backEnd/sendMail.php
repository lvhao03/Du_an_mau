<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  require './PHPMailer/src/Exception.php';
  require './PHPMailer/src/PHPMailer.php';
  require './PHPMailer/src/SMTP.php';    
  $mail = new PHPMailer(true);

  try {
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;

      // người gửi
      $mail->Username = 'haolvps25540@fpt.edu.vn';
      $mail->Password = 'eudtxajwnguyusom'; 
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587; 
      
      // người nhận
      $mail->setFrom('haolvps25540@fpt.edu.vn', 'Candyleaf');
      $mail->addAddress($_POST['email']); 

      $mail->isHTML(true);  
      $mail->Subject =  'Welcome to my website';
      $mail->Body =  'Cảm ơn bạn đã đăng ký làm thành viên trên website của chúng tôi';

      $mail->send();
      echo 'Gửi mail thành công';
      header('Location: http://localhost:8080/PHP_1/assignment1/backEnd/index.php');
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }