<ul>
    <li>Nom : <?php echo $team['Team']['name']; ?></li>
    <li>Description : <?php echo $team['Team']['description']; ?></li>
    <li>Chef : <?php echo $teamAdmin ?></li>
    <li>Projet : <?php echo $team['Project']['name']; ?></li>
	<li>Membres :
		<ul>
	<?php foreach($teamUsers as $teamUser): ?>
	<li><?php
		echo $html->link(
			$teamUser['User']['name'],
			array('controller' => 'users', 'action' => 'view', $teamUser['User']['id'])
		);
	?></li>
	<?php endforeach;?>
		</ul>
	</li>
</ul>