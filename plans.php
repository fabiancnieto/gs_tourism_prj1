<?php
include_once("header.php");

$planSelect = "costa_atlantica";
///Get the post variable
if (!empty($_GET["plan"])) {
  $planSelect = $_GET["plan"];
}

?>

    <div id="mainTabsContainer" class="col-xs-12">
      <!-- tabs -->
      <div class="tabbable tabs-bottom">
          <div class="tab-content">
            <div class="tab-pane active" id="photos">
            <div class="jumbotron">
              <h2 id="planMainTitle" >Plan turistico</h2>
              <p id="planDescription" ></p>
              <img id="planMainImage" class="img-responsive" src="pictures/demo.jpg" alt="Main Image">
            </div>
          </div> 
          <div class="tab-pane" id="route"> 
            <div class="jumbotron">
              <h2>Recorrido</h2>
              <ul id="routeDescription" ></ul>
            </div>
          </div>
          <div class="tab-pane" id="included"> 
            <div class="jumbotron">
              <h2>Incluido</h2>
              <ul id="includeDescription" ></ul>
            </div>
          </div>
          <div class="tab-pane" id="no_included">
             <div class="jumbotron">
              <h2>No incluido</h2>
              <ul id="notIncludeDescription" ></ul>
              <h2>Opcional</h2>
              <ul id="optionalDescription" ></ul>
             </div>
          </div>
          <div class="tab-pane" id="date_price"> 
             <div class="jumbotron">
              <h2>Fechas y Valor</h2>
              <ul id="dateDescription" ></ul>
              <div id="pricesContainer" class="table-responsive" >
                <table id="priceDescriptionTable" class="table table-hover" >
                  <thead>
                    <tr>
                      <th>Temporada</th>
                      <th>Hoteles</th>
                      <th>Multiple</th>
                      <th>Doble</th>
                      <th>Sencilla</th>
                      <th>Niños 4-10 Años</th>
                    </tr>
                  </thead>
                  <tbody id="priceDescription"></tbody>
                </table>
              </div>
             </div>
          </div>
        </div>
                <!-- tab content -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#photos" data-toggle="tab">Fotos</a></li>
          <li><a href="#route" data-toggle="tab">Recorrido</a></li>
          <li><a href="#included" data-toggle="tab">Incluido</a></li>
          <li><a href="#no_included" data-toggle="tab">No Incluido</a></li>
          <li><a href="#date_price" data-toggle="tab">Fechas y Valor</a></li>
        </ul>
        
      </div>
      <!-- /tabs -->
    </div>

<?php
include_once("footer.php");
echo "<script type='text/javascript' > 
  var plan='{$planSelect}'; setPlansContent(plan);
</script>";