<?php

/**
 *
 * @author Adrian Gaudebert - adrian@gaudebert.fr
 * @author Emmanuel Halter
 */
class Team extends AppModel
{
    public $name = "Team";

    public $hasAndBelongsToMany = 'User';
}
