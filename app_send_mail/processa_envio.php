<?php

require "Mensagem.php";
require "./library/PhpMailer/Exception.php";
require "./library/PhpMailer/OAuth.php";
require "./library/PhpMailer/PHPMailer.php";
require "./library/PhpMailer/POP3.php";
require "./library/PhpMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(count($_POST)){

    $objMsg = new Mensagem();

    $objMsg->__set('para', $_POST['para']);
    $objMsg->__set('assunto', $_POST['assunto']);
    $objMsg->__set('mensagem', $_POST['mensagem']);

    if(!$objMsg->isValid()){
        echo 'Preencha todos os campos!';
        header("Location: index.php?erro=1");
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mateus.calina07@gmail.com';                     //SMTP username
        $mail->Password   = 'zkzphzeuvpchyytw';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('mateus.calina07@gmail.com', 'Petit');
        $mail->addAddress($objMsg->__get('para'));     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $objMsg->__get('assunto');
        $mail->Body    = $objMsg->__get('mensagem');
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        $objMsg->status['codigo']   = Mensagem::STATUS_CODE_SUCCESS;
        $objMsg->status['mensagem'] = 'Email enviado com sucesso!';
        
    } catch (Exception $e) {
        $objMsg->status['codigo']   = Mensagem::STATUS_CODE_ERROR;
        $objMsg->status['mensagem'] = $mail->ErrorInfo;
    }

}
?>

<html>
    <head>
        <meta charset="utf-8" />
    	<title>App Mail Send</title>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>

        <div class="container">

            <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <? if(isset($objMsg->status['codigo']) && $objMsg->status['codigo'] == Mensagem::STATUS_CODE_SUCCESS){ ?>

                        <div class="container">
                            <h1 class="display-4 text-success">Sucesso!</h1>
                            <p><?= $objMsg->status['mensagem'] ?></p>
                        </div>

                    <? } ?>
                    
                    <? if(isset($objMsg->status['codigo']) && $objMsg->status['codigo'] == Mensagem::STATUS_CODE_ERROR){ ?>

                        <div class="container">
                            <h1 class="display-4 text-danger">Erro!</h1>
                            <p><?= $objMsg->status['mensagem']?></p>
                        </div>

                    <? } ?>
                    <a href="index.php" class="btn btn-success btn-lg text-white">Voltar</a>

                </div>

            </div>

        </div>
        
    </body>
</html>