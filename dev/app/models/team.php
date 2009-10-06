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
		'Nom' => array(
			'rule' => array('minLength', 5),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Un nom doit au moins se composer de 5 lettres'
		),
		'Description' => array(
			'rule' => array('minLength', 10),
			'message' => 'Veuillez remplir une description un peu plus longue.'

		),
		'Projet' => array(
			'rule' => 'alphaNumeric',
			'message' => 'Ce n\'est pas un Projet existant.'
		),
	);

}
