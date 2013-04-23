<?php
/**
* @file
* Despublica contenido que contenga un texto dado.
*/
/**
* Implements hook_drush_command().
*/
function unpublish_content_drush_command() {
	$items['unpublish-content'] = array(
		'description' => 'Despublica contenido que contenga un texto dado.',
		'aliases' => array('uc'),
		'examples' => array(
			'drush unpublish-content casa' => 'Despublica contenido que contenga la palabra casa.',
		),
		'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
		'arguments' => array(
			'text' => 'Texto a buscar en el campo body.',
		),
		'required-arguments' => TRUE,
		'options' => array(
			'type' => 'Tipo de contenido por el que queremos filtrar.',
		),
	);
	return $items;
}

/**
* Callback implementation for unpublish-content command.
*/
function drush_unpublish_content($text) {
	// Buscar nodos que tengan $text en el campo body.
	$result = db_query("SELECT entity_id as nid FROM {field_data_body} WHERE body_value LIKE :text", array(':text' => '%' . db_like($text) . '%',));
	$nids = array();
	foreach ($result as $row) {
		$nids[] = $row->nid;
	}
	
	// Despublicar los nodos encontrados.
	$query = db_update('node')
	->fields(array(
		'status' => 0,
	))
	->condition('nid', $nids, 'IN');

	// Filtramos por tipo de contenido si es necesario.
	$type = drush_get_option('type', '');
	if (!empty($type)) {
		$query->condition('type', $type);
		drush_log(dt("Filtering content by type '@type'", array('@type'	=> $type)), 'success');
	}
	$unpublished = $query->execute();
	
	// Mostrar resultados.
	drush_log(dt("Unpublished !unpublished nodes",
	array('!unpublished' => $unpublished)), 'success');
}

/**
* Implements drush_hook_COMMAND_validate().
*/
function drush_unpublish_content_validate() {
	// Verificamos que la opción type contiene un tipo de contenido.
	$type = drush_get_option('type');
	if (!empty($type)) {
		$types = array_keys(node_type_get_names());
		if (!in_array($type, $types)) {
			return drush_set_error('UNPUBLISH_CONTENT_WRONG_TYPE',
			dt('El tipo de contenido de la opción type no existe.'));
		}
	}
}