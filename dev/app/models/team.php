<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class Team extends AppModel
{
    public $name = "Team";

    public $hasAndBelongsToMany = 'User';
    public $belongsTo = 'Project';
	//public $hasAndBelongsToMany = 'Task';

    /*public $validate = array(
        'name' => array(
            'rule' => array('minLength', 5),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Un nom doit au moins se composer de 5 lettres'
        ),
        'description' => array(
            'rule' => array('minLength', 10),
            'message' => 'Veuillez remplir une description un peu plus longue.'

        ),
        'projet' => array(
            'rule' => 'alphaNumeric',
            'message' => 'Ce n\'est pas un Projet existant.'
        )
    );*/

}
