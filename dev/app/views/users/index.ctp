<table>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Role</th>
        <th>Pr&eacute;nom</th>
        <th>Nom</th>
        <th>Date d'inscription</th>
        <th>Date derni&egrave;re modif</th>
        <th>Options</th>
    </tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['id']; ?></td>
            <td><?php echo $html->link(
                        $user['User']['username'], array(  'controller'=>'users',
                        'action'=>'view',
                        $user['User']['id']));
                    ?></td>
            <td><?php echo $user['Role']['name']; ?></td>
            <td><?php echo $user['User']['firstname']; ?></td>
            <td><?php echo $user['User']['lastname']; ?></td>
            <td><?php echo $user['User']['created']; ?></td>
            <td><?php echo $user['User']['modified']; ?></td>
            <td>
                <?php echo $html->link( $html->image('icone_effacer.png'),
                            array(  'controller'=>'users',
                                'action'=>'delete',
                                $user['User']['id']),
                            array('escape' => false) ); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p>
    <?php echo $html->link("S'incrire", array("action" => "register")); ?>
</p>