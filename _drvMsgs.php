<?php
//ini_set("error_reporting",(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR | E_RECOVERABLE_ERROR ));
ini_set("error_reporting", (E_ALL));
ini_set('display_errors', '1');

include("_system/svrConfig.php");
require_once('_system/_lib/PHPMailer/class.phpmailer.php');

if (!empty($_POST)) {
    date_default_timezone_set('America/Toronto');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

    $objMail = new PHPMailer();
    $objMailComp = new PHPMailer();

    $name = ucfirst(strtolower($_POST['name']));
    $email = strtolower($_POST['email']);
    $city = ucfirst(strtolower($_POST['city']));
    $phone = strtolower($_POST['phone']);
    $message = ucfirst(strtolower($_POST['message']));
    $aSearch = array("[", "]");
    $aReplace = array("(", ")");

    $bodyClient = "<h1>Mensaje de Contacto Turismauro</h1><br /> Estimado(a): {$name}<br />";
    $bodyClient .= "<h3>Gracias por contactarnos estaremos atendiendo tu solicitud y contactandote en el menor tiempo posible.</h3><br />";
    $bodyClient .= "<p>Correo registrado: {$email}</p><br /><p>Telefono: {$phone}</p><br /><br /><p>Mensaje: {$message}</p><br />";
    $bodyClient .= "<p>Recuerda nuestros Canales de Contacto:<br /><a href='http://www.turismauro.com'>http://www.turismauro.com</a></p><p>PBX: (+571) 494 01 01 -  (+57) 315 204 92 23</p><p>Bogot&aacute; - Colombia</p><p>&nbsp;</p><p>&nbsp;</p>";
    $bodyClient = str_replace($aSearch, $aReplace, $bodyClient);

    $bodyCompany = "<h1>Mensaje de Contacto Turismauro</h1><br />";
    $bodyCompany .= "<p>Mensaje enviado desde la pagina Web. Datos enviados:</p><p>Nombre: {$name}</p><br />Correo: {$email}</p><br />";
    $bodyCompany .= "<p>Telefono: {$phone}</p><br /><br /><p>Mensaje: {$message}</p><br />";
    $bodyCompany = str_replace($aSearch, $aReplace, $bodyCompany);


    $objMail->IsSMTP(); // telling the class to use SMTP
    $objMailComp->IsSMTP(); // telling the class to use SMTP
    $objMail->Host = "ssl://smtp.renovarcuero.com"; // SMTP server
    $objMailComp->Host = "ssl://smtp.renovarcuero.com"; // SMTP server
//    $objMail->SMTPDebug = 1;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $objMail->SMTPAuth = true;                  // enable SMTP authentication
    $objMailComp->SMTPAuth = true;                  // enable SMTP authentication
    $objMail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $objMailComp->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $objMail->Host = "smtp.renovarcuero.com";      // sets GMAIL as the SMTP server
    $objMailComp->Host = "smtp.renovarcuero.com";      // sets GMAIL as the SMTP server
    $objMail->Port = 465;                   // set the SMTP port for the GMAIL server
    $objMailComp->Port = 465;                   // set the SMTP port for the GMAIL server
    $objMail->Username = "SERVICIOALCLIENTE@TURISMAURO.COM";  // GMAIL username
    $objMailComp->Username = "SERVICIOALCLIENTE@TURISMAURO.COM";  // GMAIL username
    $objMail->Password = "";            // GMAIL password
    $objMailComp->Password = "";            // GMAIL password

    $objMail->SetFrom('SERVICIOALCLIENTE@TURISMAURO.COM', 'Turismauro');
    $objMailComp->SetFrom('SERVICIOALCLIENTE@TURISMAURO.COM', 'Turismauro');
//$objMail->AddReplyTo("user2@gmail.com', 'First Last");

    $objMail->Subject = "Mensaje de Contacto en Turismauro - No responder";
    $objMailComp->Subject = "Mensaje de Contacto en Turismauro - No responder";
    $objMail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $objMailComp->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $objMail->MsgHTML($bodyClient);

    $address = "{$email}";
    $objMail->AddAddress($address, "{$name}");
    $address = "SERVICIOALCLIENTE@TURISMAURO.COM";
    $objMail->AddAddress($address, "Copia de Correo");
    $address = "diseno@grafipardltda.com";
    $objMail->AddAddress($address, "Copia de Correo");
	
//$objMail->AddAttachment("images/phpmailer.gif");      // attachment
//$objMail->AddAttachment("images/phpmailer_mini.gif"); // attachment

    if (!$objMail->Send()) {
        $aError["objReturn"] = "Client:{$objMail->ErrorInfo}";
        echo json_encode($aError);
    } else {
        $aComplete["objReturn"] = "Mensaje de Contacto enviado, te responderemos lo mas pronto posible!!";
        $address = "SERVICIOALCLIENTE@TURISMAURO.COM";
        $objMailComp->AddAddress($address, "Contactenos Turismauro");
        $objMailComp->MsgHTML($bodyCompany);
        if (!$objMailComp->Send()) {
            $aError["objReturn"] = "Client:{$objMail->ErrorInfo}";
            echo json_encode($aError);
        } else {
            $aObjReturn[0]["state"] = "ok";
            $aObjReturn[0]["return"] = "Mensaje de Contacto enviado, te responderemos lo mas pronto posible!!";
            echo json_encode($aObjReturn, JSON_FORCE_OBJECT);
        }
    }
} elseif (!empty($_GET)) {
    
} else {
    echo json_encode("{objReturn:Error Return}");
}
