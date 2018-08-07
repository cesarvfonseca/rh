<h1>Panel del personal</h1>
<?php 
	if ($stmnt2):
 ?>
<div class="row">	
	<div class="col-md-12 table-responsive-sm">	
		<table id="infoTable" class="table table-striped table-bordered table-hover table-sm text-left table-sm">
			<thead class="bg-primary text-white text-center">
				<!-- <th>id</th> -->
				<th>Nomina</th>
				<th>Empleado</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Horas</th>
				<th>Dias totales</th>
				<th>Estado RH</th>
				<th>Autorización</th>
			</thead>
			<?php 
				while ($row = $stmnt2 -> fetch(PDO::FETCH_ASSOC)):
					$jefe_autorizacion = $row ["jefe_autorizacion"];
					$rh_autorizacion = $row ["rh_vobo"];
					if ($jefe_autorizacion==1) {
						$btnaClass = 'btn-success';
						$btnbClass = 'btn-outline-danger';
					} else if ($jefe_autorizacion==2){
						$btnaClass = 'btn-outline-success';
						$btnbClass = 'btn-danger';
					} else{
						$btnaClass = 'btn-outline-success';
						$btnbClass = 'btn-outline-danger';
					}

			?>
			<tr>
				<!-- <td class="idm"><?php echo $row ["id"]; ?></td> -->
				<td><?php echo $row ["employee"]; ?></td>
				<td><?php echo $row ["emp_name"]; ?></td>
				<td>
					<a tabindex="0" class="btn btn-sm btn-outline-dark" role="button" data-toggle="popover" data-trigger="focus" title="Razón de la incidencia" data-content="<?php echo $row ["emp_observaciones"]; ?>">
						<i class="fas fa-info"></i>
					</a>
					<?php echo $row ["tipo_incidencia"]; ?>
				</td>
				<td><?php echo $row ["fecha"]; ?></td>
				<td><?php echo number_format($row ["horas"],1); ?></td>
				<td><?php echo $row ["dias"]; ?></td>
				<td id="vobo">
					<a tabindex="0" class="btn btn-sm btn-outline-dark" role="button" data-toggle="popover" data-trigger="focus" title="Comentarios RH" data-content="<?php echo $row ["rh_observaciones"]; ?>">
						<i class="fas fa-info"></i>
					</a>
					<?php echo $row ["voboRH"]; ?>
				</td>
				<td class="autorizado">
					<div class="btn-group btn-group-justified" role="group" data-toggle="buttons">
					      <div class="btn-group" role="group">
				      		<button tabindex="0" type="button" class="btn btn-sm <?php echo	$btnaClass ?> btnAutorizar" value="<?php echo $row ['id']; ?>" data-idemp="<?php echo $_SESSION["userActive"];?>">
					        	<input class="custom-control-input" type="radio">Autorizado
					    	</button>
					        <button tabindex="1" type="button" class="btn btn-sm <?php echo	$btnbClass ?> btnNA" value="<?php echo $row ['id']; ?>" data-idemp="<?php echo $_SESSION["userActive"];?>">
					        	<input class="custom-control-input" type="radio">No Autorizado
					    	</button>
					      </div>
					</div>
				</td>
			</tr>
			<?php 	
				endwhile; 
			?>
		</table>
	</div>
</div>
<?php 	
	else:
 ?>
 		<div class="row">	
			<div class="col-md-12">	
				<p class="alert alert-warning">No hay datos disponibles</p>
			</div>
 		</div>
 <?php 	
 	endif; 
 ?>