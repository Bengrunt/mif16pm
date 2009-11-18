<h1><?php echo $task['Task']['name']; ?></h1>
<h3>Nom Projet</h3>
<?php echo $html->link(
			$task['Project']['name'],
			array('controller'=>'projects', 'action' => 'view', $task['Project']['id']));
?>
<h3>Nom Equipe </h3>
<?php echo $html->link(
			$task['Team']['name'],
			array('controller'=>'teams', 'action' => 'view', $task['Team']['id']));
?>
<h3>Description</h3>
<?php echo $task['Task']['description']; ?>
<h3>Durée</h3>
<?php echo $task['Task']['duration']; ?>
<h3>Date de début</h3>
<?php echo $task['Task']['begin_date']; ?>
