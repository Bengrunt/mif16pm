
<?php echo $form->create('User', array('action' => 'edit')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('password'); ?>
<?php echo $form->input('firstname'); ?>
<?php echo $form->input('lastname'); ?>
<?php echo $form->end('Modifier'); ?>