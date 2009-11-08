<?php

/**
 *
 * @author Benjamin Guillon - bengrunt@gmail.com
 * @see http://code.google.com/p/mif16pm/
 */
class ProjectsController extends AppController
{

	public $name = "Projects";

	private function getProjectAdmin($project, $idRoleProjectAdmin) {
		foreach($project['User'] as $user):
			if($user['ProjectsUser']['role_id'] == $idRoleProjectAdmin):
				return $user;
			endif;
		endforeach;
	}
	
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
	
	private function flush($projectId, $teamId = null) {
		if(!is_null($teamId)) {
			$this->Project->Team->TeamsUser->deleteAll(
				array('TeamsUser.team_id' => $teamId),
				false,
				false
			);
			$this->Project->Team->deleteAll(
				array('Team.id' => $teamId),
				false,
				false
			);
		}
		$this->Project->ProjectsUser->deleteAll(
			array('ProjectsUser.project_id' => $projectId),
			false,
			false
		);
		$this->Project->deleteAll(
			array('Project.id' => $projectId),
			false,
			false
		);
	}
	
	public function index()
    {	
		$idRoleProjectAdmin = -1; /*< Id du rôle d'admin de projet. */
		$this->loadModel('Role');
		$idRoleProjectAdmin = $this->getRoleId('project_admin');
		
		if($idRoleProjectAdmin == -1) {
			$this->flash(
				'Erreur : Il n\'y aucun rôle ' +
				'`project_admin` n\'existe dans la base.',
				'/projects'
			);
			return;
		}
		
		$projects = $this->Project->find('all');
		
		foreach($projects as &$project) {
			$projectAdmin = $this->getProjectAdmin($project, $idRoleProjectAdmin);
			$project['admin'] = $projectAdmin;
		}
		
		$this->set('projects', $projects);
    }

	public function view($id = null)
    {
        $this->Project->id = $id;
        $this->set('project', $this->Project->read());
		$this->Project->Team->find('first',name);
		$this->Project->Team->User->find('first',name);
    }
	
	/**
	 * Ajout d'un nouveau projet à la base.
	 *
	 * @pre		Demande de création d'un nouveau projet par le biais du 
	 * 			formulaire de la vue.
	 * @post	Crée le projet et une équipe mère associée, tous deux
	 *			administrés par l'utilisateur courant (chef de projet et chef
	 *			équipe)
	 */
    public function add()
    {
		if(!empty($this->data))
		{
			/* 0 - Variables locales. --------------------------------------- */
			$userId = $this->Auth->user('id'); /*< Id de l'utilisateur courant. */
			$projectId = -1; /*< Id du projet créé. */
			$teamId = -1; /*< Id de l'équipe créée. */
			$idRoleProjectAdmin = -1; /*< Id du rôle d'admin de projet. */
			$idRoleTeamAdmin = -1; /*< Id du rôle d'admin d'équipe.*/
			
			/* 1 - Recherche des id des rôles propres à un chef de projet. -- */
			$this->loadModel('Role');
		
			/* On cherche l'ID du rôle correspondant à un chef de projet. */	
			$idRoleProjectAdmin = $this->getRoleId('project_admin');
			if($idRoleProjectAdmin == -1) {
				$this->flash(
					'Le projet n\'a pu être créé car aucun rôle ' +
					'`project_admin` n\'existe dans la base.',
					'/projects'
				);
				return;
			}
			
			/* On cherche l'ID du rôle correspondant à un chef d'équipe. */	
			$idRoleTeamAdmin = $this->getRoleId('team_admin');
			if($idRoleTeamAdmin == -1) {
				$this->flash(
					'Le projet n\'a pu être créé car aucun rôle ' +
					'`team_admin` n\'existe dans la base.',
					'/projects'
				);
				return;
			}
			
			/* 2 - Création du projet et de l'équipe mère. ------------------ */
			/* Création du projet dans la BDD. */
			if(!$this->Project->save($this->data)) {
				$this->flash(
					'Le projet n\'a pu être créé.',
					'/projects'
				);
				return;
			}
			
			$projectId = $this->Project->id;
			
			/* Création de l'équipe mère du projet. */
			if(!$this->Project->Team->save(Array(
				'name' => 'Equipe ' . $this->data['Project']['name'],
				'description' => 'Equipe du projet [' .
								 $projectId . '] "' .
								 $this->data['Project']['name'] . '"',
				'project_id' => $projectId,
				'user_id' => $this->Auth->user('id')
			))) {
				$this->flush($projectId);
				$this->flash(
					'L\'équipe associée au projet n\'a pu être créée.',
					'/projects'
				);
				return;
			}
			
			$teamId = $this->Project->Team->id;
			
			/* 3 - Association du projet et de l'équipe. -------------------- */
			$this->data['Project']['id'] = $projectId;
			$this->data['Project']['team_id'] = $teamId;
			
			if(!$this->Project->save($this->data)) {
				$this->flush($projectId, $teamId);
				$this->flash(
					'L\'équipe mère n\'a pu être associée au proket.',
					'/projects'
				);
				return;
			}
			
			/* 4 - Association utilisateur comme chef de projet et d'équipe.  */
			/* Association du chef de projet. */
			if(!$this->Project->ProjectsUser->save(Array(
				'project_id' => $projectId,
				'user_id' => $userId,
				'role_id' => $idRoleProjectAdmin
			))) {
				$this->flush($projectId, $teamId);
				$this->flash(
					'L\'utilisateur courant n\'a pu être associé comme chef ' +
					' de projet.',
					'/projects'
				);
				return;
			}
			
			/* Association du chef d'équipe. */
			if(!$this->Project->Team->TeamsUser->save(Array(
				'team_id' => $teamId,
				'user_id' => $userId,
				'role_id' => $idRoleTeamAdmin
			))) {
				$this->flush($projectId, $teamId);
				$this->flash(
					'L\'utilisateur courant n\'a pu être associé comme chef ' +
					' d\équipe.',
					'/projects'
				);
				return;
			}
			
			/* 5 - Message de confirmation en cas de succès. ---------------- */
			$this->flash(
				'Le projet a bien été ajouté et sauvegardé.',
				'/projects'
			);
		}
    }

    public function delete($id = null)
    {
		$this->Project->del($id);
		$this->flash('Le projet avec l\'id: ' . $id . ' a été supprimé.', '/projects');
    }

    public function edit($id = null)
    {
		$this->set('teams', $this->Project->Team->find('list'));
		
		$projectUsersResult = $this->Project->query(
			'SELECT `User`.id, `User`.name FROM `users` AS `User`
			WHERE `User`.id IN (
				SELECT `ProjectsUser`.user_id
				FROM `projects_users` AS `ProjectsUser`
				WHERE `ProjectsUser`.project_id = ' . $id .
			')'
		);
		$users = array();
		foreach($projectUsersResult as $row) {
			$users[$row['User']['id']] = $row['User']['name'];
		}
		$this->set('users', $users);
		if(empty($this->data))
		{
			$this->Project->id = $id; 
			$this->data = $this->Project->read();
		}
		else
		{
			if($this->Project->save($this->data['Project']))
			{
				$this->flash('Les attributs du projet ont bien été modifiés.', '/project');
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