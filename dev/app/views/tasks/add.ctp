<?php echo $form->create('Task', array('action' => 'add')); ?>
<?php echo $form->input('task_name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden', 'value'=>42)); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->input('duration'); ?>
<?php echo "<div type='text' id='datepicker'><input type='text'/></div>" ?>
<?php echo "<input type='button' value='Annuler' onclick='javascript:history.back();'/>" ?>
<?php echo $form->end('Ajouter'); ?>

