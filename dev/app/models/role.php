<?php

class Role extends AppModel
{
    public $name = "Role";
    public $actsAs = array('Acl' => array('requester'));
	public $hasAndBelongsToMany = "User";
    public $belongsTo = "Team";

    function parentNode()
    {
		if (!$this->id && empty($this->data))
        {
            return null;
        }
        $data = $this->data;
        if (empty($this->data))
        {
            $data = $this->read();
        }
        if (!$data['role']['role_id'])
        {
            return null;
        }
        else
        {
            return array('Role' => array('id' => $data['role']['role_id']));
        }
    }
	
	var $validate = array(
		'Nom' => array(
			'rule' => array('minLength', 5),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Un role doit au moins se composer de 5 lettres'
		),
	)
}
