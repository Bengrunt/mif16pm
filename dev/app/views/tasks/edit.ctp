<?php echo $form->create('Team', array('action' => 'edit')); ?>
<?php echo $form->input('task_name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden')); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->end('Editer'); ?>
