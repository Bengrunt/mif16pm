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
		if (!empty($this->data)) 
		{
			if ($this->Team->save($this->data)) 
			{
				$this->flash('Lequipe a bien été ajouté & sauvergardé.','/team');
			}
		}
    }

    /**
     *
     */
    public function delete($id = null)
    {
		$this->del($id);
		$this->flash('Lequipe avec l\'id: '.$id.' a été supprimé.', '/team');
    }

    /**
     *
     */
    public function edit($id = null)
    {	
		if(!empty($this->data))
		{
			$this->Team->id = $id; 
			$this->data = $this->Team->read();
		}
		else
		{
			if($this->Team->save($this->data)
			{
				$this->flash('La composition de lequipe='. $id 'a bien été modifié', array('controller' => 'team','action'=>'index'));
			}
		}
e
    }
}
