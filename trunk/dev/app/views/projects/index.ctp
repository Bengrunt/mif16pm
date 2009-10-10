<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Chef de Projet</th>
    </tr>
    <?php foreach($projects as $project): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $project['Project']['name'],
                            array('controller' => 'project', 'action' => 'view', $project['Project']['id'])
                        ); ?>
        </td>
        <td><?php echo $project['Project']['description']; ?></td>
        <td><?php echo $project['Project']['user_id']; ?></td>
		<td>
				<?php echo $html->link(	$html->image('delete.jpg'),
							array(	'controller'=>'projects',
								'action'=>'delete', 
								$project['Project']['id']),
							array('escape' => false) ); ?>
				<?php echo $html->link(	$html->image('edit1.png'),
							array(	'controller'=>'projects',
								'action'=>'edit', 
								$project['Project']['id']),
							array('escape' => false)); ?>
		</td>

    </tr>
    <?php endforeach; ?>
</table>
<?php echo $html->link('Créer un projet', array('controller'=>'projects','action'=>'add')); ?>