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
    $CC = array();
    $email = "ailsender@martechsender.com";
    //$email = "jgomez@martechmedical.com";
    $today = date("Y-m-d");


    $query = "SELECT * FROM actions
    LEFT JOIN meetings ON meetings.meeting_id = actions.action_meeting_id  
    WHERE actions.action_promise_date <= '$today' AND actions.action_complete = 0
    ";

    $result = mysqli_query($connection, $query);
    if(!$result) die("1st Query Error:".$query);
    

    while($row = mysqli_fetch_array($result))
    {

        $title = "Late Action:".$row['action_name']." ".$row['meeting_name'];
        $msg = "The Following action is past due: <b>".$row['action_name']."</b><br>This action comes from the following meeting: <b>".$row['meeting_name']."</b><br>Please update these actions.";


        echo $responsible = "SELECT * FROM action_responsible 
        LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id 
        WHERE a_action_id = {$row['action_id']}";

        $result_responsible = mysqli_query($connection, $responsible);
        if(!$result_responsible) die("2nd Query Error:".$responsible);

        while($row_responsible = mysqli_fetch_array($result_responsible))
        {
            $CC[] = $row_responsible['user_email'];
            echo $row_responsible['user_email'];

        }


        sendEmail($email, $title, $msg, [], $CC);
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
        $mail->Username   = 'ailsender@martechsender.com';                      // SMTP username
        $mail->Password   = 'martechmedical';                                 // SMTP password
        $mail->SMTPSecure = 'tls';                                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                              

        //Recipients
        $mail->setFrom('ailsender@martechsender.com', 'AIL');
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