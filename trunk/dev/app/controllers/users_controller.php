<?php

class UsersController extends AppController
{
    //public $scaffold;

    /**
     *
     */
    public function index()
    {
        // Accès restreint à terme
        $this->set('users', $this->User->find('all'));
    }

    /**
     *
     */
    public function view($id = null)
    {
        $this->User->id = $id;
        $this->set('user', $this->User->read());
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
                $this->flash('Inscription valid&eacute;e', array('controller'=> 'user',
                                            'action'=>'view', $this->User->id));
            }
            else
            {
                $this->flash("echec", null);
            }
        }
    }
}