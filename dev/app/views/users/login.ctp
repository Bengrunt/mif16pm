<?php
$session->flash('auth');
echo $form->create('User', array('action' => 'login'));
echo $form->inputs(array(
    'legend' => __('Connexion', true),
    'name',
    'password'));
?>
<small>
<?php
    echo $html->link(
        $html->image("icons/user_silhouette.png") . " S'inscrire",
        array("controller" => "users", "action" => "register"),
        null, null, false);
?>
</small> |
<button type="submit">
    <?php echo $html->image("icons/connect.png") ?> Se connecter
</button>