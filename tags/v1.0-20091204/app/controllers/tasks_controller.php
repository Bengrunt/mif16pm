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
		
		$isTeamAdmin = false;
		$isMyBusiness = false;
		
		//echo '<pre>', var_dump($user['Team']),'</pre>';
		
		foreach($user['Team'] as $team) {
		
			if($team['id'] == $task['Team']['id']) {
			
				$isMyBusiness = true;
				
				if($team['TeamsUser']['role_id'] == 3) {
				
					$isTeamAdmin = true;
					
				}
			}
		
		}
		
		$this->set('role' , $user['Role']['name']);
		$this->set('projects',$user['Project']);
		$this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
	
        $this->set('task', $task);
		
		$this->set('isMyBusiness', $isMyBusiness);
		$this->set('isTeamAdmin', $isTeamAdmin);
    }	
	
    public function add()
    {
		$this->loadModel('Role');
	
		$this->Task->User->id = $this->Auth->user('id');
        $user = $this->Task->User->read();
		//echo '<pre>', var_dump($user),'</pre>';
		
		$idRoleSiteAdmin = $this->getRoleId('site_admin');
		
		//$teams = $user['Project']['Team'];
		$teams = $this->Task->Team->find('all');
		
		//echo '<pre>', var_dump($teams),'</pre>';
		
		$projects = $user['Project'];
		//echo '<pre>', var_dump($projects),'</pre>';
		
		$project_names = array();
		$project_teams = array();
		
		foreach ($projects as $project) {
		
			$project_names[$project['id']] = $project['name'];
			
			foreach($teams as $team) {
			
				//echo '<pre>', var_dump($team),'</pre>';
				//echo '<pre>', var_dump($project['id']),'</pre>';
			
				if($team['Team']['project_id'] == $project['id']) {
				
					$project_teams[$team['Team']['id']] = $team['Team']['name'];
					
				}
			
			}
		
		}
		
		//echo '<pre>', var_dump($project_teams),'</pre>';
		
	
		//$this->set('teams', $this->Task->Team->find('list'));
		//$this->set('projects', $this->Task->Project->find('list'));
		
		if($idRoleSiteAdmin == $this->Auth->user("role_id")) {
		
			$this->set('projects', $this->Task->Project->find('list'));
			$this->set('teams', $this->Task->Team->find('list'));
		
		} else {
		
			$this->set('projects', $project_names);
			$this->set('teams', $project_teams);
		}
	
		if(!empty($this->data))
		{
			//echo '<pre>', var_dump($this->data),'</pre>';
		
			if (($this->Task->save($this->data) /*&& ($this->Task->Team->save($this->data)) && ($this->Task->Project->save($this->data))*/)) 
			{
				$this->flash('La tâche a bien été ajoutée et sauvegardée.','/tasks');
			}
			else
			{
				$this->flash('La tâche n\'a pas pu être ajoutée', '/tasks');
			}
		}
    }

    public function delete($id = null)
    {
		$this->Task->deleteAll(
			array('Task.id' => $id),
			false,
			false
		);
		$this->Task->TasksUser->deleteAll(
			array('TasksUser.task_id' => $id),
			false,
			false
		);
		$this->flash('La tâche ' . $id . ' a été supprimée.', '/tasks');
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
			if($this->Task->save($this->data))
			{
				$this->flash('Les attributs de la tâche ont bien été modifiés. ','/tasks');
			}
		}
		$this->set('tasks', $this->Task->Team->find('list'));		
    }
}