<?php

/**
 *
 * @author Benjamin Guillon - bengrunt@gmail.com
 * @see http://code.google.com/p/mif16pm/
 */
class ProjectsController extends AppController {
	
	public $name = "Projects";

	/**
	 * Méthode utilitaire donnant le nom du chef d'un projet.
	 *
	 * @param project {Project} Un projet.
	 * @param idRoleProjectAdmin {int} Id du rôle d'un chef de projet.
	 * @return {User} Chef de projet.
	 */
	private function getProjectAdmin($project, $idRoleProjectAdmin) {
		foreach($project['User'] as $user)
			if($user['ProjectsUser']['role_id'] == $idRoleProjectAdmin)
				return $user;
	}
	
	/**
	 * Méthode utilitaire donnant l'id d'un rôle à partir de son nom.
	 *
	 * @pre		Nécessite une instantiation du modèle Role.
	 * @post	Id du rôle correspondant retourné.
	 *
	 * @param roleName {String} Nom d'un rôle.
	 * @return {int} Id du rôle associé.
	 */
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
	
	/**
	 * Méthode utilitaire donnant le nom d'un rôle à partir de son id.
	 *
	 * @pre		Nécessite une instantiation du modèle Role.
	 * @post	Nom du rôle correspondant retourné.
	 *
	 * @param	roleId {int} Id d'un rôle.
	 * @return	{String} Nom du rôle associé.
	 */
	private function getRoleName($roleId) {
		$params = array (
			'conditions' => array(
				'Role.id' => $roleId
			),
			'fields' => array('Role.name')
		);
		$resultRole = $this->Role->find('first', $params);
		
		/* Test si un nom de rôle a bien été retourné. */
		if(empty($resultRole)) {
			return null;
		} else {
			return $resultRole['Role']['name'];
		}
	}
	
	/**
	 * Méthode utilitaire supprimant les données insérées pour un projet.
	 *
	 * @param projectId {int} Id du projet à supprimer.
	 * @param teamId {int} Id de l'équipe mère associée.
	 */
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
	
	/**
	 * Change le chef de projet de l'association ProjectUsers.
	 *
	 * @param[in] projectId {int} Id du projet
	 * @param[in] newProjectAdminId {int} Id du nouveau chef projet
	 */
	private function changeProjectAdmin($projectId, $newProjectAdminId) {
		$projectAdminRoleId = $this->getRoleId('project_admin');
		$projectUserRoleId = $this->getRoleId('project_user');
		
		$this->Project->query(
			'UPDATE projects_users
			SET role_id = ' . $projectUserRoleId . '
			WHERE role_id = ' . $projectAdminRoleId . '
			AND project_id = ' . $projectId
		);
		$this->Project->query(
			'UPDATE projects_users
			SET role_id = ' . $projectAdminRoleId . '
			WHERE user_id = ' . $newProjectAdminId . '
			AND project_id = ' . $projectId
		);
	}
	
	/**
	 * Affiche un listing des entrées de projets.
	 */
	public function index()
    {	
		$idRoleProjectAdmin = -1; /*< Id du rôle d'admin de projet. */
		$idRoleSiteAdmin = -1; /*< Id du rôle d'admin de l'application. */
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
		
		$idRoleSiteAdmin = $this->getRoleId('site_admin');
		
		if($idRoleSiteAdmin == -1) {
			$this->flash(
				'Erreur : Il n\'y aucun rôle ' +
				'`site_admin` n\'existe dans la base.',
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
		$this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
    }
	
	/**
	 * Affiche le détail d'un projet.
	 *
	 * @param id {int} Id du projet à consulter
	 */
	public function view($id = null) {
		if(!is_null($id)) {
			/* Récupération du projet d'id id. */
			$this->Project->id = $id;
			$project = $this->Project->read();
			
			/* Recherche des noms de rôles correspondant à chaque user. */
			$this->loadModel('Role');
			$roles = array();
			foreach($project['User'] as &$user) {
				$roleId = $user['ProjectsUser']['role_id'];
				if(!isset($roles[$roleId]))
					$roles[$roleId] = $this->getRoleName($roleId);
				$user['role_name'] = $roles[$roleId];
			}
			
			/* Ai-je des droits sur l'édition ? */
			$isMyBusiness;
			
			/* Récupération de l'utilisateur courant. */
			$this->Project->User->id = $this->Auth->user('id');
            $currentUser = $this->Project->User->read();
			
			/* On récupère l'id de l'admin du projet. */
            $projectAdminId = $this->Project->query(
                'SELECT `ProjectsUser`.user_id
                FROM projects_users AS `ProjectsUser`
                JOIN roles AS `Role`
                ON `ProjectsUser`.role_id = `Role`.id
                AND `ProjectsUser`.project_id = ' . $id . '
                AND `Role`.name = \'project_admin\''
            );
            $projectAdminId = $projectAdminId[0]['ProjectsUser']['user_id'];

            if(
                $currentUser['Role']['name'] == 'site_admin' ||
                $currentUser['User']['id'] == $projectAdminId
            ) {
                $isMyBusiness = true;
            } else {
                $isMyBusiness = false;
            }

			$this->set('project', $project);
			$this->set('isMyBusiness', $isMyBusiness);
		}
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

	/**
	 * Suppression d'un projet à la base.
	 *
	 * @pre		Demande de suppression d'un projet.
	 * @post	Supprime le projet de la base ainsi que l'ensemble des équipes
	 * 			associées.
	 *
	 * @param id {int} Id du projet à supprimer.
	 */
    public function delete($id = null)
    {
		$this->Project->del($id);
		$this->flash('Le projet avec l\'id: ' . $id . ' a été supprimé.', '/projects');
    }

	/**
	 * Modification d'un projet à la base.
	 *
	 * @pre		Demande de modification d'un projet.
	 * @post	Modifie les données relatives à un projet : nom, description,
	 * 			chef de projet, utilisateurs, équipes.
	 *
	 * @param id {int} Id du projet à supprimer.
	 */
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
			$this->loadModel('Role');
			$this->changeProjectAdmin($id, $this->data['Project']['user_id']);
			if($this->Project->save($this->data['Project']))
			{
				$this->flash('Les attributs du projet ont bien été modifiés.', '/projects');
			}
		}
		$this->set('projects', $this->Project->Team->find('list'));
		$this->set('user_id', 3);
    }
	
	/*Gérer les droits
    public function admin()	
    {
		
	}
*/
}