<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle"><i class="fas fa-box fa-fw"></i> &nbsp; Nuevo producto</h2>
</div>

<div class="container pb-6 pt-6">

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/productoAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

		<input type="hidden" name="modulo_producto" value="registrar">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,77}" maxlength="77" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio de compra <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="producto_precio_compra" pattern="[0-9.]{1,25}" maxlength="25" value="0.00" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Precio de venta <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="producto_precio_venta" pattern="[0-9.]{1,25}" maxlength="25" value="0.00" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock o existencias <?php echo CAMPO_OBLIGATORIO; ?></label>
				  	<input class="input" type="text" name="producto_stock" pattern="[0-9]{1,22}" maxlength="22" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Marca</label>
				  	<input class="input" type="text" name="producto_marca" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}" maxlength="30" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Modelo</label>
				  	<input class="input" type="text" name="producto_modelo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}" maxlength="30" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Presentación del producto <?php echo CAMPO_OBLIGATORIO; ?></label><br>
				  	<div class="select">
					  	<select name="producto_unidad">
					    	<option value="" selected="" >Seleccione una opción</option>
	                        <?php
	                        	echo $insLogin->generarSelect(PRODUCTO_UNIDAD,"VACIO");
	                        ?>
					  	</select>
					</div>
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría <?php echo CAMPO_OBLIGATORIO; ?></label><br>
		    	<div class="select">
				  	<select name="producto_categoria" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
                            $datos_categorias=$insLogin->seleccionarDatos("Normal","categoria","*",0);

                            $cc=1;
                            while($campos_categoria=$datos_categorias->fetch()){
                                echo '<option value="'.$campos_categoria['categoria_id'].'">'.$cc.' - '.$campos_categoria['categoria_nombre'].'</option>';
                                $cc++;
                            }
                        ?>
				  	</select>
				</div>
		  	</div>
		</div>
		<div class="columns">
			<div class="column">
				<label>Foto o imagen del producto</label><br>
				<div class="file is-small has-name">
				  	<label class="file-label">
				    	<input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg" >
				    	<span class="file-cta">
				      		<span class="file-label">Imagen</span>
				    	</span>
				    	<span class="file-name">JPG, JPEG, PNG. (MAX 5MB)</span>
				  	</label>
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="reset" class="button is-link is-light is-rounded"><i class="fas fa-paint-roller"></i> &nbsp; Limpiar</button>
			<button type="submit" class="button is-info is-rounded"><i class="far fa-save"></i> &nbsp; Guardar</button>
		</p>
		<p class="has-text-centered pt-6">
            <small>Los campos marcados con <?php echo CAMPO_OBLIGATORIO; ?> son obligatorios</small>
        </p>
	</form>
</div>