<h1>Connectez-vous...</h1>

<?php
$session->flash('auth');
echo $form->create('User', array('controller' => 'users', 'action' => 'login'));
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
<?php echo $form->end(); ?>
</div>

<p>Pas encore inscrit ? Mais qu'attendez-vous pour le faire ? </p>
<p class="center">
<?php echo $html->link(
            $html->image("icons/arrow_right.png")
            . " Je cours m'inscrire !",
            array("controller" => "users", "action" => "register"),
            null, null, false
        ); ?>
</p>