<?php
  $publicName = $_SERVER["SERVER_NAME"];
  $siteName = "/gs_tourism_prj1/";
echo "<script type='text/javascript' > 
publicName ='{$publicName}', publicPath = '{$siteName}';
</script>";
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
              <img class="img-responsive" src="img/headLeftImage.png" alt="Left Main logo">
            </div>
            <div id="middleHeadCont" class="col-sm-7 col-md-7 logoFont">
              <img class="img-responsive" src="img/headMiddleImage.png" alt="Main logo">
              <h1 class="logo"><a href="index.php"><span>T</span><span>uris</span>mauro</a></h1>
              <h2 class="tagline hidden-xs"><span>Vacaciones sin Limites</span></h2>
            </div>
            <div id="rightHeadCont" class="col-sm-3 col-md-3 hidden-xs">
              <img class="img-responsive" src="img/headRightImage.png" alt="Right Main logo">
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
                      <a href="about.php?opt=d7b3a7d1a20e">La Agencia</a>
                    </li>
                    <li class="">
                      <a href="about.php?opt=cc9f7f5e5c0a">Parque Automotor</a>
                    </li>
                    <li class="">
                      <a href="9a2438897ccb">Corporativos</a>
                    </li>
                    <li class="">
                      <a href="about.php?974d8918d9f3">Facilidades de Pago</a>
                    </li>
                    <li class="">
                      <a href="about.php?af541614a733">Politica de Sostenibilidad</a>
                    </li>
                    <li class="">
                      <a href="contact.php?6fb53cb17c12">Contactenos</a>
                    </li>
                    <li class="">
                      <a href="f0b781307af1">Planes Turisticos</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
          <div id="rightCont" class="col-xs-12 col-sm-12 col-md-10 col-lg-9">