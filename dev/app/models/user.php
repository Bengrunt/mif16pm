<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class User extends AppModel
{
    public $name = "User";
    public $hasAndbelongsToMany = "Team";
    public $belongsTo = array('Role');

    public $validate = array(
        'Nom' => array(
            'rule' => array('minLength', 3),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Un nom doit au moins se composer de 3 lettres'
        ),
        'Prenom' => array(
            'rule' => array('minLength', 4),
            'message' => 'Un prenom doit avoir au moins 4 lettres'

        ),
        'Email' => array(
            'rule' => 'alphaNumeric',
            'required' => true,
            'allowEmpty' => false,
        )
    );
}
