<?php

class Role extends AppModel
{
    public $name = "Role";
    public $actsAs = array('Acl' => array('requester'));

    function parentNode()
    {
        return null;
    }
}
