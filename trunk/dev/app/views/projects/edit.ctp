<?php echo $form->create('Project', array('action' => 'add')); ?>
<?php echo $form->input('nom'); ?>
<?php echo $form->input('description'); ?>
<?php //echo $form->input('team_id'); ?>
<?php echo $form->input(
	'user_id', 
	array(
		'options' => $users, 
		'label' => 'Chef de Projet'
	)
); ?>

<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Editer'); ?>