<?php

$path = dirname(__FILE__).'/inc';

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "{$path}/vendor/autoload.php";

class MailHandler{

    // single instance of self shared among all instances
    private static $instance = null;

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function sendEmail($invited_people, $subject, $message){

        $invited_person_name = $invited_people[0];
        $invited_person_mail = $invited_people[1];

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'ps.testing18777@gmail.com';   //username
        $mail->Password = 'nf4GHix2MVhw3HD';   //password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;                    //SMTP port
        $mail->setFrom('ps.testing18777@gmail.com', 'Admin');
        $mail->addAddress("$invited_person_mail", "$invited_person_name");
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();

    }

}
?>
