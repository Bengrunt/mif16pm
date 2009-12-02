<?php
if ($id == $session->read('Auth.User.id')) {
?>
    <h1>Modifier votre profil</h1>
<?php
}
else {
?>
    <h1>Modifier un profil</h1>
<?php
}
?>

<?php echo $form->create('User', array('action' => 'edit')); ?>
<?php echo $form->input('name', array("label" => "Login")); ?>
<?php echo $form->input('password', array("label" => "Mot de passe")); ?>
<?php echo $form->input('firstname', array("label" => "Pr&eacute;nom")); ?>
<?php echo $form->input('lastname', array("label" => "Nom")); ?>
<?php echo $form->end('Modifier'); ?>
