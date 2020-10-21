<?php
    class Validation{
        public $errors;
        public function insert($items){
            $db = DB::getInstance();
            $type = $items["type"];
            $x_coordonne = $items["x_coordonne"];
            $y_coordonne = $items["y_coordonne"];
            $count = $db->query("SELECT nb_limit FROM rcsf where type = ?", [$type])->getResults()[0];
            if($count->nb_limit > 0){
                $res = $db->query("INSERT INTO capteur(x_coordonne, y_coordonne, ref) VALUES (?, ?, ?)",
                [$x_coordonne, $y_coordonne, $type])->getError();
                if(!$res){
                    $res = $db->query("UPDATE rcsf SET nb_limit=? WHERE type=?",
                    [($count->nb_limit)-1, $type])->getError();
                    if(!$res){
                        echo "Inserted well";
                    } else{
                        echo "Limit exceeds";
                    }
                }
            }
        }

        public function check($items, $requirement = array()){
            $this->errors = array();
            foreach($requirement as $index=>$rules){
                $value = $items[$index];
                foreach($rules as $rule=>$need){
                    if($rule === "required" && empty($value)){
                        $this->addError("${index} is required");
                    }
                }
            }
        }

        public function passed(){
            return count($this->errors) > 0 ? false : true;
        }

        public function addError($error){
            $this->errors[] = $error;
        }
        
        public function getErrors(){
            return $this->errors;
        }
    }