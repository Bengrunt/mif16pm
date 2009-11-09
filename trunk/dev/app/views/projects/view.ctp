<h1><?php echo $project['Project']['name']; ?></h1>
<h2>Description</h2>
<?php echo $project['Project']['description']; ?>
<h2>Teams</h2>
<table>
	<thead>
		<tr>
			<th>Name</th>
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
<h2>Users</h2>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th> Role</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($project['User'] as $user):
?>
		<tr>
			<td><?php echo $html->link($user['name'],'/users/view/'.$user['id']);?></td>
			<td><?php echo $user['role_name']; ?></td>
		</tr><?php
	endforeach;
?>
	</tbody>
</table>