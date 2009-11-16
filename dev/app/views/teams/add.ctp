<?php echo $form->create('Team', array('action' => 'add')); ?>
<?php echo $form->input('nom'); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('id projet'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>
