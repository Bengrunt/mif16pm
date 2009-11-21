<?php echo $form->create('Team', array('action' => 'add')); ?>
<?php echo $form->input('name', array('label' => 'Nom')); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('projet_id', array('label' => 'Id Projet')); ?>
<?php echo $form->end('Ajouter'); ?>
