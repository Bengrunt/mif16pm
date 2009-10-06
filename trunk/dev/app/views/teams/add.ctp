<echo $form->create('Team', array('action' => 'add')); ?>
<?php echo $form->input('Nom'); ?>
<?php echo $form->input('Decription'); ?>
<?php echo $form->input('Projet'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>
