<?php 
	include	'inc/model/service_1.php';
 ?>
<div class="row">
	<div class="col-md-3">
		<h4 class="display-5">
			<p>Nomina: <?php echo ($_SESSION['userActive']); ?></p>
		</h4>	
	</div>
	<div class="col-md-9">
		<h4 class="display-5">
			<p>Nombre: <?php echo ($_SESSION['userName']); ?></p>
		</h4>	
	</div>
</div>
<div class="row">
	<div class="col-md-4">
	  <div class="form-group">
	    <label>Selecciona el tipo de transacción</label>
	    <select class="form-control custom-select" id="opcionCombo" onchange="getComboA(this)">
	      <option value="non" selected>Seleccionar una opcion</option>
	      <option value="txt">Tiempo por tiempo a favor</option>
	      <option value="txtc">Tiempo por tiempo en contra</option>
	      <option value="vacaciones">Vacaciones</option>
	      <option value="panel-usuario">Panel de incidencias</option>
	      <?php if ($_SESSION["godLevel"]==1): ?>
	      	<option value="panel-personal">Incidencias personal</option>
	      <?php endif ?>
	    </select>
	  </div>
	</div>
</div>

<div class="row" id="defaultDIV">
	<div class="col-md-12">
		<h1>Seleccionar una opcion</h1>
	</div>
</div>

<div class="row" id="txtDIV">
	<div class="col-md-12">
		<?php include('inc/templates/txt.php');  ?>
	</div>
</div>
<div class="row" id="txtcDIV">
	<div class="col-md-12">
		<?php include('inc/templates/txtc.php');  ?>
	</div>
</div>
<div class="row" id="vacacionesDIV">
	<div class="col-md-12">
		<?php include('inc/templates/vacaciones.php');  ?>
	</div>
</div>
<div class="row" id="panel-usuarioDIV">
	<div class="col-md-12">
		<?php include('inc/templates/panel-usuario.php');  ?>
	</div>
</div>

<div class="row" id="panel-personalDIV">
	<div class="col-md-12">
		<?php include('inc/templates/panel-personal.php');  ?>
	</div>
</div>

<script src="js/control.js"></script>
