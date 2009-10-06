<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class Team extends AppModel
{
    public $name = "Team";

    public $hasAndBelongsToMany = "User";
    public $belongsTo = "Project";
	
	var $validate = array(
		'team_id' => array(
			'rule' => 'Numeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Une id doit avoir au moins 1 chiffre'
		),
		'user_id' => array(
			'rule' => 'Numeric'
			'required' => true,
			'allowEmpty' => false,
		),
		'role_id' => array(
			'rule' => 'alphaNumeric',
			'message' => 'Ce n\'est pas un role.'
		),
	);

}
