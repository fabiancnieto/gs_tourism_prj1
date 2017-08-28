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
              <h1>Home Tab</h1>
              <p>These lists are meant to identify articles which deserve editor attention because they are the most important for s.</p>                 
            </div>
          </div> 
          <div class="tab-pane" id="route"> 
            <div class="jumbotron">
              <h1>About Tab</h1>
              <p>because they are the most important for an encyclopedia to have, as determined by the community of participating editors..</p>                 
            </div>
          </div>
          <div class="tab-pane" id="included"> 
            <div class="jumbotron">
              <h1>Services Tab</h1>
              <p>meant to identify articles which deserve editor attention because they are the most important for an encyclopedia to have.</p>                 
            </div>
          </div>
          <div class="tab-pane" id="no_included"> 
             <div class="jumbotron">
              <h1>Contact Tab</h1>
              <p>deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors..</p>                 
             </div>
          </div>
          <div class="tab-pane" id="date_price"> 
             <div class="jumbotron">
              <h1>Contact Tab</h1>
              <p>deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors..</p>                 
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
$( document ).ready(function() {
  var plan='{$planSelect}'; 
  setPlansContent(plan);
});
</script>";