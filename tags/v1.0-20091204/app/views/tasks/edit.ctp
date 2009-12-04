<?php echo $form->create('Task', array('action' => 'edit')); ?>
<?php echo $form->input('name',array('label' => 'Nom de la t&acirc;che')); ?>
<?php echo $form->input('project_id', array('type'=>'hidden')); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->input('description', array('label' => 'Description')); ?>
<?php echo $form->end('Editer'); ?>
