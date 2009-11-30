<?php

class UsersController extends AppController
{
    public $name = 'Users';
    //public $scaffold;
    // var $helpers = array('Combobox');

    public function beforeFilter()
    {
        //Configure AuthComponent
        $this->Auth->authorize = 'controller';
        $this->Auth->fields = array(
            'username' => 'name',
            'password' => 'password'
        );
    }

    public function isAuthorized()
    {
        if ( is_null( $this->Auth->user() ) )
        {
            switch ($this->action)
            {
                case 'login':
                case 'register':
                    return true;
            }
        }
        else
        {
            $this->User->id = $this->Auth->user('id');
            $user = $this->User->read();

            // Si on est user_admin, on a tous les droits
            if ($user['Role']['name'] == 'site_admin') {
                return true;
            }

            switch ($this->action)
            {
                case 'edit':
                    // --->
                    // A CORRIGER
                    // Si le paramètre "id" est identique à l'id de l'utilisateur connecté
                    // --->
                    if ( $user['Id'] == $this->Auth->user('id') )
                    {
                        return true;
                    }
                    break;
                case 'view':
                case 'profile':
                case 'logout':
                    return true;
            }
        }
    }

    /**
     *
     */
    public function index()
    {
        $this->User->id = $this->Auth->user('id');
        $user = $this->User->read();

        $this->set('users', $this->User->find('all'));
        $this->set('id', $this->Auth->user('id'));
        $this->set('role', $user['Role']['name']);
    }

    /**
     *
     */
    public function view($id = null)
    {
        $this->User->id = $id;
        $this->set('user', $this->User->read());
    }

    /*
     *
     */
    public function profile()
    {
        $this->redirect(array('action' => 'view', $this->Auth->user('id')));
    }

    /**
     *
     */
    public function login()
    {
    }

    /**
     *
     */
    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    /**
     *
     */
    public function register()
    {
        if ( !empty($this->data) )
        {
            $result = $this->User->save( $this->data );
            if ($result)
            {
                $this->flash("Inscription validée", array('controller' => 'users', 'action' => 'profile'), 3);
            }
            else
            {
                $this->flash("L'inscription a échoué", null, 3);
            }
        }
    }

    public function delete($id = null)
    {
        $this->User->deleteAll(
            array('User.id' => $id),
            false,
            false
        );
        $this->User->ProjectsUser->deleteAll(
            array('ProjectsUser.user_id' => $id),
            false,
            false
        );
        $this->User->TeamsUser->deleteAll(
            array('TeamsUser.user_id' => $id),
            false,
            false
        );
        $this->User->TasksUser->deleteAll(
            array('TasksUser.user_id' => $id),
            false,
            false
        );

        $this->flash('L\'utilisateur ' . $id . ' a été supprimé.', '/users');
    }

    public function edit($id = null) {

        if(empty($this->data))
        {
            $this->User->id = $id;
            $this->data = $this->User->read();
        }
        else
        {
            if($this->User->save($this->data['User']))
            {
                $this->flash('Le profil Utilisateur a été mis à jour ');
            }
        }
    }
}