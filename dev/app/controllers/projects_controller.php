<?php

class ProjectsController extends AppController
{

	public $name = "Project";
	
	public function index()
    {
        $this->set('project', $this->Project->find('all'));
    }

	public function view($id = null)
    {
        $this->Project->id = $id;
        $this->set('project', $this->Project->read());
    }	
	
    public function add()
    {
    }

    public function delete()
    {
    }

    public function edit()
    {
    }
	
	//Gérer les droits
    public function admin()	
    {
    }
	
	
}