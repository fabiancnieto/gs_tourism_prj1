<?php
include_once("header.php");
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    <li data-target="#myCarousel" data-slide-to="3" class=""></li>
    <li data-target="#myCarousel" data-slide-to="4" class=""></li>
    <li data-target="#myCarousel" data-slide-to="5" class=""></li>
    <li data-target="#myCarousel" data-slide-to="6" class=""></li>
    <li data-target="#myCarousel" data-slide-to="7" class=""></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img id="costa_atlantica" src="pictures/main-img-1.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Costa Atlantica</h1>
          <p>Contenido Costa Atalntica</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="guajira" src="pictures/main-img-2.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Guajira</h1>
          <p>Contenido Guajira</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="paraiso_caribeno" src="pictures/main-img-3.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Paraiso Caribeño</h1>
          <p>Contenido Paraiso</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="medellin_caribe" src="pictures/main-img-4.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Medellin - Caribe</h1>
          <p>Contenido Medellin</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="ecuador" src="pictures/main-img-5.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Ecuador</h1>
          <p>Contenido Medellin</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="eje_cafetero" src="pictures/main-img-6.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Eje Cafetero</h1>
          <p>Contenido Medellin</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="san_gil" src="pictures/main-img-7.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>San Gil</h1>
          <p>Contenido San Gil</p>
        </div>
      </div>
    </div>
    <div class="item">
      <img id="hacienda_napoles" src="pictures/main-img-8.jpg" class="mainImg">
      <div class="container">
        <div class="carousel-caption">
          <h1>Hacienda Napoles</h1>
          <p>Contenido Hacienda Napoles</p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>
<?php
include_once("footer.php");