<?php
//header( "Location: /success.html" );
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Loading Dotenv
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

echo $_ENV['GMAILUSER'].PHP_EOL;
echo $_SERVER['GMAILUSER'].PHP_EOL;
echo $_ENV['GMAILPASSWORD'].PHP_EOL;
echo $_SERVER['GMAILPASSWORD'].PHP_EOL;
$dotenv->required('GMAILUSER')->notEmpty();
$dotenv->required('GMAILPASSWORD')->notEmpty();

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    echo $_ENV['GMAILUSER'].PHP_EOL;
echo $_SERVER['GMAILUSER'].PHP_EOL;
echo $_ENV['GMAILPASSWORD'].PHP_EOL;
echo $_SERVER['GMAILPASSWORD'].PHP_EOL;
$dotenv->required('GMAILUSER')->notEmpty();
$dotenv->required('GMAILPASSWORD')->notEmpty();
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '$GMAILUSER';                 // SMTP username
    $mail->Password = '$GMAILPASSWORD';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('mailsenderprojectgit@gmail.com', 'Comprobante');
    
    $mail->addAddress($_POST['Email'], $_POST['Nombre']);
//    $mail->addBCC('mailsenderprojectgit@gmail.com');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 
          <<<EOT
             {$_POST['Asunto']}
          EOT;
        $mail->Body = 
              <<<EOT
                 {$_POST['Nombre']}, su mensaje ha sido enviado correctamente.
              EOT;
        $mail->send(); 
        
        $mail->ClearAllRecipients();
    
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
        $mail->send();
    
}    catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

?>
