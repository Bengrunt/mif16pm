<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class User extends AppModel
{
    public $name = "User";
    var $belongsTo = array('Role');

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

    /**
     * After save callback
     *
     * Update the aro for the user.
     *
     * @access public
     * @return void
     */
    function afterSave($created)
    {
        if (!$created)
        {
            $parent = $this->parentNode();
            $parent = $this->node($parent);
            $node = $this->node();
            $aro = $node[0];
            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
            $this->Aro->save($aro);
        }
    }
}
