<?php
//header( "Location: /success.html" );
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
  // creates object
  $mail = new PHPMailer(true); 
  
  if(isset($_POST['btn_send']))
  {
   $full_name  = strip_tags($_POST['Nombre']);
   $email      = strip_tags($_POST['Email']);
   $subject    = "Sending HTML eMail using PHPMailer.";
   $text_message    = "Hello".$_POST['Nombre'].", <br /><br /> This is HTML eMail Sent using PHPMailer. isn't it cool to send HTML email rather than plain text, it helps to improve your email marketing.";      
   
   
   // HTML email starts here
   
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
    
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Programacion.net</th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
      <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/c' style='color:#fff; text-decoration:none;'>C</a></td>
       <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/php' style='color:#fff; text-decoration:none;'>PHP</a></td>
       <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/ASP' style='color:#fff; text-decoration:none;' >ASP</a></td>
       <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/java' style='color:#fff; text-decoration:none;' >Java</a></td>
      </tr>
      
      <tr>
       <td colspan='4' style='padding:15px;'>
        <p style='font-size:20px;'>Hi' ".$_POST['Nombre'].",</p>
        <hr />
        <p style='font-size:25px;'>Sending HTML eMail using PHPMailer</p>
        <img src='https://4.bp.blogspot.com/-rt_1MYMOzTs/VrXIUlYgaqI/AAAAAAAAAaI/c0zaPtl060I/s1600/Image-Upload-Insert-Update-Delete-PHP-MySQL.png' alt='Sending HTML eMail using PHPMailer in PHP' title='Sending HTML eMail using PHPMailer in PHP' style='height:auto; width:100%; max-width:100%;' />
        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
       </td>
      </tr>
      
      </tbody>";
    
   $message .= "</table>";
   
   $message .= "</td></tr>";
   $message .= "</table>";
   
   $message .= "</body></html>";
   
   // HTML email ends here
   
   try
   {
    $mail->SMTPDebug  = 2; 
    $mail->IsSMTP(); 
    $mail->Host       = $SMTP;             
    $mail->SMTPAuth   = true;                              
    $mail->Username   =$USER;  
    $mail->Password   =$PASS; 
    $mail->SMTPSecure = "tls";                   
    $mail->Port       = 587;  
    $mail->isHTML(true);            
                         $mail->setFrom($USER,'Comprobante');
                         $mail->addAddress($USER, $_POST['Email'], $_POST['Nombre']);
    $mail->Subject = 
            <<<EOT
                {$_POST['Asunto']}
            EOT;
    $mail->Body    = $message;
    $mail->AltBody    = $message;
     
    if($mail->Send())
    {
     
     $msg = "<div class='alert alert-success'>
       Hi,<br /> ".$full_name." mail was successfully sent to ".$email." go and check, cheers :)
       </div>";
     
    }
   }
   catch(phpmailerException $ex)
   {
    $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
   }
  } 
  
?>