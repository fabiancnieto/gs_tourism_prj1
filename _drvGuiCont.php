<?php

//ini_set("error_reporting",(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR | E_RECOVERABLE_ERROR ));
ini_set("error_reporting", (E_ALL));
ini_set('display_errors', '1');

include("_system/svrConfig.php");

if (!empty($_POST)) {
    $objFacade = new GuiFactory ();
    $objFacade = $objFacade->getGui($_POST);
    echo json_encode((object)$objFacade->getData($_POST), JSON_FORCE_OBJECT);
} elseif (!empty($_GET)) {
    $objFacade = new GuiFactory ();
    $objFacade = $objFacade->getGui($_GET);
    echo json_encode($objFacade->getData($_GET), JSON_FORCE_OBJECT);
} else {
    echo json_encode("{objReturn:Error Return}");
}
?>
