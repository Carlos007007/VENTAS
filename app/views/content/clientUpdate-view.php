<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle"><i class="fas fa-sync-alt"></i> &nbsp; Actualizar cliente</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
	
		include "./app/views/inc/btn_back.php";

		$id=$insLogin->limpiarCadena($url[1]);

		$datos=$insLogin->seleccionarDatos("Unico","cliente","cliente_id",$id);

		if($datos->rowCount()==1){
			$datos=$datos->fetch();
	?>

	<h2 class="title has-text-centered"><?php echo $datos['cliente_nombre']." ".$datos['cliente_apellido']." (".$datos['cliente_tipo_documento'].": ".$datos['cliente_numero_documento'].")"; ?></h2>

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/clienteAjax.php" method="POST" autocomplete="off" >

		<input type="hidden" name="modulo_cliente" value="actualizar">
		<input type="hidden" name="cliente_id" value="<?php echo $datos['cliente_id']; ?>">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Tipo de documento <?php echo CAMPO_OBLIGATORIO; ?></label><br>
				  	<div class="select">
					  	<select name="cliente_tipo_documento">
	                        <?php
	                        	echo $insLogin->generarSelect(DOCUMENTOS_USUARIOS,$datos['cliente_tipo_documento']);
	                        ?>
					  	</select>
					</div>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Numero de documento <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_numero_documento" value="<?php echo $datos['cliente_numero_documento']; ?>" pattern="[a-zA-Z0-9-]{7,30}" maxlength="30" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_nombre" value="<?php echo $datos['cliente_nombre']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_apellido" value="<?php echo $datos['cliente_apellido']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Estado, provincia o departamento <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_provincia" value="<?php echo $datos['cliente_provincia']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}" maxlength="30" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Ciudad o pueblo <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_ciudad" value="<?php echo $datos['cliente_ciudad']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}" maxlength="30" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Calle o dirección de casa <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="cliente_direccion" value="<?php echo $datos['cliente_direccion']; ?>" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}" maxlength="70" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Teléfono</label>
				  	<input class="input" type="text" name="cliente_telefono" value="<?php echo $datos['cliente_telefono']; ?>" pattern="[0-9()+]{8,20}" maxlength="20" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="cliente_email" value="<?php echo $datos['cliente_email']; ?>" maxlength="70" >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded"><i class="fas fa-sync-alt"></i> &nbsp; Actualizar</button>
		</p>
		<p class="has-text-centered pt-6">
            <small>Los campos marcados con <?php echo CAMPO_OBLIGATORIO; ?> son obligatorios</small>
        </p>
	</form>
	<?php
		}else{
			include "./app/views/inc/error_alert.php";
		}
	?>
</div>