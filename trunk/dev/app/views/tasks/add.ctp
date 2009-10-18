<?php echo $form->create('Task', array('action' => 'add')); ?>
<?php echo $form->input('task_name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden')); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->input('duration'); ?>
<?php echo $cal->showCalendar(); ?>
<?php echo $form->input('creation', array('type'=>'hidden')); ?>
<?php echo $form->input('modified', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>

