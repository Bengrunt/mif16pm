<h1>Ajouter un membre à une équipe</h1>

<?php

echo $form->create('Team', array("action" => "add_user/" . $id));
echo $form->label("user_id", "Choisissez un membre");
echo $form->select("user_id", $members);
echo $form->end('Ajouter');

?>

<p><?php echo $html->link("Retour à l'équipe", array("action" => "view", $id)); ?></p>
