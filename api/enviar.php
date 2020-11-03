<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mailsenderprojectgit@gmail.com';                 // SMTP username
    $mail->Password = '369246489';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('mailsenderprojectgit@gmail.com', 'Comprobante');
    $mail->addAddress($_POST['Email'], $_POST['Name']);
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = <<<EOT
        {$_POST['Asunto']}
        EOT;
        $mail->Body = <<<EOT
        {$_POST['Nombre']}, su mensaje ha sido enviado correctamente.
        EOT;
        $mail->send($_POST['Email'], $_POST['Name'])); 
        
}    catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mailsenderprojectgit@gmail.com';                 // SMTP username
    $mail->Password = '369246489';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('mailsenderprojectgit@gmail.com', 'Comprobante');
    $mail->addAddress('mailsenderprojectgit@gmail.com', 'Comprobante');
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = <<<EOT
        {$_POST['Asunto']}
        EOT;
        $mail->Body = <<<EOT
        Nombre: {$_POST['Nombre']}
        <br>
        Correo electrónico: {$_POST['Email']}
        <br>
        Dirección: {$_POST['Direccion']}
        <br>
        Teléfono: {$_POST['Telefono']}
        <br>
        Descripción del problema: {$_POST['Descripcion']}
        EOT;
        $mail->send('mailsenderprojectgit@gmail.com', 'Comprobante');
        header( "Location: /success.html" );
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}



/*    //Recipients
    $mail->setFrom('mailsenderprojectgit@gmail.com', 'Comprobante');
    $mail->addAddress($_POST['Email'], $_POST['Name']);
    $mail->addBCC('mailsenderprojectgit@gmail.com');
  
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = <<<EOT
    {$_POST['Asunto']}
    EOT;
    $mail->Body = <<<EOT
    Nombre: {$_POST['Nombre']}
    <br>
    Correo electrónico: {$_POST['Email']}
    <br>
    Dirección: {$_POST['Direccion']}
    <br>
    Teléfono: {$_POST['Telefono']}
    <br>
    Descripción del problema: {$_POST['Descripcion']}
    EOT;
    $mail->send();
    header( "Location: /success.html" );
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}*/
?>