<?php
header( "Location: /success.html" );
// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Loading Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

if(file_exists(".env")) {
    $dotenv->load();
}

$USER = $_ENV['USER'];
$PASS = $_ENV['PASS'];
$SMTP = $_ENV['SMTP'];
$dotenv->required(['USER', 'PASS', 'SMTP'])->notEmpty();

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $SMTP;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $USER;                 // SMTP username
    $mail->Password = $PASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($USER, 'Comprobante');
    
    $mail->addAddress($USER, $_POST['Email'], $_POST['Nombre']);
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 
          <<<EOT
             {$_POST['Asunto']}
          EOT;
          $mail->Body    = $message;
          $mail->AltBody    = $message;
/*        $mail->Body = 
              <<<EOT
                 {$_POST['Nombre']}, su mensaje ha sido enviado correctamente.
              EOT;
        $mail->send(); 
        
        $mail->ClearAllRecipients();
    
        $mail->addAddress($USER, 'Comprobante');
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
        $mail->send();*/
    
           // HTML email starts here
   
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
    
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Comprobante</th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
      <tr>
       <td colspan='4' style='padding:15px;'>
        <p style='font-size:20px;'>Hola ".$_POST['Nombre'].",</p>
        <hr />
        <p style='font-size:25px;'>Su mensaje ha sido enviado correctamente.</p>
        <img src='/../public/img/check.png' alt='Check' style='height:auto; width:100%; max-width:100%;' />
        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
       </td>
      </tr>
      
      </tbody>";
    
   $message .= "</table>";
   
   $message .= "</td></tr>";
   $message .= "</table>";
   
   $message .= "</body></html>";
   
   // HTML email ends here

}    catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

?>
