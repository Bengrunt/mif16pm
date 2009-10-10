<?php

class RolesController extends AppController
{
    public $scaffold;
	public $name = "Roles";
	
	  /**
     *
     */
    public function index()
    {
        $this->set('roles', $this->Role->find('all'));
    }

    /**
     *
     */
    public function view($id = null)
    {
        $this->Role->id = $id;
        $this->set('roles', $this->Role->read());
    }

    /**
     *
     */
    public function add()
    {	
		if (!empty($this->data)) 
		{
			if ($this->Role->save($this->data)) 
			{
				$this->flash('Le role a bien &eacute;t&eacute; ajout&eacute; &amp; sauvegard&eacute;e.','/roles');
			}
		}
    }

    /**
     *
     */
    public function delete($id = null)
    {
		$this->Role->del($id);
		$this->flash('Le role avec l\'id: '.$id.' a ete supprime.', '/roles');
    }
}