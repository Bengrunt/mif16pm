<?php echo $form->create('Role', array('action' => 'add')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>
