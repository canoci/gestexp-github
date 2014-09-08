
<div class="row">
	<div class="page-header">
  		<h4>Expedientes  <small>lista general  </small><span class="badge"><?php //echo $num_exp;?></span></h4>
	</div>
</div>


<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
<?php if(!$table) : ?>
<div class="alert alert-info" role="alert"></div>
	<p>
	  La lista de expedientes está vacía.
	</p>
</div>
<?php else : ?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Expedientes</div>
<?php echo $table; ?>
<!--</div>-->

<!-- ESTO ES PARA LA PAGINACION -->
        <div id="paginacion"><?php echo $this->pagination->create_links(); ?></div>
<!-- Fin de paginación -->
<?php endif; ?>
