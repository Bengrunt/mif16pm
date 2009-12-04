<?php echo $form->create('Task', array('action' => 'delete')); ?>
<?php echo $form->input('task_name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden')); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->end('Supprimer'); ?>
