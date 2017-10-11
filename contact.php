<?php
include_once("header.php");

$optSelect = "la_agencia";
///Get the post variable
if (!empty($_GET["opt"])) {
  $optSelect = $_GET["opt"];
}

?>
<div id="contactDivCont" class="col-md-10">
  <div class="well well-sm">
    <form class="form-horizontal" action="" method="post">
    <fieldset>
      <legend id="legendContact" class="text-center">Dejanos tu Mensaje</legend>

      <!-- Name input-->
      <div class="form-group">
        <label class="col-md-3 control-label" for="name">T&uacute; Nombre</label>
        <div class="col-md-9">
          <input id="name" name="name" type="text" placeholder="T&uacute; Nombre" class="form-control">
        </div>
      </div>

      <!-- Email input-->
      <div class="form-group">
        <label class="col-md-3 control-label" for="email">T&uacute; Email</label>
        <div class="col-md-9">
          <input id="email" name="email" type="text" placeholder="T&uacute; Email" class="form-control">
        </div>
      </div>

      <!-- Message body -->
      <div class="form-group">
        <label class="col-md-3 control-label" for="message">T&uacute; Mensaje</label>
        <div class="col-md-9">
          <textarea class="form-control" id="message" name="message" placeholder="Por favor deja t&uacute; mensaje aqui ...." rows="5"></textarea>
        </div>
      </div>

      <!-- Form actions -->
      <div class="form-group">
        <div class="col-md-12 text-right">
          <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
        </div>
      </div>
    </fieldset>
    </form>
  </div>
</div>

<?php
include_once("footer.php");