<?php echo $form->create('Task', array('action' => 'add')); ?>
<?php echo $form->input('task_name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden', 'value'=>42)); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->input('duration'); ?>
<?php 
	$cal = new SimpleCalendar();
	$cal->resetDate();
	$cal->showCalendar();
?>
<?php echo $form->end('Ajouter'); ?>

