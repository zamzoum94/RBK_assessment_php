<?php

    class DB{
        private static $_instance = null;
        private $_pdo,
                $_results,
                $_count,
                $_query;

        private function __construct(){
            try{
                $host = Config::get("mysql/host");
                $username = Config::get("mysql/username");
                $password = Config::get("mysql/password");
                $db = Config::get("mysql/db");
                $this->_pdo = new PDO("mysql:host={$host};dbname:{$db}", $username, $password);
            } catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public static function getInstance(){
            if(!isset(self::$_instance)){
                self::$_instance = new DB();
            }
            return self::$_instance;
        }
    }