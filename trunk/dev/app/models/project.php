<?php

/**
 *
 * @author Benjamin Guillon - bengrunt@gmail.com
 * @see http://code.google.com/p/mif16pm/
 */
class Project extends AppModel
{
	public $BelongsTo = 'Team';

	public $validate = array(
		'name' => array(
			'rule' => array('minLength', 5),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Un nom doit au moins se composer de 5 lettres'
		),
		'description' => array(
			'rule' => array('minLength', 10),
			'message' => 'Veuillez remplir une description un peu plus longue.'
		)/*,
		'user_id' => array(
			'rule' => array('minLength',5),
			'message' => 'Un prénom doit au moins se composer de 5 lettres'
		)*/
	);
}
