<h1><?php echo $project['Project']['name']; ?></h1>
<h2>Description</h2>
<?php echo $project['Project']['description']; ?>
<h2>Equipes</h2>
<table>
	<thead>
		<tr>
			<th>Nom</th>
		</tr>
	</thead>
	<tbody><?php
	foreach($project['Team'] as $team):
?>
		<tr>
			<td><?php echo $html->link($team['name'],'/teams/view/'.$team['id']);?></td>
		</tr><?php
	endforeach;
?>
	</tbody>
</table>
<h2>Equipiers</h2>
<table>
	<thead>
		<tr>
			<th>Pseudo</th>
			<th>Rôle</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($project['User'] as $user):
?>
		<tr>
			<td><?php echo $html->link($user['name'],'/users/view/'.$user['id']);?></td>
			<td><?php echo $user['role_name']; ?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>