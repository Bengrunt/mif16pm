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
	
    public function add()
    {
		if(!empty($this->data))
		{
			/* On cherche l'ID du rôle correspondant à un chef de projet. */
			$this->loadModel('Role');
			$paramsProjectAdmin = array (
				'conditions' => array(
					'Role.name' => 'project_admin'
				),
				'fields' => array('Role.id')
			);
			$resultRole = $this->Role->find('first', $paramsProjectAdmin);
			
			/* Test si un id de rôle a bien été retourné. */
			if(empty($resultRole)) {
				$this->flash(
					'Le projet n\'a pu être créé car aucun rôle ' +
					'`project_admin` n\'existe dans la base.',
					'/projects'
				);
				return;
			}
			$idRoleProjectAdmin = $resultRole['Role']['id'];
			
			
			/* Ajout du projet à la BDD. */
			$retAddProject = $this->Project->save($this->data);
			$retAddProjectAdmin = false;
			$retAddTeam = false;
			$retUpProject = false;
			
			if($retAddProject) {
				$this->data['Project']['id'] = $this->Project->id;
				
				/* 
				 * On ajoute le chef de projet :
				 *  - ID utilisateur courant
				 *  - ID du rôle 'project_admin'
				 */
				$retAddProjectAdmin = $this->Project->ProjectsUser->save(Array(
					'project_id' => $this->Project->id,
					'user_id' => $this->Auth->user('id'),
					'role_id' => $idRoleProjectAdmin
				));
				
				/* Ajout de l'équipe mère du projet. */
				$retAddTeam = $this->Project->Team->save(Array(
					'name' => 'Equipe ' . $this->data['Project']['name'],
					'description' => 'Equipe du projet [' .
									 $this->data['Project']['id'] . '] "' .
									 $this->data['Project']['name'] . '"',
					'project_id' => $this->data['Project']['id'],
					'user_id' => $this->Auth->user('id')
				));
				
				if($retAddTeam) {
					/* On cherche l'ID du rôle correspondant à un chef d'équipe. */
					$paramsTeamAdmin = array (
						'conditions' => array(
							'Role.name' => 'team_admin'
						),
						'fields' => array('Role.id')
					);
					$resultRole = $this->Role->find('first', $paramsTeamAdmin);
					
					/* Test si un id de rôle a bien été retourné. */
					if(empty($resultRole)) {
						$this->flash(
							'Le projet n\'a pu être créé car aucun rôle ' +
							'`team_admin` n\'existe dans la base.',
							'/projects'
						);
						return;
					}
					$idRoleTeamAdmin = $resultRole['Role']['id'];
					
					$retAddTeamAdmin = $this->Project->Team->TeamsUser->save(Array(
						'team_id' => $this->Project->Team->id,
						'user_id' => $this->Auth->user('id'),
						'role_id' => $idRoleTeamAdmin
					));
				
					/* MàJ du projet avec l'id de l'équipe. */	
					$this->data['Project']['team_id'] = $this->Project->Team->id;
				
					$retUpProject = $this->Project->save($this->data);
				}
			}
			
			/* Message de confirmation en cas de succès. */
			if($retAddProject && $retAddTeam && $retUpProject) {
				$this->flash(
					'Le projet a bien été ajouté et sauvegardé.',
					'/projects'
				);
			} else {
				/* 
				   Suppression des entrées créées en cas d'échec lors d'une 
				   étape.
				 */
				if($retAddTeam) {
					$this->Project->Team->del($this->Project->Team->id);
				}
				$this->Project->del($this->Project->id);
				$this->flash(
					'Le projet n\'a pu être créé.',
					'/projects'
				);
			}
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