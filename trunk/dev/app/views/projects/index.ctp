<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Chef de Projet</th>
<?php
	if($isSiteAdmin):
?>
		<th>Options</th>
<?php
	endif;
?>
	</tr>
<?php
	foreach($projects as $project):
?>
    <tr>
        <td><?php
		echo $html->link(
			$project['Project']['name'],
			array(
				'controller' => 'projects',
				'action' => 'view',
				$project['Project']['id']
			)
		);
		?></td>
        <td><?php echo $project['Project']['description']; ?></td>
		<td><?php echo $project['admin']['name'];?></td>
<?php
		if($isSiteAdmin):
?>
		<td><?php 
			echo $html->link(
				$html->image('delete.png'),
				array(
					'controller'=>'projects',
					'action'=>'delete', 
					$project['Project']['id']
				),
				array('escape' => false)
			),
			$html->link(
				$html->image('edit.png'),
				array(
					'controller'=>'projects',
					'action'=>'edit', 
					$project['Project']['id']
				),
				array('escape' => false)
			);
		?></td>
<?php
		endif;
?>
    </tr>
<?php
	endforeach;
?>
</table>
<p><?php
	echo $html->link(
		'Créer un projet',
		array(
			'controller'=>'projects',
			'action'=>'add'
		)
	);
?></p>