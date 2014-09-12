

<form action="<?php echo base_url().'expedientes/nuevo_expediente'; ?>" method="POST" class="form-horizontal" role="form">

    
  <div class="form-group">
    <label for="CIF" class="col-sm-2 control-label">CIF</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="CIF" name="cif_ent" <?php if (isset($cif)){echo "value='".$cif."'";}?>placeholder="CIF">
    </div>
    <div class="col-sm-1">
      <a href="<?php echo base_url().'entidades/nueva_entidad'; ?>" class="btn btn-primary btn-block btn-sm active" role="button"><small>Añadir</small></a>
    </div>
  </div>


  <div class="form-group">
    <label for="entidad" class="col-sm-2 control-label">Entidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="entidad" name="nombre_ent" <?php if (isset($nombre)){echo "value='".$nombre."'";}?>placeholder="Entidad" disabled>
    </div>
  </div>




    <div class="form-group">
      <label for="tipo_exp" class="col-sm-2 control-label">Tipo expediente</label>
      <div class="col-sm-10">
        <select class="form-control" name="tipo_exp">
                <?php 
                    foreach ($expedientes_datos as $i => $tipo_exp)    
                    echo '<option value="',$i,'">',$tipo_exp,'</option>'; 
                ?>
        </select>
      </div>
    </div>


  <div class="form-group">
    <label for="asunto" class="col-sm-2 control-label">Asunto</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Asunto">
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Enviar</button>
    </div>
  </div>
</form>

  <!-- Botón de prueba para el jquery -->
  <a href="<?php echo site_url(); ?>">Volver a la lista</a>.


<!-- Script para cargar el nombre de la entidad, habiendo escrito el CIF -->
    
<script>
  $(document).ready(function() {
    $("#CIF").keyup(function(){
      var cif_input = $(this).val();
      console.log('el valor de id es ' + cif_input);
      $.ajax({
        url: 'getEntidad',
        type: 'POST',
        dataType: 'json',
        data: {cif: cif_input},
      })
      .done(function(data) {
        console.dir(data);
        console.log('La longitud de data es: ' + data.length);
        if (data.length == 1) 
          {
            $('#entidad').val(data[0].nombre);    
          } else {
            $('#entidad').val("");
          };
        
        console.log("success");
      })
      .fail(function(data) {
        $('#entidad').val("");
        console.log("error");
      })
      .always(function(data) {
        console.log("complete");
      });
    });
  $("#button").submit(function(event) {
    event.preventDefault();
    if ($('#entidad').val() == "") {
        alert("No existe la entidad, pulse el botón para crear nuevo");
      }
    });

  });
</script>
