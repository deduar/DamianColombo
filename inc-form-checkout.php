  <div class="account-form form-style">
    <h5>Purchase Information </h5>
    <hr>


  <?php if(isset($_SESSION['idUsuario'])){ ?>


    <form action="checkout-temporal.php" method="post" name="calform" id="calform">
      <input type="hidden" name="tipo" value="0">

      <div class="row">
        <div class="col-sm-6 col-12">

          <strong><?php echo $_SESSION["nombre"];?></strong>
        </div>
        <div class="col-sm-6 col-12">

          <strong><?php echo $_SESSION["email"];?></strong>

        </div>
        <div class="col-12">
          <hr>
        </div>


        <div class="col-sm-4 col-12">
          <p>Phone *</p>
          <?php campoEdit(40, 1, "text", "telefono", trim($_SESSION["telefono"]), "", "")?>
        </div>
        <div class="col-sm-8 col-12">
          <p>Address *</p>
          <?php campoEdit(60, 1, "text", "direccion", trim($_SESSION["direccion"]), "", "")?>
        </div>

        <div class="col-sm-10 col-12">
          <p>City *</p>
          <?php campoEdit(50, 1, "text", "localidad", trim($_SESSION["localidad"]), "", "")?>
        </div>
        <div class="col-sm-2 col-12">
          <p>Code Zip *</p>
          <?php campoEdit(15, 1, "text", "cp", trim($_SESSION["cp"]), "", "")?>
        </div>
        <div class="col-12">
          <p>Observations of the Purchase </p>
          <textarea name="observaciones" maxlength="450"></textarea>
        </div>
        <div class="col-sm-4 col-12">
          <button type="submit">CONTINUE</button>
        </div>
      </div>
    </form>

  <?php }else{ ?>

    
    <form action="checkout-temporal.php" method="post" name="calform" id="calform">
      <input type="hidden" name="tipo" value="1">

      <div class="row">
        <div class="col-sm-6 col-12">
          <p>Name *</p>
          <?php campo(40, 1, "text", "nombre", "", "")?>
        </div>
        <div class="col-sm-6 col-12">
          <p>Last Name *</p>
          <?php campo(40, 1, "text", "apellido", "", "")?>
        </div>
        <div class="col-sm-6 col-12">
          <p>Email *</p>
          <?php campo(40, 1, "email", "email", "", "")?>

        </div>
        <div class="col-sm-6 col-12">
          <p>Phone *</p>
          <?php campo(40, 1, "text", "telefono", "", "")?>
        </div>
        <div class="col-12">
          <p>Address *</p>
          <?php campo(60, 1, "text", "direccion", "", "")?>
        </div>

        <div class="col-sm-10 col-12">
          <p>City *</p>
          <?php campo(50, 1, "text", "localidad", "", "")?>
        </div>
        <div class="col-sm-2 col-12">
          <p>Code Zip *</p>
          <?php campo(15, 1, "text", "cp", "", "")?>
        </div>
        <div class="col-12">
          <p>Observations of the Purchase </p>
          <textarea name="observaciones" maxlength="450"></textarea>
        </div>
        <div class="col-sm-4 col-12">
          <button type="submit">CONTINUE</button>
        </div>
      </div>
    </form>

  <?php } ?>
  </div>
