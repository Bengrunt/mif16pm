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
	
	private function getRoleId($roleName) {
		$params = array (
			'conditions' => array(
				'Role.name' => $roleName
			),
			'fields' => array('Role.id')
		);
		$resultRole = $this->Role->find('first', $params);
		
		/* Test si un id de rôle a bien été retourné. */
		if(empty($resultRole)) {
			return -1;
		} else {
			return $resultRole['Role']['id'];
		}
	}
		
	public function index()
    {
		$idRoleSiteAdmin = -1; /*< Id du rôle d'admin de projet. */
		$this->Task->User->id = $this->Auth->user('id');
        $user = $this->Task->User->read();
		
		$this->loadModel('Role');	
		$tasks = $this->Task->find('all');
		$idRoleSiteAdmin = $this->getRoleId('site_admin');
		
		if($idRoleSiteAdmin == -1) {
			$this->flash(
				'Erreur : Il n\'y aucun rôle ' +
				'`site_admin` n\'existe dans la base.',
				'/projects'
			);
			return;
		}
		
		foreach($tasks as &$task) {
			$task['isMyBusiness'] = false;
			foreach($task['User'] as $taskUser) {
				if($this->Task->User->id == $taskUser['id']) {
					$task['isMyBusiness'] = true;
					break;
				}
			}
		}
		
        $this->set('tasks', $tasks);
		
		//$this->set('id', $id);
		$this->set('role' , $user['Role']['name']);
		$this->set('projects',$user['Project']);
		$this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
		
		//$this->set('project', $user['Project']);
    }

	public function view($id = null)
    {
		$idRoleSiteAdmin = -1; /*< Id du rôle d'admin de projet. */
		$this->Task->User->id = $this->Auth->user('id');
        $user = $this->Task->User->read();
		
		$this->loadModel('Role');	
		$this->Task->id = $id;
		$task = $this->Task->read();
		$idRoleSiteAdmin = $this->getRoleId('site_admin');
		
		if($idRoleSiteAdmin == -1) {
			$this->flash(
				'Erreur : Il n\'y aucun rôle ' +
				'`site_admin` n\'existe dans la base.',
				'/projects'
			);
			return;
		}
		foreach($task['User'] as $taskUser) {
		
			$task['isMyBusiness'] = false;
			if($this->Task->User->id == $taskUser['id']) {
			
				$task['isMyBusiness'] = true;
			
			}
		}
		
		$this->set('role' , $user['Role']['name']);
		$this->set('projects',$user['Project']);
		$this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
	
        $this->set('task', $task);
    }	
	
    public function add()
    {
		$this->Task->User->id = $this->Auth->user('id');
        $user = $this->Task->User->read();
		
		//echo '<pre>', var_dump($user),'</pre>';
		
		//$projects = $user['Project'];
		$projects = $this->Task->Project->find('list');
		$teams = $this->Task->Team->find('list');
	
		//echo '<pre>', var_dump($projects),'</pre>';
		//echo '<pre>', var_dump($teams),'</pre>';
	
		$this->set('teams', $teams);
		$this->set('projects', $projects);
	
		if(!empty($this->data))
		{
			echo '<pre>', var_dump($this->data),'</pre>';
		
			echo "blibli";
			if ($this->Task->save($this->data)) 
			{
				echo "bloblo";
				$this->flash('La tâche a bien été ajoutée et sauvegardée.','');
			}
			else
			{
				$this->flash('La tâche n\'a pas pu être ajoutée', '');
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
	
		$this->Task->User->id = $this->Auth->user('id');
        $user = $this->Task->User->read();
		
		$projects = $user['Project'];
		$teams = $user['Team'];
	
		$this->set('teams', $teams);
		$this->set('projects', $projects);

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