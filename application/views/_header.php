<div class="navbar">
	<div class="row">
			<form action="<?php echo base_url().'expedientes/busqueda_expediente';?>" method="POST" class="navbar-form navbar-left" role="form">
			
				<div class="form-group">
					<input type="text" class="form-control" id="param_busqueda" name="param_busqueda" placeholder="Busqueda">
				</div>
			
				<button type="submit" class="btn btn-default navbar-btn">Buscar</button>
			</form>

			<p class="navbar-text navbar-right">Hola <strong><?php echo $this->session->userdata('username');?></strong> // <a href="<?php echo base_url().'login/logout_ci';?>" class="navbar-link">Cerrar sesión</a></p>
	</div>
</div>