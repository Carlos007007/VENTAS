<div class="container is-fluid">
	<h1 class="title">Home</h1>
  	<div class="columns is-flex is-justify-content-center">
    	<figure class="image is-128x128">
    		<?php
    			if(is_file("./app/views/fotos/".$_SESSION['foto'])){
    				echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
    			}else{
    				echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/default.png">';
    			}
    		?>
		</figure>
  	</div>
  	<div class="columns is-flex is-justify-content-center">
  		<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h2>
  	</div>
</div>
<?php
	$total_cajas=$insLogin->seleccionarDatos("Normal","caja","caja_id",0);

	$total_usuarios=$insLogin->seleccionarDatos("Normal","usuario WHERE usuario_id!='1' AND usuario_id!='".$_SESSION['id']."'","usuario_id",0);

	$total_clientes=$insLogin->seleccionarDatos("Normal","cliente WHERE cliente_id!='1'","cliente_id",0);

	$total_categorias=$insLogin->seleccionarDatos("Normal","categoria","categoria_id",0);

	$total_productos=$insLogin->seleccionarDatos("Normal","producto","producto_id",0);

	$total_ventas=$insLogin->seleccionarDatos("Normal","venta","venta_id",0);
?>
<div class="container pb-6 pt-6">

	<div class="columns pb-6">
		<div class="column">
			<nav class="level is-mobile">
			  	<div class="level-item has-text-centered">
				    <a href="<?php echo APP_URL; ?>cashierList/">
				      	<p class="heading"><i class="fas fa-cash-register fa-fw"></i> &nbsp; Cajas</p>
				      	<p class="title"><?php echo $total_cajas->rowCount(); ?></p>
				    </a>
			  	</div>
			  	<div class="level-item has-text-centered">
			    	<a href="<?php echo APP_URL; ?>userList/">
			      		<p class="heading"><i class="fas fa-users fa-fw"></i> &nbsp; Usuarios</p>
			      		<p class="title"><?php echo $total_usuarios->rowCount(); ?></p>
			    	</a>
			  	</div>
			  	<div class="level-item has-text-centered">
				    <a href="<?php echo APP_URL; ?>clientList/">
				      	<p class="heading"><i class="fas fa-address-book fa-fw"></i> &nbsp; Clientes</p>
				      	<p class="title"><?php echo $total_clientes->rowCount(); ?></p>
				    </a>
			  	</div>
			</nav>
		</div>
	</div>

	<div class="columns pt-6">
		<div class="column">
			<nav class="level is-mobile">
				<div class="level-item has-text-centered">
				    <a href="<?php echo APP_URL; ?>categoryList/">
				      <p class="heading"><i class="fas fa-tags fa-fw"></i> &nbsp; Categorías</p>
				      <p class="title"><?php echo $total_categorias->rowCount(); ?></p>
				    </a>
			  	</div>
			  	<div class="level-item has-text-centered">
				    <a href="<?php echo APP_URL; ?>productList/">
				      	<p class="heading"><i class="fas fa-cubes fa-fw"></i> &nbsp; Productos</p>
				      	<p class="title"><?php echo $total_productos->rowCount(); ?></p>
				    </a>
			  	</div>
			  	<div class="level-item has-text-centered">
			    	<a href="<?php echo APP_URL; ?>saleList/">
			      		<p class="heading"><i class="fas fa-shopping-cart fa-fw"></i> &nbsp; Ventas</p>
			      		<p class="title"><?php echo $total_ventas->rowCount(); ?></p>
			    	</a>
			  	</div>
			</nav>
		</div>
	</div>

</div>