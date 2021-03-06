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
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'profile');
    }
}

