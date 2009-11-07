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
	// SELECT p.id, p.name, p.description, u.username
	// FROM users u, projects p, projects_users pu, roles r
	// WHERE u.id = pu.user_id
	// AND p.id = pu.project_id
	// AND r.id = pu.role_id
	// AND r.name = 'project_admin'
		
		$this->set('projects', $this->Project->find('all'));
    }

	public function view($id = null)
    {
        $this->Project->id = $id;
        $this->set('project', $this->Project->read());
		$this->Project->Team->find('first',name);
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
			
			/* Création de l'équipe mère du projet. */
			if(!$this->Project->Team->save(Array(
				'name' => 'Equipe ' . $this->data['Project']['name'],
				'description' => 'Equipe du projet [' .
								 $this->data['Project']['id'] . '] "' .
								 $this->data['Project']['name'] . '"',
				'project_id' => $this->Project->id,
				'user_id' => $this->Auth->user('id')
			))) {
				$this->Project->del($this->Project->id);
				$this->flash(
					'L\'équipe associée au projet n\'a pu être créée.',
					'/projects'
				);
				return;
			}
			
			/* 3 - Association du projet et de l'équipe. -------------------- */
			$this->data['Project']['id'] = $this->Project->id;
			$this->data['Project']['team_id'] = $this->Project->Team->id;
			if(!$this->Project->save($this->data)) {
				$this->Project->Team->del($this->Project->Team->id);
				$this->Project->del($this->Project->id);
				$this->flash(
					'L\'équipe mère n\'a pu être associée au proket.',
					'/projects'
				);
				return;
			}
			
			/* 4 - Association utilisateur comme chef de projet et d'équipe.  */
			/* Association du chef de projet. */
			if(!$this->Project->ProjectsUser->save(Array(
				'project_id' => $this->Project->id,
				'user_id' => $this->Auth->user('id'),
				'role_id' => $idRoleProjectAdmin
			))) {
				$this->Project->Team->del($this->Project->Team->id);
				$this->Project->del($this->Project->id);
				$this->flash(
					'L\'utilisateur courant n\'a pu être associé comme chef ' +
					' de projet.',
					'/projects'
				);
				return;
			}
			
			/* Association du chef d'équipe. */
			if(!$this->Project->Team->TeamsUser->save(Array(
				'team_id' => $this->Project->Team->id,
				'user_id' => $this->Auth->user('id'),
				'role_id' => $idRoleTeamAdmin
			))) {
				$this->Project->Team->del($this->Project->Team->id);
				$this->Project->del($this->Project->id, true);
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