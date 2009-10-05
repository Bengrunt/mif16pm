<?php

class UsersController extends AppController
{
    public $scaffold;

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('*');
    }

    public function index()
    {
    }

    public function login()
    {
    }

    public function logout()
    {
    }
	
}