<?php

/**
 *
 * @author Mamy Raminosoa - raminosoa.mamy@gmail.com
 * @author Rémi Auduon - superchinois26@gmail.com
 * @see http://code.google.com/p/mif16pm/ 
 */
class TasksController extends AppController
{

	public $name = "Tasks";
	
	public function index()
    {
        $this->set('tasks', $this->Task->find('all'));
    }

	public function view($id = null)
    {
        $this->Task->id = $id;
        $this->set('tasks', $this->Task->read());
    }	
	
    public function add()
    {
		if(!empty($this->data))
		{
			if ($this->Task->save($this->data)) 
			{
				$this->flash('La tâche a bien &eacute;t&eacute; ajout&eacutee; &amp; sauvegard&eacute;e.','/tasks');
			}
		}
    }

    public function delete($id = null)
    {
		$this->Task->del($id);
		$this->flash('La tâche avec l\'id: '.$id.' a ete supprimée.', '/tasks');
    }

    public function edit()
    {
		if(empty($this->data))
		{
			$this->Task->id = $id; 
			$this->data = $this->Task->read();
		}
		else
		{
			if($this->Task->save($this->data['Task']))
			{
				$this->flash('Les attributs de la tâche ont bien &eacutet&eacutes modifi&eacutes. ','/task');
			}
		}
		$this->set('tasks', $this->Task->Team->find('list'));		
    }
}