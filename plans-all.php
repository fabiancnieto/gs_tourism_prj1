<?php
include_once("header.php");

$optSelect = "la_agencia";
///Get the post variable
if (!empty($_GET["opt"])) {
  $optSelect = $_GET["opt"];
}

?>
    <div id="mainPlansContainer" class="col-xs-12">
      <div class="well well-lg">
        <h1 id="mainPlansTitle" >Planes Turisticos</h1>
        <div id="mainPlansLeft" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=costa_atlantica" ><img class="img-responsive" src="img/opt-img1.png" alt="Costa Atlantica"></a>
            <div class="caption">
              <h3>Costa Atalantica 7 D&iacute;as</h3>
              <p>Cartagena, Santa Marta y la Guajira todo Incluido</p>
              <p><a href="plans.php?plan=costa_atlantica" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansMiddle" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=guajira" ><img class="img-responsive" src="img/opt-img2.png" alt="La Guajira"></a>
            <div class="caption">
              <h3>La Guajira</h3>
              <p>Guajira / Cabo de la Vela 8 D&iacute;as</p>
              <p><a href="plans.php?plan=guajira" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansRight" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=paraiso_caribeno" ><img class="img-responsive" src="img/opt-img3.png" alt="Paraiso Caribeno"></a>
            <div class="caption">
              <h3>Paraiso Caribe&ntilde;o</h3>
              <p>Paraiso Caribe&ntilde;o - Medell&iacute;n - Tol&uacute; Cove&ntilde;as - Bucaramanga Total de 8 D&iacute;as</p>
              <p><a href="plans.php?plan=paraiso_caribeno" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansLeft" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=medellin_caribe" ><img class="img-responsive" src="img/opt-img4.png" alt="Medellin Caribe"></a>
            <div class="caption">
              <h3>Medell&iacute;n Caribe</h3>
              <p>Medell&iacute;n - Caribe Vacacional 10 D&iacute;as</p>
              <p><a href="plans.php?plan=medellin_caribe" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansMiddle" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=ecuador" ><img class="img-responsive" src="img/opt-img5.png" alt="Ecuador"></a>
            <div class="caption">
              <h3>Ecuador</h3>
              <p>Ecuador Encanto Cultura y Playa</p>
              <p><a href="plans.php?plan=ecuador" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansRight" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=eje_cafetero" ><img class="img-responsive" src="img/opt-img6.png" alt="Eje Cafetero"></a>
            <div class="caption">
              <h3>Eje Cafetero</h3>
              <p>Plan vacacional 5 D&iacute;as 4 Noches</p>
              <p><a href="plans.php?plan=eje_cafetero" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansLeft" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=san_gil" ><img class="img-responsive" src="img/opt-img7.png" alt="San Gil"></a>
            <div class="caption">
              <h3>San Gil</h3>
              <p>San Gil y Puentes 5 D&iacute;as 4 Noches</p>
              <p><a href="plans.php?plan=san_gil" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
        <div id="mainPlansMiddle" class="col-xs-4">
          <div class="thumbnail">
            <a href="plans.php?plan=hacienda_napoles" ><img class="img-responsive" src="img/opt-img8.png" alt="Hacienda Napoles"></a>
            <div class="caption">
              <h3>Hacienda Napoles</h3>
              <p>Hacienda Napoles y R&iacute;o Claro 3 D&iacute;as 2 Noches</p>
              <p><a href="plans.php?plan=hacienda_napoles" class="btn btn-primary" role="button">Ver mas...</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
include_once("footer.php");