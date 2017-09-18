<?php
include_once("header.php");

$optSelect = "la_agencia";
///Get the post variable
if (!empty($_GET["opt"])) {
  $optSelect = $_GET["opt"];
}

?>

    <div id="mainAboutContainer" class="col-xs-12">
      <div class="jumbotron">
        <h1 id="mainAboutTitle" >About</h1>
        <p id="aboutContent">......</p>
      </div>
    </div>

<?php
include_once("footer.php");
echo "<script type='text/javascript' > 
  var option='{$optSelect}'; setOptionsContent(option);
</script>";