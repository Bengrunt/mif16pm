<h1><?php echo $team['Team']['name']; ?></h1>
<h2>Description</h2>
<?php echo $team['Team']['description']; ?>
<h2>Chef d'équipe</h2>
<?php echo $html->link(
		$teamAdmin['name'],
		array(
			'controller' => 'users',
			'action' => 'view',
			$teamAdmin['id']
		)
	);
?>
<h2>Projet</h2>
<?php
	echo $html->link(
		$team['Project']['name'],
		array(
			'controller' => 'projects',
			'action' => 'view',
			$team['Project']['id']
		)
	);
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
	if($isMyBusiness) {
		echo $html->link(
			$html->image('edit.png') . ' Editer',
			array(
				'controller' => 'teams',
				'action' => 'edit',
				$team['Team']['id']
			),
			array('escape' => false)
		),
		$html->link(
			$html->image('delete.png') . 'Supprimer',
			array(
				'controller' => 'teams',
				'action' => 'delete',
				$team['Team']['id']
			),
			array('escape' => false)
		);
	} else if($isTeamAdmin) {
		echo $html->link(
			$html->image('edit.png') . ' Editer',
			array(
				'controller' => 'teams',
				'action' => 'edit',
				$team['Team']['id']
			),
			array('escape' => false)
		);
	}	
?></p>