<?php 
	echo $form->create('Team', array('action' => 'edit')),
	$form->input('name', array('label' => 'Nom')),
	$form->input('description'),
	$form->input('id', array('type'=>'hidden')),
	$form->end('Editer');
?>