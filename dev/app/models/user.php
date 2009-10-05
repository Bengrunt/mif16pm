<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class User extends AppModel
{
    public $name = "User";
    var $belongsTo = array('Group');

    var $actsAs = array('Acl' => 'requester');

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
        if (!$data['User']['role_id'])
        {
            return null;
        }
        else
        {
            return array('Role' => array('id' => $data['User']['role_id']));
        }
    }
}
