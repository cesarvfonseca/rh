<nav class="navbar navbar-light bg-dark justify-content-between">
  <a class="navbar-brand text-white">RH | TXT Y VACACIONES</a>
  <!--  <form class="form-inline"> -->

    <?php if (!isset($_SESSION['userActive']) || empty($_SESSION['userActive'])){ ?>
      <label class="text-white mr-sm-2">Bienvenido</label>
    <?php }else{ ?>
      <label class="text-white mr-sm-2">
        Bienvenido <?php echo $_SESSION["userName"] ?>
      </label>
      <!-- <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Cerrar Sesión</button> -->
      <div class="pull-right"><a href="inc/model/logout.php"><button type="submit" class="btn navbar-btn btn-danger my-sm-0">Salir <i class="fas fa-sign-out-alt"></i></button></a></div>
    <?php } ?>

  <!-- </form> -->
</nav>