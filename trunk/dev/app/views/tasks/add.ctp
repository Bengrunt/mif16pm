<script type="text/javascript">
	$(document).ready(function(){
		$("#TaskBeginDate").datepicker();
		//$("#datepicker").datepicker();
	});
</script>
<?php echo $form->create('Task', array('action' => 'add')); ?>
<?php echo $form->input('name', array('label' => 'Nom')); ?>

<!--?php echo $form->input('project_id', array('label' => 'Projet','value' => $projects)); ?-->
<?php echo $form->input('project_id', array('value' => 3)); ?>
<!--?php echo $form->input('team_id', array('label' => 'Equipe','value' => $teams)); ?-->
<?php echo $form->input('team_id', array('value' => 2)); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('duration', array('label' => 'Durée')); ?>
<!----?php echo $form->input('begin_date', array('label' => 'Date de Début', 'type' => 'text')); ?---->
<?php echo $form->input('begin_date'); ?>
<!--?php echo "<input type='button' value='Annuler' onclick='javascript:history.back();'/>" ?-->
<?php echo $form->end('Ajouter'); ?>

