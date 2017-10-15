<?php
  $publicName = $_SERVER["SERVER_NAME"];
  $siteName = "/gs_tourism_prj1/";
  ///$siteName = "/proyectos/Turismauro/v1.33/";
  echo "<script type='text/javascript' > publicName ='{$publicName}', publicPath = '{$siteName}'; </script>";
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turismauro - Vacaciones sin limites</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
    <link href="css/ambixo.css" rel="stylesheet">
    <link href="css/bottom_tabs.css" rel="stylesheet">
    <link href="css/car_fleet.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Script -->
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- Favicons -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- SEO Meta Tags -->
    <!-- <meta name="description" content="" /> -->
    <!-- <meta name="keywords" content="" /> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body data-spy="scroll" data-target=".header">
     <header>
      <div id="header" class="header">
        <div class="container">
           <div class="row">
            <div id="leftHeadCont" class="col-sm-2 col-md-2 hidden-xs">
              <a href="index.php" ><img class="img-responsive" src="img/headLeftImage.png" alt="Left Main logo"></a>
            </div>
            <div id="middleHeadCont" class="col-sm-7 col-md-7 logoFont">
              <a href="index.php" ><img class="img-responsive" src="img/mainHeadLogo.png" alt="Main logo"></a>
            </div>
            <div id="rightHeadCont" class="col-sm-3 col-md-3 hidden-xs">
              <div>
                <h3>Contactanos</h3>
                <p id="headPbx">PBX +57(1) 494 01 01</p>
                <p id="headPhone"><i class="fa fa-whatsapp" style="font-size:19px"></i> (+57) 315 204 92 23</p>
              </div>
              <a href="index.php" ><img class="img-responsive" src="img/headRightImage.png" alt="Right Main logo"></a>
            </div>
            <svg id="centerSvg" class="decor fill" height="15" preserveaspectratio="none" version="1.1" viewbox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 100 L100 0 L0 0" stroke-width="0" fill="white"></path>
              <path d="M0 100 L60 35 L100 0" stroke-width="5ex" stroke="#ee8024" fill="#ee8024"></path>
            </svg>
          </div>
        </div>
      </div>
      <svg id="smSvg" class="decor fill" height="15" preserveaspectratio="none" version="1.1" viewbox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 100 L100 0 L0 0" stroke-width="0" fill="white"></path>
        <path d="M0 100 L60 35 L100 0" stroke-width="5ex" stroke="#ee8024" fill="#ee8024"></path>
      </svg>
    </header>

    <section id="main-img">
      <div class="container">
        <div class="row">
          <div id="leftCont" class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
            <nav class="navbar navbar-default navbar-fixed-side">
              <div class="container">
                <div class="navbar-header">
                  <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                  <ul class="nav navbar-nav">
                    <li >
                      <a href="index.php">Home</a>
                    </li>
                    <li >
                      <a href="about.php?opt=la_agencia">La Agencia</a>
                    </li>
                    <li class="">
                      <a href="car_fleet-slider.php">Parque Automotor</a>
                    </li>
                    <li class="">
                      <a href="about.php?opt=corporativo">Corporativos</a>
                    </li>
                    <li class="">
                      <a href="about.php?opt=facilidades_pago">Facilidades de Pago</a>
                    </li>
                    <li class="">
                      <a href="about.php?opt=politica_sostenibilidad">Politica de Sostenibilidad</a>
                    </li>
                    <li class="">
                      <a href="contact.php">Contactenos</a>
                    </li>
                    <li class="">
                      <a href="plans-all.php">Planes Turisticos</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
          <div id="rightCont" class="col-xs-12 col-sm-12 col-md-10 col-lg-9">