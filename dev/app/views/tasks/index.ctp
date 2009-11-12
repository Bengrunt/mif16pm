<table>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Projet</th>
			<th>Duree</th>
			<th>Option</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($tasks as $task):
?>
		<tr>
			<td><?php 
				echo $html->link(
					$task['Task']['name'],
					array('controller' => 'tasks', 'action' => 'view', $task['Task']['id'])
				);
			?></td>
			<td><?php echo $task['Task']['project_id']; ?></td>
			<td><?php echo $task['Task']['duration']; ?></td>
<?php
		if($role == 'site_admin'):
?>
			<td><?php
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
			?></td>
<?php
		elseif($task['isMyBusiness']):
?> 
			<td><?php
				echo $html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'tasks',
						'action'=>'edit', 
						$task['Task']['id']),
						array('escape' => false
					)
				); 
			?></td>
<?php
		else:
?>
			<td></td>
<?php
		endif;
?>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<p><?php
	echo $html->link(
		'Ajouter une Tache',
		array(
			'controller'=>'tasks',
			'action'=>'add'
		)
	);
?></p>