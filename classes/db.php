<?php

    class DB{
        private static $_instance = null;
        private $_pdo,
                $_results,
                $_count,
                $_query,
                $_error;

        private function __construct(){
            try{
                $host = Config::get("mysql/host");
                $username = Config::get("mysql/username");
                $password = Config::get("mysql/password");
                $db = Config::get("mysql/db");
                $this->_pdo = new PDO("mysql:host={$host};dbname={$db}", $username, $password);
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

        public function query($sql, $params = array()){
            $this->_error = false;
            if($this->_query = $this->_pdo->prepare($sql)){
                $x = 1;
                if(count($params)){
                    foreach($params as $param){
                        $this->_query->bindValue($x++, $param);
                    }
                }
                if($this->_query->execute()){
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else{
                    $this->_error = $this->_query->errorInfo();
                }
            }
            return $this;
        }

        public function getResults(){
            return $this->_results;
        }

        public function getCount(){
            return $this->_count;
        }

        public function getError(){
            return $this->_error;
        }
    }