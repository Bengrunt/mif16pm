<ul>
    <li>Nom : <?php echo $team['Team']['name']; ?></li>
    <li>Description : <?php echo $team['Team']['description']; ?></li>
    <li>Chef : <?php echo $teamAdmin ?></li>
    <li>Projet : <?php echo $team['Project']['name']; ?></li>
	<li>Membres :
		<ul>
	<?php foreach($teamUsers as $teamUser): ?>
	<li><?php
		echo $html->link(
			$teamUser['User']['name'],
			array('controller' => 'users', 'action' => 'view', $teamUser['User']['id'])
		);
	?>
	
	<?php elseif($teamUser['isMyTeamb'] and $role == 'team_admin'):?> 
			<td>
				<?php echo $html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'teams',
						'action'=>'edit', 
						$teamUser['User']['id']),
						array('escape' => false)); ?>
				<?php echo $html->link(	$html->image('delete.png'),
							array(	'controller'=>'teams',
								'action'=>'delete', 
								$teamUser['User']['id']),
							array('escape' => false) ); ?>
			</td>
			
	<?php elseif($team['isMyTeamb']):?> 
			<td><?php echo $html->link(
					$html->image('edit.png'),
					array(
						'controller'=>'teams',
						'action'=>'edit', 
						$teamUser['User']['id']),
						array('escape' => false)); ?>
			</td>
	<?php endforeach;?>
	    </li>
		</ul>
	</li>
</ul>