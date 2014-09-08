<?php

$lang['db_invalid_connection_str'] = 'No se puede determinar la configuración de base de datos basado en la cadena de conexión que ha enviado.';
$lang['db_unable_to_connect'] = 'No se puede conectar con el servidor de base de datos utilizando la configuración proporcionada.';
$lang['db_unable_to_select'] = 'No se pudo seleccionar la base de datos especificada:% s';
$lang['db_unable_to_create'] = 'No se pudo crear la base de datos especificada:% s';
$lang['db_invalid_query'] = 'La consulta que ha enviado no es válida.';
$lang['db_must_set_table'] = 'Debe poner la tabla de la base de datos que se utilizará con la consulta.';
$lang['db_must_use_set'] = 'Debe utilizar el método "set" para actualizar una entrada.';
$lang['db_must_use_index'] = 'Debe especificar un índice para que coincida con el de actualizaciones por lotes.';
$lang['db_batch_missing_index'] = 'Una o más filas enviadas para la actualización por lotes no encuentra el índice especificado.';
$lang['db_must_use_where'] = 'Las actualizaciones no están permitidos a menos que contengan una cláusula "where".';
$lang['db_del_must_use_where'] = 'Eliminar no están permitido, a menos que contengan una cláusula de "where" o "like"';
//A medio traducir
$lang['db_field_param_missing'] = 'To fetch fields requires the name of the table as a parameter.';
$lang['db_unsupported_function'] = 'This feature is not available for the database you are using.';
$lang['db_transaction_failure'] = 'Transaction failure: Rollback performed.';
$lang['db_unable_to_drop'] = 'Unable to drop the specified database.';
$lang['db_unsuported_feature'] = 'Unsupported feature of the database platform you are using.';
$lang['db_unsuported_compression'] = 'The file compression format you chose is not supported by your server.';
$lang['db_filepath_error'] = 'Unable to write data to the file path you have submitted.';
$lang['db_invalid_cache_path'] = 'The cache path you submitted is not valid or writable.';
$lang['db_table_name_required'] = 'A table name is required for that operation.';
$lang['db_column_name_required'] = 'A column name is required for that operation.';
$lang['db_column_definition_required'] = 'A column definition is required for that operation.';
$lang['db_unable_to_set_charset'] = 'Unable to set client connection character set: %s';
$lang['db_error_heading'] = 'A Database Error Occurred';

/* End of file db_lang.php */
/* Location: ./system/language/english/db_lang.php */