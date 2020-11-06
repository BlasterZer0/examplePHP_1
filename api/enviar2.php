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
  
  // creates object
  $mail = new PHPMailer(true); 
  
  if(isset($_POST['submit']))
  {
   $full_name  = strip_tags($_POST['Nombre']);
   
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
    
   $message .= 
      "<tbody>
      
      <tr>
       <td colspan='4' style='padding:15px;'>
        <p style='font-size:20px;'>Hola ".$full_name.",</p>
        <hr />
        <p style='font-size:25px;'>Su mensaje ha sido enviado correctamente.</p>
        <img src='https://examplephp-1.vercel.app/img/1553188267316_1.jpg' style='height:auto; width:100%; max-width:100%;'/>
       </td>
      </tr>
      
      </tbody>";
       
   $message .= "</body></html>";
   
   // HTML email ends here
   
   try
   {
    $mail->IsSMTP(); 
    $mail->isHTML(true);
    $mail->SMTPDebug  = 2;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "tls";                 
    $mail->Host       = $SMTP;      
    $mail->Port       = 587;             
    $mail->Username   = $USER;  
    $mail->Password   = $PASS;            
                         $mail->setFrom($USER,'Comprobante');
                         $mail->addAddress($_POST['Email'], $_POST['Nombre']);
    $mail->Subject    =  <<<EOT
                            {$_POST['Asunto']}
                         EOT;
    $mail->Body       = $message;
    $mail->AltBody    = $message;
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
        $mail->send();
    
   }
   catch(Exception $e)
   {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
   }
  } 
  
?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sending HTML eMail using PHPMailer in PHP</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://www.programacion.net" title='Programming Blog'>Programacion.net</a>
            <a class="navbar-brand" href="http://programacion.net/articulos/c">C</a>
            <a class="navbar-brand" href="http://programacion.net/articulos/php">PHP</a>
            <a class="navbar-brand" href="http://programacion.net/articulos/java">Java</a>
        </div>
    </div>
</div>


<div class="container">

 <div class="page-header">
     <h1>Send HTML eMails using PHPMailer in PHP</h1>
    </div>
     
    <div class="email-form">
    
     <?php
  if(isset($msg))
  {
   echo $msg;
  }
  ?>
        
     <form method="post" class="form-control-static">
        
            <div class="form-group">
                <input class="form-control" type="text" name="full_name" placeholder="Full Name" />
            </div>
            
            <div class="form-group">
                <input class="form-control" type="text" name="email" placeholder="Your Mail" />
            </div>
            
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="btn_send">
                <span class="glyphicon glyphicon-envelope"></span> Send Mail
                </button>
            </div>
        
     </form>
    </div>    
</div>

</body>

</html>