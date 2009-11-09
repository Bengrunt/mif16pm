<h1><?php echo $project['Project']['name']; ?></h1>
<h2>Description</h2>
<?php echo $project['Project']['description']; ?>
<h2>Teams</h2>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody><?php
	foreach($project['Team'] as $team):
?>
		<tr>
			<td><?php echo $team['id']; ?></td>
			<td><?php echo $team['name']; ?></td>
		</tr><?php
	endforeach;
?>
	</tbody>
</table>
<h2>Users</h2>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Role</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($project['User'] as $user):
?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['role_name']; ?></td>
		</tr><?php
	endforeach;
?>
	</tbody>
</table>