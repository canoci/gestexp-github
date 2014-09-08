<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <h2>Lista de documentos</h2>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <?php if(!$documento_list) : ?>
<p>
  La lista de documentos está vacía.
</p>
<?php else : ?>
<ul>
<?php
  reset($documento_list);
  foreach ($documento_list as $documento) {
    echo "<li>";
    echo "<a ";
    echo "href='", site_url('/documentos/prod/' . $documento['id_doc']) . "'>";
    echo $documento['nombre'];
    echo "</a>";
    echo " ";
    echo "</li>";
    echo PHP_EOL;
  }
?>
</ul>
<?php endif; ?>
</div>
