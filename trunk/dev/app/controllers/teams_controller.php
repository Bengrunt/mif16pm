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
     *
     */
    public function index()
    {
        $this->set('teams', $this->Team->find('all'));
    }

    /**
     *
     */
    public function view($id = null)
    {
        $this->Team->id = $id;
        $this->set('team', $this->Team->read());
    }

    /**
     *
     */
    public function add()
    {
    }

    /**
     *
     */
    public function remove()
    {
    }

    /**
     *
     */
    public function edit()
    {
    }
}
