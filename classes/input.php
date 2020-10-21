<?php
    
    class Input {
        public static function exists($type = "post"){
            switch($type){
                case "post" : return empty($_POST) ? false : true;
                case "get" : return empty($_GET) ? false : true;
                default : return false;
            }
        }
    }