<?php echo $form->create('Project', array('action' => 'add')); ?>
<?php echo $form->input('name', array('label'=>'Nom')); ?>
<?php echo $form->input('description', array('label'=>'Description')); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>