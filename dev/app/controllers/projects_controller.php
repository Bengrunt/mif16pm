<?php

/**
 *
 * @author Benjamin Guillon - bengrunt@gmail.com
 * @see http://code.google.com/p/mif16pm/
 */
class ProjectsController extends AppController
{

	public $name = "Projects";
	
	public function index()
    {
        $this->set('projects', $this->Project->find('all'));
    }

	public function view($id = null)
    {
        $this->Project->id = $id;
        $this->set('project', $this->Project->read());
    }	
	
    public function add()
    {
		if(!empty($this->data))
		{
			/* Ajout du projet à la BDD. */
			$retAddProject = $this->Project->save($this->data);
			
			/* Ajout de l'équipe mère du projet. */
			if($retAddProject) {
				$this->data['Project']['id'] = $this->Project->id;
				
				$retAddTeam = $this->Project->Team->save(Array(
					'name' => 'Equipe ' . $this->data['Project']['name'],
					'description' => 'Equipe du projet [' .
									 $this->data['Project']['id'] . '] "' .
									 $this->data['Project']['name'] . '"',
					'project_id' => $this->data['Project']['id'],
					'team_id' => NULL,
					'user_id' => 0 // TODO: récupérer id utilisateur courant.
				));
				
				/* MàJ du projet avec l'id de l'équipe. */
				if($retAddTeam) {
					$this->data['Project']['team_id'] = $this->Project->Team->id;
				
					$retUpProject = $this->Project->save($this->data);
				}
			}
			
			/* Message de confirmation en cas de succès. */
			if($retAddProject && $retAddTeam && $retUpProject) {
				$this->flash(
					'Le projet a bien été ajouté et sauvegardé.',
					'/projects'
				);
			} else {
				/* 
				   Suppression des entrées créées en cas d'échec lors d'une 
				   étape.
				 */
				if($retAddTeam) {
					$this->Project->Team->del($this->Project->Team->id);
				}
				$this->Project->del($this->Project->id);
				$this->flash(
					'Le projet n\'a pu être créé.',
					'/projects'
				);
			}
		}
    }

    public function delete($id = null)
    {
		$this->Project->del($id);
		$this->flash('Le projet avec l\'id: ' . $id . ' a été supprimé.', '/projects');
    }

    public function edit($id = null)
    {
		$this->set('teams', $this->Project->Team->find('list'));
		if(empty($this->data))
		{
			$this->Project->id = $id; 
			$this->data = $this->Project->read();
		}
		else
		{
			if($this->Project->save($this->data['Project']))
			{
				$this->flash('Les attributs du projet ont bien été modifiés.', '/project');
			}
		}
		$this->set('projects', $this->Project->Team->find('list'));		
    }
	
	/*Gérer les droits
    public function admin()	
    {
		
	}
*/
}