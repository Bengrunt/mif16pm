<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class TeamsController extends AppController
{
    public $name = "Teams";

    /**
     *
     */
    public function index()
    {
        $this->set('teams', $this->Team->find('all'));
		$this->Team->User->id = $this->Auth->user('id');
        $user = $this->Team->User->read();
	
		$teams = $this->Team->find('all');
		
		foreach($teams as &$team) {
			$team['isMyTeam'] = false;
			foreach($team['User'] as $teamUser) {
				if($this->Team->User->id == $teamUser['id']) {
					$team['isMyTeam'] = true;
					break;
				}
			}
		}
		
        $this->set('teams', $teams);
		
		//$this->set('id', $id);
		$this->set('role' , $user['Role']['name']);
    }

    /**
     *
     */
    public function view($id = null)
    {
		if(!is_null($id)) {
			$this->Team->id = $id;
			
			$this->loadModel('Role');
			
			$this->set('teams', $this->Team->find('all'));
			$this->Team->User->id = $this->Auth->user('id');
			$user = $this->Team->User->read();
			
			$teams = $this->Team->find('all');
			
			foreach($teams as &$team) {
				$team['isMyTeamb'] = false;
				foreach($team['User'] as $teamUser) {
					if($this->Team->User->id == $teamUser['id']) {
						$team['isMyTeamb'] = true;
						break;
					}
				}
			}
			
			//$this->set('teamUsers', $teamUsers);
			//$this->set('teamAdmin', $teamAdminResult[0]['User']['name']);
			
			// TODO: optimisation. Jointure ? Une seule requete ? Pb : faire une jointure avec Cake ou sous-requetes sur 3 niveaux...
			// Utiliser uniquements méthodes de Cake... ou centraliser requetes dans le modèle ?
			$teamAdminResult = $this->Team->query(
				'SELECT `name`
				FROM users AS `User`
				WHERE `id` = (
					SELECT user_id FROM teams_users
					WHERE role_id = (
						SELECT id FROM roles
						WHERE name = \'team_admin\'
					) AND team_id = ' . $id  .
				')'
			);
			
			$teamUsers = $this->Team->query(
				'SELECT `User`.id, `User`.name 
				FROM users AS `User`
				JOIN teams_users AS `TeamsUser`
				ON `User`.id = `TeamsUser`.user_id
				WHERE team_id = ' . $id  
			);
			
			$params = array (
				'conditions' => array(
					'team_id' => $id,
					'Role.name' =>  'team_admin'
				),
				'fields' => array('user_id'),
				'joins' => array('Role')
			);
			
		} else {
			// TODO : mettre un message d'erreur et/ou rediriger sur page d'accueil du controlleur
			exit(0);
		}
    }

    /**
     *
     */
    public function add()
    {	
		$this->set('projects', $this->Team->Project->find('list'));
		if (!empty($this->data)) 
		{
			if ($this->Team->save($this->data)) 
			{
				$this->flash('L\'équipe a bien été ajoutée et sauvegardée.', '/teams');
			}
		}
    }

    /**
     *
     */
    public function delete($id = null)
    {
		$this->Team->del($id);
		$this->flash('L\'equipe avec l\'id: '.$id.' a été supprimée.', '/teams');
    }

    /**
     *
     */
    public function edit($id = null)
    {	
		$this->set('projects', $this->Team->Project->find('list'));
		if(empty($this->data))
		{
			$this->Team->id = $id; 
			$this->data = $this->Team->read();
		}
		else
		{
			if($this->Team->save($this->data['Team']))
			{
				$this->flash('La composition de l\'équipe a bien été modifiée.', '/teams');
			}
		}
	}
}
