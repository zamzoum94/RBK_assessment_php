<?php
    class Validation{
        public function insert($items, $requirement = array()){
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
    }