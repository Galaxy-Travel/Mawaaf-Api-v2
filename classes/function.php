<?php

    spl_autoload_register(function($className){
        $path = 'classes/' . strtolower($className) . ".php";

        if (file_exists($path)) {
            require_once($path);
        } else {
            echo "File $path is not Found.";
        }

    });

?>