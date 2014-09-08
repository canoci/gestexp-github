

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

  <div class="wrapper">
      <input type="text" id="framework" />
  </div>

  <!-- Botón de prueba para el jquery -->
  <button type="button" class="btn btn-default" id="boton">Consulta CIF</button>
  <div class="div381">aaaa</div>
  <a href="<?php echo site_url(); ?>">Volver a la lista</a>.


<!-- Script para cargar el nombre de la entidad, habiendo escrito el CIF -->
 
  <script type="text/javascript">
 /* $('document').ready(function()
  {
      $('#boton').click(function(){
          if($('#CIF').val()==""){
            alert("Introduce el CIF");
            return false;
            }
          else{
            var CIF = $('#CIF').val();
        }


          $.getJSON( "http://localhost:8080/gestexp/entidades/getEntidades", { cif: CIF }, function(json){
            console.dir(json);
          });
        });
  });*/


  $(document).ready( function() {
    $('#boton').click(function() {
        if($('#CIF').val()==""){
          alert("Introduce el CIF");
          return false;
        } else {
            var CIF = $('#CIF').val();
          }
        $.ajax({
            type: 'POST',
            url: '../entidades/getEntidades',
            data: 'cif:CIF',
            dataType: 'json',
            cache: false,
            success:function(retrieved_data){
            // Your code here.. use something like this
            var Obj = JSON.parse(retrieved_data)

            // Since your controller produce array of object you can access the value by using this one :
            for(var a=0; a< Obj.length; a++){
              console.log("the value with id : " + Obj.nombre + "is " + Obj.estado);
                $('#entidad').html(Obj.nombre);
              }
            },
        });
    });
});
</script>
