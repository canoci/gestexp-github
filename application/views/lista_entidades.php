<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>id</th>
			<th>CIF</th>
			<th>Entidad</th>
			<th>Dirección</th>
			<th>CP</th>
			<th>localidad</th>
			<th>provincia</th>
			<th>telefono</th>
			<th>e-mail</th>
			<th>acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($entidades as $key => $value) {
			echo "<tr>";
			echo "<td>".$value->id_ent."</td>";
			echo "<td>".$value->cif."</td>";
			echo "<td>".$value->nombre."</td>";
			echo "<td>".$value->direccion."</td>";
			echo "<td>".$value->cp."</td>";
			echo "<td>".$value->localidad."</td>";
			echo "<td>".$value->provincia."</td>";
			echo "<td>".$value->telefono."</td>";
			echo "<td>".$value->email."</td>";
			echo "<td>borrar editar</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>

