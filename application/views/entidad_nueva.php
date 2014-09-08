<?php 
//if (isset($errores)) {
//	die($errores);
//}
?>
<form action="<?php echo base_url().'entidades/insertar'; ?>" method="POST" class = "form-horizontal" role="form">
	<legend>Nueva entidad</legend>

	<div class="form-group">
		<label for="cif" class="col-sm-2 control-label">CIF</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="cif" name="cif" placeholder="CIF" value="<? echo set_value('cif')?>">
			<?=form_error('cif')?>
		</div>
	</div>

	<div class="form-group">
		<label for="nombre" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Entidad" value="<? echo set_value('nombre')?>">
			<?=form_error('nombre')?>
		</div>
	</div>

	<div class="form-group">
		<label for="direccion" class="col-sm-2 control-label">Dirección</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<? echo set_value('direccion')?>">
			<?=form_error('direccion')?>
		</div>
	</div>

	<div class="form-group">
		<label for="cp" class="col-sm-2 control-label">CP</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal" value="<? echo set_value('cp')?>">
			<?=form_error('cp')?>
		</div>
	</div>

	<div class="form-group">
		<label for="localidad" class="col-sm-2 control-label">Localidad</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="localidad" name="localidad" placeholder="Localidad" value="<? echo set_value('localidad')?>">
			<?=form_error('localidad')?>
		</div>
	</div>

	<div class="form-group">
		<label for="provincia" class="col-sm-2 control-label">Provincia</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="provincia"  name="provincia" placeholder="Provincia" value="<? echo set_value('provincia')?>">
			<?=form_error('provincia')?>
		</div>
	</div>

	<div class="form-group">
		<label for="telefono" class="col-sm-2 control-label">Telefono</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="telefono"  name="telefono" placeholder="Teléfono" value="<? echo set_value('telefono')?>">
			<?=form_error('telefono')?>
		</div>
	</div>

	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email"  name="email" placeholder="e-mail" value="<? echo set_value('email')?>">
			<?=form_error('email')?>
		</div>
	</div>
	
	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Enviar</button>
    </div>
  </div>

</form>