<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->css(array("reset", "global", "flash")); ?>

        <?php echo $html->charset(); ?>
        <title><?php echo $page_title; ?></title>

        <?php if (Configure::read() == 0) { ?>
        <meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
        <?php } ?>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    </head>

    <body>
        <h3><?php echo $message; ?></h3>
        <p><a href="<?php echo $url; ?>">Vous allez &ecirc;tre redirig&eacute; dans <?php echo $pause; ?> secondes. Cliquez ici pour ne pas attendre. </a></p>
    </body>
</html>