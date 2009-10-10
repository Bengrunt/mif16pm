<?php

/**
 *
 * @author Benjamin Guillon - bengrunt@gmail.com
 * @see http://code.google.com/p/mif16pm/
 */
class ProjectsController extends AppController
{

	public $name = "Projects";
	
	public function index()
    {
        $this->set('projects', $this->Project->find('all'));
    }

	public function view($id = null)
    {
        $this->Project->id = $id;
        $this->set('project', $this->Project->read());
    }	
	
    public function add()
    {
		if(!empty($this->data))
		{
			if ($this->Project->save($this->data)) 
			{
				$this->flash('Le projet a bien &eacute;t&eacute; ajout&eacute; &amp; sauvegard&eacute;e.','/projects');
			}
		}
    }

    public function delete($id = null)
    {
		$this->Project->del($id);
		$this->flash('Le projet avec l\'id: '.$id.' a ete supprime.', '/projects');
    }

    public function edit()
    {
		if(empty($this->data))
		{
			$this->Project->id = $id; 
			$this->data = $this->Project->read();
		}
		else
		{
			if($this->Project->save($this->data['Project']))
			{
				$this->flash('Les attributs du projet ont bien &eacutet&eacutes modifi&eacutes. ','/project');
			}
		}	
    }
	
	/*Gérer les droits
    public function admin()	
    {
		
	}
*/
}