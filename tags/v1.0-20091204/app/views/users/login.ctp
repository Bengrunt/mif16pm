<?php $html->css("users", null, array(), false); ?>

<p class="messages"><?php $session->flash('auth'); ?></p>

<h1>Connectez-vous...</h1>

<div class="login-form">
    <?php
    echo $form->create('User', array('action' => 'login'));
    echo $form->inputs(array(
        'legend' => "",
        'name' => array('label' => "Login"),
        'password' => array('label' => "Mot de passe")));
    ?>
    <button type="submit">
        <?php echo $html->image("icons/connect.png") ?> Se connecter
    </button>
    <?php echo $form->end(); ?>
</div>

<div class="register-link">
    <p>Pas encore inscrit ? Mais qu'attendez-vous pour le faire ? </p>
    <p class="center">
        <form method="get" action="<?php echo $html->url(array("controller" => "users", "action" => "register")); ?>">
            <button type="submit"><?php echo $html->image("icons/arrow_right.png"); ?> Je cours m'inscrire !</button>
        </form>
    </p>
</div>
