<?php 
	echo $form->create('Team', array('action' => 'add')),
	$form->input('name', array('label' => 'Nom')),
	$form->input('description'),
	$form->input(
		'project_id',
		array(
			'type' => 'hidden',
			'value' => $projectId
		)
	),
	$form->end('Ajouter');
?>