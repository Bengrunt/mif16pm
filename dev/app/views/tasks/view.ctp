<h1><?php echo $task['Task']['name']; ?></h1>
<h2>Nom Projet</h2>
<?php echo $html->link(
			$task['Project']['name'],
			array('controller'=>'projects', 'action' => 'view', $task['Project']['id']));
?>
<h2>Nom Equipe </h2>
<?php echo $html->link(
			$task['Team']['name'],
			array('controller'=>'teams', 'action' => 'view', $task['Team']['id']));
?>
<h2>Description</h2>
<?php echo $task['Task']['description']; ?>
<h2>Durée</h2>
<?php echo $task['Task']['duration']; ?> jour(s)
<h2>Date de début</h2>
<?php echo $task['Task']['begin_date']; ?>
<?php if($isSiteAdmin):
	
			echo $html->link(
					$html->image('delete.png'),
					array(
						'controller'=>'tasks',
						'action'=>'delete', 
						$task['Task']['id']
					),
					array('escape' => false)
				),
				$html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'tasks',
						'action'=>'edit', 
						$task['Task']['id']
					),
					array('escape' => false)
				);
				
		elseif($isMyBusiness):
		
			echo $html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'tasks',
						'action'=>'edit', 
						$task['Task']['id']
					),
					array('escape' => false)
				);
				
		endif; ?>