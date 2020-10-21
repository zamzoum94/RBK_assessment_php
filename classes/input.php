<?php
    
    class Input {
        public static function exists($type = "post"){
            switch($type){
                case "post" : return empty($_POST) ? false : true;
                case "get" : return empty($_GET) ? false : true;
                default : return false;
            }
        }

        public static function get($prop){
            if(isset($_POST[$prop])){
                return $_POST[$prop];
            } else if(isset($_GET[$prop])){
                return $_GET[$prop];
            } else{
                return "";
            }
        }
    }