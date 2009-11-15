<script type="text/javascript">
	$(document).ready(function(){
		$("#TaskBeginDate").datepicker();
		//$("#datepicker").datepicker();
	});
</script>
<?php echo $form->create('Task', array('action' => 'add')); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('project_id', array('type'=>'hidden', 'value'=>42)); ?>
<?php echo $form->input('task_id', array('type'=>'hidden')); ?>
<?php echo $form->input('description'); ?>
<!-- ?php echo $form->input('begin_date', array('label' => 'BeginDate', 'type' => 'text')); ?-->
<?php echo $form->input('begin_date', array('type'=>'hidden', 'value'=>date('MDY'))); ?>
<?php echo $form->input('duration'); ?>
<?php echo "<input type='button' value='Annuler' onclick='javascript:history.back();'/>" ?>
<?php echo $form->end('Ajouter'); ?>

