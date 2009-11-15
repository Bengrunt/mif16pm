<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?></title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

        <?php echo $html->css(array("reset", "960", "global", "main")); ?>

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

                    <?php $session->read("Auth.User.name");// { ?>
                        <p>Bienvenue, <strong><?php echo $session->read("Auth.User.name"); ?></strong> !</p>
                        <p><?php echo $html->link("Se déconnecter", array("controller" => "user", "action" => "logout")); ?></p>


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
                    <a href="<?php echo $html->url( array( "controller" => "projects" ) ); ?>">
                        <?php echo $html->image("menu/project.png"); ?>
                        <span>Projets</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="<?php echo $html->url( array( "controller" => "teams" ) ); ?>">
                        <?php echo $html->image("menu/team.png"); ?>
                        <span>&Eacute;quipes</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="<?php echo $html->url( array( "controller" => "tasks" ) ); ?>">
                        <?php echo $html->image("menu/task.png"); ?>
                        <span>T&acirc;ches</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="#<?php //echo $html->url( array( "controller" => "planning" ) ); ?>" class="disable">
                        <?php echo $html->image("menu/planning.png"); ?>
                        <span>Planning</span>
                    </a>
                </li>
                <li class="grid_2">
                    <a href="#<?php //echo $html->url( array( "controller" => "about" ) ); ?>" class="disable">
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
                    <h3>Try it for free!</h3>
                    <p>
                        PROUT is absolutely free for everyone.
                        Just register, create a new project and enjoy!
                    </p>
                </div>
                <div class="grid_4">
                    <h3>Contact us</h3>
                    <p>
                        Feel free to tell us everything you want about
                        PROUT.
                    </p>
                </div>
                <div class="grid_4">
                    <h3>Who are we?</h3>
                    <p>
                        Except for Manu, we are all normal guys,
                        students in computer science. We love coding,
                        girls and beers. We hate Windows. \o/
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>