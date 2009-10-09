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
        $this->set('teams', $this->Team->read());
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
				echo '<pre>';
					var_dump($this->data);
				echo '</pre><hr/>';

				$this->flash('Lequipe a bien ete ajoute & sauvergarde.','/teams');
			}
		}
    }

    /**
     *
     */
    public function delete($id = null)
    {
		$this->Team->del($id);
		$this->flash('Lequipe avec l\'id: '.$id.' a ete supprime.', '/teams');
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
			if($this->Team->save($this->data['Team']))
			{
				$this->flash('La composition de lequipe a bien ete modifie. ','/teams');
			}
		}
	}
}
