<?php

class UsersController extends AppController
{
    public $name = 'Users';
    //public $scaffold;
    // var $helpers = array('Combobox');

    private $userRole;

    public function beforeFilter()
    {
        //Configure AuthComponent
        $this->Auth->authorize = 'controller';
        $this->Auth->allow(array("login", "register"));
        $this->Auth->fields = array(
            'username' => 'name',
            'password' => 'password'
        );
    }

    public function isAuthorized()
    {
        $this->User->id = $this->Auth->user('id');
        $user = $this->User->read();
        $this->userRole = $user['Role']['name'];
        $this->set("userRole", $this->userRole);

        $user = $this->Auth->user();
        if ( is_null( $user ) )
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
            // Si on est user_admin, on a tous les droits
            if ($this->userRole == 'site_admin') {
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
        return false;
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

        $this->set("id", $id);

        $this->User->id = $id;
        $this->set('user', $this->User->read());
    }

    /*
     *
     */
    public function profile()
    {
        $this->redirect(array('action' => 'view', $this->Auth->user('id')));
        $this->end();
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
        if ( !is_null( $this->Auth->user() ) )
        {
            $this->redirect("/");
            $this->end();
        }
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
        // Si on est user_admin, on a tous les droits
        if ($id != $this->Auth->user('id') && $this->userRole != 'site_admin')
        {
            $this->redirect("/");
            $this->end();
        }

        $this->set("id", $id);

        if (!$this->User->delete($id))
        {
            $this->flash("L'utilisateur $id n'a pas pu &ecirc;tre supprim&eacute;.", '/users');
        }
        $this->flash("L'utilisateur $id a &eacute;t&eacute; supprim&eacute;.", '/users');
    }

    public function edit($id = null)
    {
        // Si on est user_admin, on a tous les droits
        if ($id != $this->Auth->user('id') && $this->userRole != 'site_admin')
        {
            $this->redirect("/");
            $this->end();
        }

        $this->set("id", $id);

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