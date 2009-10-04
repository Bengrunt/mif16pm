<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
    </tr>
    <?php foreach($teams as $team): ?>
    <tr>
        <td>
            <?php echo $html->link(
                            $team['Team']['name'],
                            array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])
                        ); ?>
        </td>
        <td><?php echo $team['Team']['description']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>