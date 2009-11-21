<table>
    <tr>
        <th>Identifiant</th>
        <th>Pseudo</th>
        <th>Rôle</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Date d'inscription</th>
        <th>Date dernière modif</th>
        <th>Options Admin</th>
    </tr>
		<?php foreach($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td><?php echo $html->link(
							$user['User']['name'], array('controller'=>'users',
							'action'=>'view',
							$user['User']['id']));
						?></td>
				<td><?php echo $user['Role']['name']; ?></td>
				<td><?php echo $user['User']['firstname']; ?></td>
				<td><?php echo $user['User']['lastname']; ?></td>
				<td><?php echo $user['User']['created']; ?></td>
				<td><?php echo $user['User']['modified']; ?></td>
				<td>
					<?php if ($role == 'site_admin'): ?>
						<?php echo $html->link( $html->image('delete.png'),
										array('controller'=>'users',
											'action'=>'delete',
											$user['User']['id']),
										array('escape' => false) ); ?>
					<?php endif; ?>
					
				</td>
				<td>
					<?php if ($role != 'site_admin'): ?>
						<?php if ($user['User']['id'] == $id): ?>
							<?php echo $html->link( $html->image('edit.png'),
									array('controller'=>'users',
										'action'=>'edit',
										$user['User']['id']),
									array('escape' => false) ); ?>
						<?php endif; ?>
					<?php else : ?>
						<?php echo $html->link( $html->image('edit.png'),
									array('controller'=>'users',
										'action'=>'edit',
										$user['User']['id']),
									array('escape' => false) ); ?>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</table>

<p>
    <?php echo $html->link("S'incrire", array("action" => "register")); ?>
</p>