<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Chef de Projet</th>
		<th>Options</th>
    </tr>
    <?php foreach($projects as $project): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $project['Project']['name'],
                            array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])
                        ); ?>
        </td>
        <td><?php echo $project['Project']['description']; ?></td>
		<td><?php echo $project['User'][0]['username'];?></td>
		<td>
				<?php echo $html->link(	$html->image('delete.png'),
							array(	'controller'=>'projects',
								'action'=>'delete', 
								$project['Project']['id']),
							array('escape' => false) ); ?>
				<?php echo $html->link(	$html->image('edit.png'),
							array(	'controller'=>'projects',
								'action'=>'edit', 
								$project['Project']['id']),
							array('escape' => false)); ?>
		</td>

    </tr>
    <?php endforeach; ?>
</table>
<?php echo $html->link('Créer un projet', array('controller'=>'projects','action'=>'add')); ?>
