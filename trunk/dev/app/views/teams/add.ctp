<?php echo $form->create('Team', array('action' => 'add')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('Project'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>
