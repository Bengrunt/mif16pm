<?php
include('../dev/app/config/database.php');

$db = new DATABASE_CONFIG();

$bdd = mysql_connect($db->default['host'], $db->default['login'], $db->default['password']);
mysql_select_db($db->default['database'], $bdd);
mysql_query("SET NAMES 'utf8'");
$files = array(
        0 => "suppression.sql",
        1 => "creation.sql",
        2 => "insertion.sql",
    );

foreach ($files as $file)
{
    $requetes="";

    $sql = file($file); // on charge le fichier SQL
    foreach($sql as $l){ // on le lit
        //echo $l . "\n<br/>";
        if (substr(trim($l),0,2)!="--"){ // suppression des commentaires
            $requetes .= $l;
        }
    }

    $reqs = split(";",$requetes);// on sépare les requêtes
    foreach($reqs as $req){ // et on les éxécute
        if (!mysql_query($req,$bdd) && trim($req)!=""){
            die("ERROR : ".$req); // stop si erreur
        }
    }
}

echo "La base de donn&eacute;es &agrave; &eacute;t&eacute; enti&egrave;rement recr&eacute;&eacute;e !";
