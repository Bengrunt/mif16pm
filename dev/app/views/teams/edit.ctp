<?php 
	echo $form->create('Team', array('action' => 'edit')),
	$form->input('name', array('label' => 'Nom')),
	$form->input('description'),
	$form->input(
		'project_id',
		array(
			'type' => 'hidden',
			'value' => $projectId
		)
	),
	$form->input('id', array('type'=>'hidden')),
	$form->end('Editer');
?>