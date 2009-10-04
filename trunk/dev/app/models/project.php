<?php

/**
 *
 * @author
 */
class Project extends AppModel
{
    public $name = "Project";

    public $hasMany = "Team";
}
