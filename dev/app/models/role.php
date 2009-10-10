<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class Role extends AppModel
{
    public $name = "Role";
    public $belongsToMany = "User";
	
	
	var $validate = array(
		'name' => array(
			'rule' => array('minLength', 5),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Un rôle doit au moins se composer de 5 lettres'
		)
	);

}