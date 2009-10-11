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
        $this->set('projects', $this->Project->read());
    }	
	
    public function add()
    {
		if(!empty($this->data))
		{
			if ($this->Project->save($this->data)) 
			{
				$this->flash('Le projet a bien été ajouté et sauvegardé.','/projects');
			}
		}
    }

    public function delete($id = null)
    {
		$this->Project->del($id);
		$this->flash('Le projet avec l\'id: '.$id.' a été supprimé.', '/projects');
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
				$this->flash('Les attributs du projet ont bien été modifiés. ','/project');
			}
		}
		$this->set('projects', $this->Project->Team->find('list'));		
    }
	
	/*Gérer les droits
    public function admin()	
    {
		
	}
*/
}