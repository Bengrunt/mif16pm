<?php

/**
 *
 * @author Mamy Raminosoa - raminosoa.mamy@gmail.com
 * @author Rémi Auduon - superchinois26@gmail.com
 * @see http://code.google.com/p/mif16pm/ 
 */
class Task extends AppModel
{
    public $name = "Task";
    public $hasAndBelongsToMany = "Team";
	public $belongsTo = "Project";
	
	public $validate = array(
		'task_name' => array(
			'rule' => array('minLength', 5),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Le nom de la tâche doit être au minimum de 5 caractères.'
		),
		'duration' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'La durée de la tâche ne peut être vide.'
		)
	);

}