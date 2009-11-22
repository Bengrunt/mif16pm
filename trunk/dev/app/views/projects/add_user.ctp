<h1>Ajout d'un équiper</h1>
<?php
	echo $form->create('Project', array('action' => 'addUser')),
	$form->input(
		'project_id',
		array(
			'type' => 'hidden',
			'value' => $projectId
		)
	),
	$form->input(
		'user_id', 
		array(
			'options' => $users,
			'label' => 'Equipier'
		)
	),
	$form->end('Ajouter');
?>