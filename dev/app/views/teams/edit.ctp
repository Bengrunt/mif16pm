<?php echo $form->create('Team', array('action' => 'edit')); ?>
<?php echo $form->input('Nom'); ?>
<?php echo $form->input('Description'); ?>
<?php echo $form->input('Projet'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Editer'); ?>