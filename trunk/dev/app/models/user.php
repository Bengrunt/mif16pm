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
    public $belongsTo = "Role";

    /*public $validate = array(
        'username' => array(
            'rule' => array('minLength', 3),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Un nom doit au moins se composer de 3 lettres'
        ),
        'firstname' => array(
            'rule' => array('minLength', 4),
            'message' => 'Un prénom doit avoir au moins 4 lettres'

        ),
        'lastname' => array(
            'rule' => 'alphaNumeric',
            'required' => true,
            'allowEmpty' => false,
        )
    );//*/
}
