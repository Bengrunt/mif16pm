<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Projet</th>
<?php
	if($isSiteAdmin):
?>
		<th>Options Admin</th>
<?php
	endif;
?>
    </tr>
<?php
	foreach($teams as $team):

		if($role == 'site_admin' && $isSiteAdmin):
?>
			<tr>
				<td><?php
					echo $html->link(
						$team['Team']['name'],
						array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])
					);
				?></td>
				<td><?php echo $team['Team']['description']; ?></td>
				<td><?php 
						echo $html->link(
						$team['Project']['name'],
						array('controller'=>'projects', 'action' => 'view', $team['Project']['id'])
						);
				?></td>
				
				<td><?php
					echo $html->link(
						$html->image('delete.png'),
						array(
							'controller'=>'teams',
							'action'=>'delete', 
							$team['Team']['id']
						),
						array('escape' => false)
					),
					$html->link(
						$html->image('edit.png'),
						array(
							'controller'=>'teams',
							'action'=>'edit', 
							$team['Team']['id']
						),
						array('escape' => false)
					);
				?></td>
			</tr>
	<?php
			else:
				foreach($team['User'] as $teamUser):
					
					if($currentUser == $teamUser['id']):
	?>
						<tr>
							<td><?php
								echo $html->link(
									$team['Team']['name'],
									array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])
								);
							?></td>
							<td><?php echo $team['Team']['description']; ?></td>
							<td><?php 
									echo $html->link(
									$team['Project']['name'],
									array('controller'=>'projects', 'action' => 'view', $team['Project']['id'])
									);
							?></td>
						</tr>
	<?php 
					endif;
					
				endforeach;
			endif;
	?>
<?php
	endforeach;
?>
</table>
<p><?php
	/*echo $html->link(
		'Ajouter une Equipe',
		array(
			'controller'=>'teams',
			'action'=>'add'
		)
	); */
?></p> 
