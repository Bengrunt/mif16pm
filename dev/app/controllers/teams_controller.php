<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class TeamsController extends AppController
{
    public $name = "Teams";

    /**
     *
     */
    public function index()
    {
        $this->set('teams', $this->Team->find('all'));
    }

    /**
     *
     */
    public function view($id = null)
    {
        $this->Team->id = $id;
        $this->set('team', $this->Team->read());
    }

    /**
     *
     */
    public function add()
    {	
		$this->set('projects', $this->Team->Project->find('list'));
		if (!empty($this->data)) 
		{
			if ($this->Team->save($this->data)) 
			{
				$this->flash('L\'équipe a bien été ajoutée et sauvegardée.', '/teams');
			}
		}
    }

    /**
     *
     */
    public function delete($id = null)
    {
		$this->Team->del($id);
		$this->flash('L\'equipe avec l\'id: '.$id.' a été supprimée.', '/teams');
    }

    /**
     *
     */
    public function edit($id = null)
    {	
		$this->set('projects', $this->Team->Project->find('list'));
		if(empty($this->data))
		{
			$this->Team->id = $id; 
			$this->data = $this->Team->read();
		}
		else
		{
			if($this->Team->save($this->data['Team']))
			{
				$this->flash('La composition de l\'équipe a bien été modifiée.', '/teams');
			}
		}
	}
}
