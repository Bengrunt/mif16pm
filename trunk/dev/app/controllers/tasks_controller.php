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
		$this->set('project_id', $this->Task->task('project_id'));
		$this->set('chief', $this);
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
				$this->flash('La tâche a bien été ajoutée et sauvegardée.','/tasks');
			}
		}
    }

    public function delete($id = null)
    {
		$this->Task->del($id);
		$this->flash('La tâche avec l\'id: '.$id.' a été supprimée.', '/tasks');
    }

    public function edit($id = null)
    {
		//$this->set('teams', $this->Task->Team->find('list'));
		if(empty($this->data))
		{
			$this->Task->id = $id; 
			$this->data = $this->Task->read();
		}
		else
		{
			if($this->Task->save($this->data['Task']))
			{
				$this->flash('Les attributs de la tâche ont bien été modifiés. ','/task');
			}
		}
		$this->set('tasks', $this->Task->Team->find('list'));		
    }
}