<?php

    $GLOBALS["config"] = array(
        "mysql" => array(
            "host" : "localhost",
            "username" : "root",
            "password" : "",
            "db" : "gestion_rcsf"
        );
    );

    spl_autoload_register(function($class){
        require_once "classes/{$class}.php";
    });

    require_once "functions/sanatize.php";