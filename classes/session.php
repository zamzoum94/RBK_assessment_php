<?php

    class Session{
        public static function exists($token){
            return isset($_SESSION[$token]) ? true:false;
        }

        public static function put($name, $token){
            return $_SESSION[$name] = $token;
        }

        public static function get($token){
            return $_SESSION[$token];
        }

        public static function delete($token){
            if(self::exists($token)){
                unset($_SESSION[$token]);
            }
        }
    }