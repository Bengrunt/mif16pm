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
     *
     */
    public function index()
    {
		$idRoleSiteAdmin = -1; /*< Id du rôle d'admin de l'application. */
        $this->set('teams', $this->Team->find('all'));
        $this->Team->User->id = $this->Auth->user('id');
        $user = $this->Team->User->read();
		$this->loadModel('Role');

        $teams = $this->Team->find('all');
		$idRoleSiteAdmin = $this->getRoleId('site_admin');
		
		if($idRoleSiteAdmin == -1) {
			$this->flash(
				'Erreur : Il n\'y aucun rôle ' +
				'`site_admin` n\'existe dans la base.',
				'/projects'
			);
			return;
		}

        foreach($teams as &$team) {
            $team['isMyTeam'] = false;
            foreach($team['User'] as $teamUser) {
                if($this->Team->User->id == $teamUser['id']) {
                    $team['isMyTeam'] = true;
                    break;
                }
            }
        }

        /*$teamViewTeam = $this->Team->query(
                'SELECT `name`
                FROM users AS `User` u
                WHERE `id` = (
                    SELECT user_id FROM teams_users t
                    WHERE t.user_id = u.id'

            ); */

        $this->set('teams', $teams);
        //$this->set('id', $id);
        $this->set('role' , $user['Role']['name']);
		$this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
    }

    /**
     *
     */
    public function view($id = null)
    {
        if(!is_null($id)) {
            // TODO: optimisation. Jointure ? Une seule requete ? Pb : faire une jointure avec Cake ou sous-requetes sur 3 niveaux...
            // Utiliser uniquements méthodes de Cake... ou centraliser requetes dans le modèle ?
            $teamAdminResult = $this->Team->query(
                'SELECT `id`, `name`
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
                'SELECT `User`.id, `User`.name, `Role`.name
                FROM users AS `User`
                JOIN teams_users AS `TeamsUser`
                ON `User`.id = `TeamsUser`.user_id
                JOIN roles AS `Role`
                ON `Role`.id = `TeamsUser`.role_id
                WHERE team_id = ' . $id
            );

            $this->Team->id = $id;
            $team = $this->Team->read();

            $projectId = $team['Project']['id'];

            $projectAdminId = $this->Team->query(
                'SELECT `ProjectsUser`.user_id
                FROM projects_users AS `ProjectsUser`
                JOIN roles AS `Role`
                ON `ProjectsUser`.role_id = `Role`.id
                AND `ProjectsUser`.project_id = ' . $projectId . '
                AND `Role`.name = \'project_admin\''
            );
            $projectAdminId = $projectAdminId[0]['ProjectsUser']['user_id'];

            $this->Team->User->id = $this->Auth->user('id');
            $user = $this->Team->User->read();

            //echo '<pre>';
            //var_dump($teamAdminResult);
            //echo '</pre>';
            //exit(0);

            $isMyBusiness;
            if(
                $user['Role']['name'] == 'site_admin' ||
                $user['User']['id'] == $projectAdminId ||
                $user['User']['id'] == $teamAdminResult[0]['User']['id']
            ) {
                $isMyBusiness = true;
            } else {
                $isMyBusiness = false;
            }

            // Passage des informations à la vue.
            $this->set('team', $team);
            $this->set('teamUsers', $teamUsers);
            $this->set('teamAdmin', $teamAdminResult[0]['User']['name']);
            $this->set('isMyBusiness', $isMyBusiness);
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
            /***********************************************************
             *
             * ATTENTION
             *
             * Code modifié par Adrian
             * Code original :
             *if ($this->Team->save($this->data) && $this->Team->User->($this->data))
             *
             * Merci de valider cette modification en supprimant ce commentaire
             *
             **********************************************************/
            if ($this->Team->save($this->data) && $this->Team->User->save($this->data))
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
