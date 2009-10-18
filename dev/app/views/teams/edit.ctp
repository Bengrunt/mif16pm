<?php echo $form->create('Team', array('action' => 'edit')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('project_id'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Editer'); ?>