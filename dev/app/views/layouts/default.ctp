<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->css(array("reset", "960", "global", "main")); ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?></title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

        <!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />

        <script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.datepicker.js"></script>-->

        <?php echo $scripts_for_layout ?>
    </head>
    <body>
        <div class="container_12">
            <div class="grid_8">
                <div id="logo"><?php echo $html->link("", "/"); ?></div>
            </div>
            <div class="grid_4">
                <div id="user-info">
                    <div class="user-info-content">

                    <?php
                    $username = $session->read( "Auth.User.name" );
                    if ( !empty( $username ) ) { ?>
                        <p>Bienvenue, <strong><?php echo $html->link($username, array("controller" => "users", "action" => "profile")); ?></strong> !</p>
                        <p><small>
                            <?php
                                echo $html->link(
                                    $html->image("icons/user.png") . " Profil",
                                    array("controller" => "users", "action" => "profile"),
                                    null, null, false);
                            ?>
                            -
                            <?php
                                echo $html->link(
                                    $html->image("icons/disconnect.png") . " Se d&eacute;connecter",
                                    array("controller" => "users", "action" => "logout"),
                                    null, null, false);
                            ?>
                        </small></p>
                    <?php } else {
                        echo $form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
                        echo $form->inputs(array(
                            'legend' => __('Connexion', true),
                            'name',
                            'password'));
                    ?><small><?php
                        echo $html->link(
                            $html->image("icons/user_silhouette.png") . " S'inscrire",
                            array("controller" => "users", "action" => "register"),
                            null, null, false);
                    ?></small> |
                        <button type="submit">
                            <?php echo $html->image("icons/connect.png") ?> Se connecter
                        </button>
                        <?php echo $form->end(); } ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <ul id="menu">
                <li class="grid_2">
                    <a href="<?php echo $html->url( "/" ); ?>">
                        <?php echo $html->image("menu/home.png"); ?>
                        <span>Accueil</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="<?php echo $html->url( array( "controller" => "projects", "action" => "index" ) ); ?>">
                        <?php echo $html->image("menu/project.png"); ?>
                        <span>Projets</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="<?php echo $html->url( array( "controller" => "teams", "action" => "index" ) ); ?>">
                        <?php echo $html->image("menu/team.png"); ?>
                        <span>&Eacute;quipes</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="<?php echo $html->url( array( "controller" => "tasks", "action" => "index" ) ); ?>">
                        <?php echo $html->image("menu/task.png"); ?>
                        <span>T&acirc;ches</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="#<?php //echo $html->url( array( "controller" => "planning", "action" => "index" ) ); ?>" class="disable">
                        <?php echo $html->image("menu/planning.png"); ?>
                        <span>Planning</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="#<?php //echo $html->url( array( "controller" => "about", "action" => "index" ) ); ?>" class="disable">
                        <?php echo $html->image("menu/about.png"); ?>
                        <span>&Agrave; propos</span>
                    </a>
                </li>
            </ul>

            <div class="clear"></div>

            <!--<div class="grid_3">
                <div id="nav">
                    <h2>Projets</h2>
                    <ul>
                        <li><a href="#">Créer un projet</a></li>
                        <li><a href="#">Créer un projet</a></li>
                    </ul>
                    <h2>Projets</h2>
                    <ul>
                        <li><a href="#">Créer un projet</a></li>
                        <li><a href="#">Créer un projet</a></li>
                    </ul>
                    <h2>Projets</h2>
                    <ul>
                        <li><a href="#">Créer un projet</a></li>
                        <li><a href="#">Créer un projet</a></li>
                    </ul>
                </div>
            </div>-->

            <!--<div id="content" class="grid_9">-->
            <div id="content" class="grid_12">
                <p>
                    <?php echo $content_for_layout; ?>
                </p>
            </div>

            <div class="clear"></div>

        </div>

        <div id="footer">
            <div class="container_12">
                <div class="grid_4">
                    <h3>Qui sommes-nous ?</h3>
                    <p>
                        Manu mis à part, nous sommes tous des mecs
                        normaux, étudiants en informatique. Nous aimons
                        coder, les filles et la bière. Nous détestons
                        Windows. \o/
                    </p>
                </div>
                <div class="grid_4">
                    <h3>Essayez-le gratuitement !</h3>
                    <p>
                        PROUT est totalement gratuit. Enregistrez-vous,
                        cr&eacute;ez un projet et profitez !
                    </p>
                </div>
                <div class="grid_4">
                    <h3>Contactez-nous</h3>
                    <p>
                        N'hésitez pas à nous dire tout ce que vous
                        voulez à propos de PROUT.
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>