<h1>Panel Incidencias</h1>
<hr>
<?php
	$conn = Connect_DB();
	$employee_id = $_SESSION["userActive"];
	$selectQuery = "SELECT
					employee,
					fecha,
					CASE
					 WHEN tipo = 1
						THEN 'TXT A FAVOR'
					 WHEN tipo = 2
						THEN 'TXT EN CONTRA'
					 WHEN tipo = 3
						THEN 'VACACIONES'
					 END AS tipo_incidencia,
					CASE
						WHEN jefe_autorizacion=0
							THEN 'Pendiente'
						WHEN jefe_autorizacion=1
							THEN 'Autorizado'
						ELSE 'No Autorizado'
					END as voboJefe,
					CASE
						WHEN rh_vobo=0
							THEN 'Pendiente'
						WHEN rh_vobo=1
							THEN 'Autorizado'
						ELSE 'No Autorizado'
					END as voboRH,
					 id,
					 tipo,
					 horas,
					 dias,
					 emp_observaciones,
					 jefe_observaciones,
					 rh_observaciones
					FROM P1TXTVAC WHERE employee=:empID ORDER BY fecha";
	$stmnt = $conn ->prepare($selectQuery);
	$stmnt -> bindParam(':empID', $employee_id, PDO::PARAM_STR);
    $stmnt -> execute();

    if ($stmnt):
 ?>
<div class="row">
	<div class="col-md-12 table-responsive-sm">
		<table id="example" class="table table-striped table-bordered table-hover text-left table-sm">
			<thead>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Horas</th>
				<th>Dias totales</th>
				<th>Estado Jefe directo</th>
				<th>Estado RH</th>
				<th>Acción</th>
			</thead>
			<?php
				while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)):
			?>
			<tr>
				<td><?php echo $row ["tipo_incidencia"]; ?></td>
				<td><?php echo $row ["fecha"]; ?></td>
				<td class="row_hours">
					<a tabindex="0" class="btn btn-sm btn-outline-dark" role="button" data-toggle="popover" data-trigger="focus" title="Razón" data-content="<?php echo $row ["emp_observaciones"]; ?>">
						<i class="fas fa-info"></i>
					</a>
					<b>
						<?php echo number_format($row ["horas"],1); ?>
					</b>
				</td>
				<td><?php echo $row ["dias"]; ?></td>
				<td id="vobo">
					<a tabindex="0" class="btn btn-sm btn-outline-dark" role="button" data-toggle="popover" data-trigger="focus" title="Comentarios del jefe" data-content="<?php echo $row ["jefe_observaciones"]; ?>">
						<i class="fas fa-info"></i>
					</a>
					<?php echo $row ["voboJefe"];?>
				</td>
				<td id="vobo">
					<a tabindex="0" class="btn btn-sm btn-outline-dark" role="button" data-toggle="popover" data-trigger="focus" title="Comentarios RH" data-content="<?php echo $row ["rh_observaciones"]; ?>">
						<i class="fas fa-info"></i>
					</a>
					<?php echo $row ["voboRH"]; ?>
				</td>
				<td>
				<?php 
					$incidencia_tipo = $row ["tipo"];
					if ($incidencia_tipo < 3){ ?>
					<a tabindex="0"
						class="btn btn-sm btn-primary btnEditar"
						data-idemp="<?php echo $_SESSION["userActive"];?>"
						data-mov="<?php echo $row ["id"];?>"
						data-horas="<?php echo number_format($row ["horas"],1); ?>"
						role="button">
						<i class="fas fa-pen-square"></i> Editar
					</a>

				<?php } else { ?>

					<a tabindex="0"
						class="btn btn-sm btn-secondary disabled"
						role="button">
						<i class="fas fa-pen-square"></i> Editar
					</a>

				<?php } ?>

				<a tabindex="1"
					class="btn btn-sm btn-danger btnEliminar"
					data-idemp="<?php echo $_SESSION["userActive"];?>"
					data-mov="<?php echo $row ["id"];?>"
					role="button">
					<i class="fas fa-trash-alt"></i> Eliminar
				</a>
				
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
