<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/phpmailer/src/SMTP.php";

require_once "../settings/settings.php";
require_once "../settings/db.php";



function notificationData()
{
    global $connection;
    $today = date("Y-m-d");

    $query = "SELECT * FROM actions  
    LEFT JOIN action_responsible ON actions.action_id = action_responsible.a_action_id 
    LEFT JOIN users ON a_action_responsible.a_responsible_user = users.user_id 
    WHERE actions.action_promise_date < '$today' AND actions.action_complete = 0
    ";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($result))
    {
        echo $row['user_name']."<br>";
    }
}




function sendEmail($email, $title, $message, $attach = array(), $CC = array())
{
    global $connection;
    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try 
    {    
        //Server settings
        $mail->SMTPDebug  = 0;                                                // Enable verbose debug output con 2
        $mail->isSMTP();                                                      // Set mailer to use SMTP
        $mail->Host       = 'mail.martechsender.com;mail.martechsender.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                             // Enable SMTP authentication
        $mail->Username   = 'noreply@martechsender.com';                      // SMTP username
        $mail->Password   = 'martechmedical';                                 // SMTP password
        $mail->SMTPSecure = 'tls';                                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                              

        //Recipients
        $mail->setFrom('noreply@martechsender.com', 'Electronic purchase system');
        $mail->addAddress($email);                                            // Add a recipient
        //$mail->addCC($email);

        // Content
        $mail->isHTML(true);                                                 // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $message;

        if(count($CC) > 0)
        {
            foreach($CC as $user)
            {
                $mail->addCC($user);
            }
        }
        
        if(count($attach) > 0)
        {
            foreach($attach as $file)
            {
                try{
                    $mail->addAttachment("../".$file);
                }
                catch(Exception $e){
                    $mail->addAttachment($file);
                }
            }
        }
        
        
        $mail->send();
        
    } catch (Exception $e) 
    {   
        echo "Can't send the email.";
    }
}


notificationData();