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
     * @pre     Nécessite une instantiation du modèle Role.
     * @post    Id du rôle correspondant retourné.
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

        //echo '<pre>', var_dump($teams) ,'</pre>';

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
        $this->set('currentUser', $this->Auth->user("id"));
        $this->set('isSiteAdmin', $idRoleSiteAdmin == $this->Auth->user("role_id"));
    }

    /**
     *
     */
    public function view($id = null)
    {
        if(!is_null($id)) {
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

            $this->set('teams', $this->Team->find('all'));
            $this->Team->User->id = $this->Auth->user('id');
            $user = $this->Team->User->read();

            // Récupération du rôle project_admin et du team_admin
            $this->loadModel('Role');
            $teams = $this->Team->find('all');

            $projectId = $team['Project']['id'];

            // On récupère l'id de l'admin du projet
            $projectAdminId = $this->Team->query(
                'SELECT `ProjectsUser`.user_id
                FROM projects_users AS `ProjectsUser`
                JOIN roles AS `Role`
                ON `ProjectsUser`.role_id = `Role`.id
                AND `ProjectsUser`.project_id = ' . $projectId . '
                AND `Role`.name = \'project_admin\''
            );
            $projectAdminId = $projectAdminId[0]['ProjectsUser']['user_id'];

            $isMyBusiness;

            if(
                $user['Role']['name'] == 'site_admin' ||
                $user['User']['id'] == $projectAdminId
            ) {
                $isMyBusiness = true;
            } else {
                $isMyBusiness = false;
            }

            // On récupère l'id de l'utilisateur courant qui a le statut de team_admin
            $isTeamAdmin = $teamAdminResult[0]['User']['id'] == $this->Auth->user("id");

            // Passage des informations à la vue.
            $this->set('team', $team);
            $this->set('teams', $teams);
            $this->set('role' , $user['Role']['name']);
            $this->set('isTeamAdmin', $isTeamAdmin);
            $this->set('teamUsers', $teamUsers);
            $this->set(
                'teamAdmin',
                array(
                    'id' => $teamAdminResult[0]['User']['id'],
                    'name' => $teamAdminResult[0]['User']['name']
                )
            );
            $this->set('isMyBusiness', $isMyBusiness);
        } else {
            // TODO : mettre un message d'erreur et/ou rediriger sur page d'accueil du controlleur
            exit(0);
        }
    }

    /**
     *
     */
    public function add($projectId = null) {
        if($projectId != null) {
            $this->set('projectId', $projectId);
        }
        if (!empty($this->data)) {

            //echo '<pre>', var_dump($this->data),'</pre>';
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
        $this->Team->deleteAll(
            array('Team.id' => $id),
            false,
            false
        );
        $this->Team->Task->deleteAll(
            array('Task.team_id' => $id),
            false,
            false
        );
        $this->Team->TeamsUser->deleteAll(
            array('TeamsUser.team_id' => $id),
            false,
            false
        );
        $this->flash('L\'équipe ' . $id . ' a été supprimée.', '/teams');
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

    public function add_user($id = null)
    {
        if ( is_null( $id ) )
        {
            $this->redirect(array("action" => "index"));
            $this->end();
        }

        $this->set("id", $id);
        $this->Team->id = $id;

        if (!empty($this->data))
        {
            //echo "<pre>",var_dump($this->data),"</pre>";
            $user_id = intval($this->data['Team']['user_id']);
            $role_id = 4;
            $query = "INSERT INTO teams_users VALUES($id, $user_id, $role_id)";
            if($this->Team->query($query))
            {
                $this->flash('La composition de l\'équipe a bien été modifiée.', '/teams');
            }
        }

        $this->Team->Project->id = $this->Team->read("project_id");
        $usersListProject = $this->Team->Project->find();
        $usersListTeamData = $this->Team->find();

        $userListTeam = array();
        foreach ($usersListTeamData['User'] as $user)
        {
            $userListTeam[] = $user['id'];
        }

        $members = array();
        foreach ($usersListProject['User'] as $user)
        {
            if (!in_array($user['id'], $userListTeam))
            {
                $members[ $user['id'] ] = $user['name'];
            }
        }
        $this->set("members", $members);
    }
}
