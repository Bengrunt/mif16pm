<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title_for_layout; ?></title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/cake.generic.css" type="text/css" />

        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />

        <?php echo $html->css(array("reset", "global", "main")); ?>

        <script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.datepicker.js"></script>

        <?php echo $scripts_for_layout ?>
    </head>
    <body>

        <div id="header">
            <div id="logo">PROUT</div>
            <ul id="menu">
                <li><?php echo $html->link("Users", array("controller" => "users", "action" => "index")); ?></li>
                <li><?php echo $html->link("Teams", array("controller" => "teams", "action" => "index")); ?></li>
                <li><?php echo $html->link("Projects", array("controller" => "projects", "action" => "index")); ?></li>
                <li><?php echo $html->link("Roles", array("controller" => "roles", "action" => "index")); ?></li>
                <li><?php echo $html->link("Tasks", array("controller" => "tasks", "action" => "index")); ?></li>
            </ul>
        </div>

        <ul id="nav">
            <li><?php echo $html->link("Users", array("controller" => "users", "action" => "index")); ?></li>
            <li><?php echo $html->link("Teams", array("controller" => "teams", "action" => "index")); ?></li>
            <li><?php echo $html->link("Projects", array("controller" => "projects", "action" => "index")); ?></li>
            <li><?php echo $html->link("Roles", array("controller" => "roles", "action" => "index")); ?></li>
            <li><?php echo $html->link("Tasks", array("controller" => "tasks", "action" => "index")); ?></li>
        </ul>

        <div id="content">
            <?php echo $content_for_layout ?>
        </div>

        <div id="footer">This is a footer :) And it may kick your ass!</div>

    </body>
</html>
