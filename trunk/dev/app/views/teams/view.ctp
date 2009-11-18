<h1><?php echo $team['Team']['name']; ?></h1>
<h2>Description</h2>
<?php echo $team['Team']['description']; ?>
<h2>Chef d'équipe</h2>
<?php echo $teamAdmin;?>
<h2>Projet</h2>
<?php echo $html->link(
			$team['Project']['name'],
			array('controller'=>'projects', 'action' => 'view', $team['Project']['id']));
?>
<h2>Equipiers</h2>
<table>
	<thead>
		<tr>
			<th>Pseudo</th>
			<th>Rôle</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($teamUsers as $user):
?>
		<tr>
			<td><?php
				echo $html->link(
					$user['User']['name'],
					array(
						'controller' => 'users',
						'action' => 'view',
						$user['User']['id']
					)
				);
			?></td>
			<td><?php echo $user['Role']['name'];?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<p><?php
	if($isMyBusiness || $isProjectAdmin) {
		echo $html->link(
			$html->image('edit.png') . ' Editer',
			array(
				'controller' => 'team',
				'action' => 'edit',
				$team['Team']['id']
			),
			array('escape' => false)
		),
		$html->link(
			$html->image('delete.png') . 'Supprimer',
			array(
				'controller' => 'team',
				'action' => 'delete',
				$team['Team']['id']
			),
			array('escape' => false)
		);
	}
	
	elseif($role = 'team_admin' && $isTeamAdmin) {
		echo $html->link(
			$html->image('edit.png') . ' Editer',
			array(
				'controller' => 'team',
				'action' => 'edit',
				$team['Team']['id']
			),
			array('escape' => false)
		);
	}	
?></p>