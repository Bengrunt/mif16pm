<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 */
class AppController extends Controller
{
    public $components = array('Auth');

    function beforeFilter()
    {
		$this->layout = "patate";
	
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'page');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'profile');
    }
}

