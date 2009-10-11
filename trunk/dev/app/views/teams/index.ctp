<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Projet</th>
    </tr>
    <?php foreach($tasks as $task): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $task['Task']['task_name'],
                            array('controller' => 'tasks', 'action' => 'view', $task['Task']['id'])
                        ); ?>
        </td>
        <td><?php echo $task['Task']['description']; ?></td>
        <td><?php echo $task['Project']['task_name']; ?></td>

		<td>
				<?php echo $html->link(	$html->image('delete.png'),
							array(	'controller'=>'tasks',
								'action'=>'delete', 
								$task['Task']['id']),
							array('escape' => false) ); ?>
				<?php echo $html->link(	$html->image('edit.png'),
							array(	'controller'=>'tasks',
								'action'=>'edit', 
								$task['Task']['id']),
							array('escape' => false)); ?>
		</td>

    </tr>
    <?php endforeach; ?>
</table>
<?php echo $html->link('Ajouter une Tâche', array('controller'=>'tasks','action'=>'add')); ?>
