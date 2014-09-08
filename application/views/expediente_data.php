<fieldset>
        <legend>Datos expediente</legend>
        <h3><p class="bg-primary"><?php echo $expediente_data['nombre_entidad'];?></p></h3>
        <h5><p class="text-right"><small><?php echo $expediente_data['cif_ent']; ?></small></p></h5>


        <h4><p class="bg-info"><?php echo $expediente_data['asunto']; ?></p></h4>
        <h5><p class="text-right"><small><?php echo "[".$expediente_data['tipo_exp']."]"."    "; ?><?php echo $expediente_data['nombre_tipo_exp']; ?></small></p></h5>
</fieldset>

<fieldset>
    <legend>Documentos asociados</legend>

    <!-- Esto es una alternativa de listado de documentos-->
        
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php if(!$table) : ?>
    <div class="alert alert-info" role="alert"></div>
        <p>La lista de documentos está vacía.</p>
    </div>
        <?php else : ?>
    <div class="panel panel-default">
    <div class="panel-heading">Documentos</div>
        <?php echo $table; ?>
    </div>
        <?php endif; ?>
    <!-- Hasta aquí la alternativa -->

</fieldset>

<fieldset>
    <legend>Subir documentos</legend>
    <!-- FORMULARIO DE SUBIDA DE MAS DOCUMENTOS -->
    <?php
        $cif_ent = $expediente_data['cif_ent'];
        $id_exp = $expediente_data['id_exp'];
    ?>
<!-- enctype="multipart/form-data" hay que añadírselo al fomulario para poder subir archivos-->
<form enctype="multipart/form-data" action="<?php echo base_url().'upload/do_upload/'.$cif_ent.'/'.$id_exp;?>" method="POST" class="form-horizontal" role="form">
  
    <div class="form-group">
        <label for="num_pag" class="col-sm-2 control-label">Páginas</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="num_pag" name="num_pag" placeholder="páginas">
        </div>
    </div>

  <div class="form-group">
    <label for="num_registro" class="col-sm-2 control-label">Núm. registro</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="num_registro" name="num_registro" placeholder="Núm. registro">
  </div>
</div>

<div class="form-group">
    <label for="tipo_doc" class="col-sm-2 control-label">Tipo documento</label>
    <div class="col-sm-10">
        <select class="form-control" name="tipo_doc">
            <?php 
            foreach ($tipo_documentos as $i => $tipo_doc)    
                echo '<option value="',$i,'">',$tipo_doc,'</option>'; 
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="file" name="userfile" id="userfile" class="form-control" maxlength="100" size="50">
    </div>
</div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary <?php echo $permiso_role; ?>" value="Agregar documento">
        </div>
    </div>
</form>
        </fieldset>
        <!-- Hasta aquí -->


        <div class="span-24 last">
          <a href="<?php echo site_url(); ?>">Volver a la lista</a>.
      </div>