<?php echo $form->create('Project', array('action' => 'add')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('description'); ?>
<?php //echo $form->input('user_id'); ?>
<?php echo $combobox->create('user_id', '/users/autoComplete', array('comboboxTitle' => "Choose User")) ?>
<?php echo $form->input('id', array('type'=>'hidden')); ?>
<?php echo $form->end('Ajouter'); ?>