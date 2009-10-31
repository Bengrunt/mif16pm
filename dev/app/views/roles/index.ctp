<table>
    <tr>
        <th>Nom</th>
    </tr>
    <?php foreach($roles as $role): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $role['Role']['name'],
                            array('controller' => 'roles', 'action' => 'view', $role['Role']['id'])
                        ); ?>
        </td>
        <td><?php echo $role['Role']['name']; ?></td>
		<td>
				<?php echo $html->link(	$html->image('delete.png'),
							array(	'controller'=>'roles',
								'action'=>'delete', 
								$role['Role']['id']),
							array('escape' => false) ); ?>
		</td>

    </tr>
    <?php endforeach; ?>
</table>
<?php echo $html->link('Ajouter un Role', array('controller'=>'roles','action'=>'add')); ?>