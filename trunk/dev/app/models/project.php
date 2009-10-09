<?php

/**
 *
 * @author
 */
class Project extends AppModel
{
    public $name = "Project";
	public $hasMany = "Team";
	
	// A voir plus tard avec programmation tache 
	// public $hasMany = "Taches";
	
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
		'Chef de Projet' => array(
			'rule' => array('minLength',5),
			'message' => 'Un prenom doit au moins se composer de 5 lettres'
		),
	);
}
