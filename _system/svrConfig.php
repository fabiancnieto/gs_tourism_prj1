<?php
ini_set("error_reporting",(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR | E_RECOVERABLE_ERROR ));
ini_set('display_errors','1');
session_start();
///Nombre de la Aplicacion
$_SESSION['idApp'] = "gs_tourism_prj1";
////Directorios de la Aplicacion
$prefijoPublico = "http://{$_SERVER['SERVER_NAME']}/{$_SESSION['idApp']}/";
$prefijoPrivado = "{$_SERVER['DOCUMENT_ROOT']}/{$_SESSION['idApp']}/";
///Asigna las variables de SESSION de la configuracion
$_SESSION['prefijoPublico'] = $prefijoPublico;
$_SESSION['prefijoPrivado'] = $prefijoPrivado;

///Set del Timezone de la APP
date_default_timezone_set('America/Bogota');
///Datos de envio de correo
$_SESSION['hostMail']="http://{$_SERVER['SERVER_NAME']}";
$_SESSION['fromMail']="noresponder@turismauro.com";
$_SESSION['fromName']="No responder";

include_once ("_lib/class/libInclude.php");
include_once ("_iGUI/guiInclude.php");
