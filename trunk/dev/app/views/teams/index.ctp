<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Projet</th>
		<th>Options</th>
    </tr>
    <?php foreach($teams as $team): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $team['Team']['name'],
                            array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])
                        ); ?>
        </td>
        <td><?php echo $team['Team']['description']; ?></td>
        <td><?php echo $team['Project']['name']; ?></td>
	
	<?php if($role == 'site_admin' or $role == 'team_admin'): ?>
		<td>
				<?php echo $html->link(	$html->image('delete.png'),
							array(	'controller'=>'teams',
								'action'=>'delete', 
								$team['Team']['id']),
							array('escape' => false) ); ?>
				<?php echo $html->link(	$html->image('edit.png'),
							array(	'controller'=>'teams',
								'action'=>'edit', 
								$team['Team']['id']),
							array('escape' => false)); ?>
		</td>
		
	<?php elseif($team['isMyTeam']):?> 
			<td><?php echo $html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'teams',
						'action'=>'edit', 
						$team['Team']['id']),
						array('escape' => false)); ?>
			</td>
    <?php else:?>
			<td></td>
<?php endif;?>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $html->link('Ajouter une Equipe', array('controller'=>'teams','action'=>'add')); ?>
