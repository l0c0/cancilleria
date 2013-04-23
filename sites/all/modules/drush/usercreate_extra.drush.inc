<?php
/**
* @file
* Permite añadir un rol extra cuando se crea un usuario.
*/

/**
* Implements hook_drush_help_alter().
*
* Añade una opción "role" y un ejemplo al comando user-create.
*/
function usercreate_extra_drush_help_alter(&$command) {
	if ($command['command'] == 'user-create') {
		$command['options']['role'] = 'The name of an extra role to be assigned to the new account.';
		$command['examples']['drush user-create john --role=publisher'] = 'Create a new user account with the name john and the extra role publisher.';
	}
}

/**
* Implements drush_hook_post_COMMAND().
*
* Añade el rol extra al usuario recién creado.
*/
function drush_usercreate_extra_post_user_create($name) {
	$role_name = drush_get_option('role');
	if (!empty($role_name)) {
		$role = user_role_load_by_name($role_name);
		if ($role) {
			$user = user_load_by_name($name);
			user_multiple_role_edit(array($user->uid), 'add_role', $role->rid);
			drush_log(dt('Added extra role @role.', array('@role' => $role_name)), 'success');
		}
	}
}