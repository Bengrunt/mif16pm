<?php echo $form->create('Project', array('action' => 'add')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('description'); ?>
<?php //echo $form->input('team_id'); ?>
<?php echo $form->input(
	'user_id', 
	array(
		'options' => $users, 
		'label' => 'Project Admin'
	)
); ?>

<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Editer'); ?>