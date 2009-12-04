<?php 
	echo $form->create('Project', array('action' => 'edit')),
	$form->input('id', array('type'=>'hidden')),
	$form->input('name' , array('label'=>'Nom')),
	$form->input('description');
?>
<label for="user_id">Chef de Projet</label>
<?php echo $form->select(
	'user_id', 
	$projectUsers, 
	$projectAdminId,
	null,
	false
); ?>

<h2>Equipes</h2>
<table>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($project['Team'] as $team):
?>
		<tr>
			<td><?php
				echo $html->link(
					$team['name'],
					'/teams/view/' . $team['id']
				);
			?></td>
			<td><?php 
				echo $html->link(
					$html->image('delete.png'),
					array(
						'controller'=>'teams',
						'action'=>'delete',
						$team['id']
					),
					array('escape' => false)
				);
			?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<p><?php
	echo $html->link(
		'Ajouter une équipe',
		array(
			'controller'=>'teams',
			'action'=>'add', 
			$project['Project']['id']
		)
	);
?></p>
<h2>Equipiers</h2>
<table>
	<thead>
		<tr>
			<th>Pseudo</th>
			<th>Rôle</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($project['User'] as $user):
?>
		<tr>
			<td><?php echo $html->link($user['name'],'/users/view/'.$user['id']);?></td>
			<td><?php echo $user['role_name']; ?></td>
			<td><?php
				if(!$user['dontRemove']) {
					echo $html->link(
						$html->image('delete.png'),
						array(
							'controller'=>'projects',
							'action'=>'removeUser', 
							$project['Project']['id'],
							$user['id']
						),
						array('escape' => false)
					);
				}
			?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<p><?php
	echo $html->link(
		'Ajouter un équipier',
		array(
			'controller'=>'projects',
			'action'=>'addUser', 
			$project['Project']['id']
		)
	);
?></p>
<?php echo $form->end('Editer'); ?>