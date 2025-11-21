<div class="container is-fluid mb-6">
	<h1 class="title">Factura Electr&oacute;nica - moneyBox</h1>
	<h2 class="subtitle"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Informaci&oacute;n de acceso moneyBox</h2>
</div>

<div class="container pb-6 pt-6">
	<?php

		$datos=$insLogin->seleccionarDatos("Normal","empresa LIMIT 1","*",0);

		if($datos->rowCount()==1){
			$datos=$datos->fetch();

		$txtAmbiente= ($datos['mbox_ambiente']==1 ? "Produccion":($datos['mbox_ambiente']==2 ? "Pruebas":($datos['mbox_ambiente']==3 ? "Desarrollo":"-- Seleccione ambiente")))
	?>
	<p class="has-text-centered">La configuraci&oacute;n indicada en este apartado le permitira generar sus documentos en el ambiente seleccionado.<br>Si aun no cuenta con sus accesos a moneyBox puede requerirlos en <a href="mailto:contacto@moneybox.business">contacto@moneybox.business</a></p><br>

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/facturaelectronicaAjax.php" method="POST" autocomplete="off" >

		<input type="hidden" name="modulo_facturaelectronica" value="actualizar">
		<input type="hidden" name="empresa_id" value="<?php echo $datos['empresa_id']; ?>">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="mbox_user" value="<?php echo $datos['mbox_user']; ?>" pattern="[0-9()+]{8,20}" maxlength="20" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" name="mbox_pass" value="<?php echo $datos['mbox_pass']; ?>" maxlength="50" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Ambiente</label>
				  	<select class="input" name="mbox_ambiente" value="<?php echo $datos['mbox_ambiente']; ?>">
				  		"<?php echo '<option value="'.($datos['mbox_ambiente'] ? $datos['mbox_ambiente']:0).'">'.$txtAmbiente.'</option>'; ?>"
				  		<option value="1">Produccion</option>
				  		<option value="2">Pruebas</option>
				  		<option value="3">Desarrollo</option>
				  	</select>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded"><i class="fas fa-sync-alt"></i> &nbsp; Actualizar</button>
		</p>
	</form>

	<?php }else{ ?>

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/facturaelectronicaAjax.php" method="POST" autocomplete="off" >

		<input type="hidden" name="modulo_facturaelectronica" value="registrar">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="mbox_user" pattern="[0-9()+]{8,20}" maxlength="20" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" name="mbox_pass" maxlength="50" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Ambiente</label>
				  	<select class="input" name="mbox_ambiente" value="<?php echo $datos['mbox_ambiente']; ?>">
				  		"<?php echo '<option value="'.($datos['mbox_ambiente'] ? $datos['mbox_ambiente']:0).'">'.$txtAmbiente.'</option>'; ?>"
				  		<option value="1">Produccion</option>
				  		<option value="2">Pruebas</option>
				  		<option value="3">Desarrollo</option>
				  	</select>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="reset" class="button is-link is-light is-rounded"><i class="fas fa-paint-roller"></i> &nbsp; Limpiar</button>
			<button type="submit" class="button is-info is-rounded"><i class="far fa-save"></i> &nbsp; Guardar</button>
		</p>
	</form>

	<?php } ?>
</div>