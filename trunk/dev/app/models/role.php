<?php

class Role extends AppModel
{
    public $name = "Role";
    public $actsAs = array('Acl' => array('requester'));

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
}
