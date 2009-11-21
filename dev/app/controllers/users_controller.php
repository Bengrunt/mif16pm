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
        $this->Auth->allow('register', 'login');
		$this->Auth->fields = array(
			'username' => 'name',
			'password' => 'password'
		);
    }

    public function isAuthorized()
    {
        $return = true;
        $this->User->id = $this->Auth->user('id');
        $user = $this->User->read();
        switch ($this->action)
        {
            case 'index':
				break;
            case 'delete':
                if ($user['Role']['name'] != 'site_admin') {
                    $return = false;
                }
                break;
			case 'edit':
				if ($user['Role']['name'] != 'site_admin') {
                    if($user['Id'] != $this->Auth->user('id')) {
						$return = false;
					}
                }
                break;
        }
        return $return;
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
                $this->flash('Inscription validée', array('action'=>'view', $this->User->id));
            }
            else
            {
                $this->flash("echec", null);
            }
        }
    }

    public function delete()
    {
        $this->redirect(array('controller' => 'users', 'action' => 'index'));
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