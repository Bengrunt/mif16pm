<?php echo $form->create('Team', array('action' => 'delete')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('project'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Supprimer'); ?>
