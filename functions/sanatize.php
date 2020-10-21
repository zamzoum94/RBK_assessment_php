<?php

    function escape($str){
        return htmlentities($str, ENT_QUOTES, "utf-8");
    }

    function splitArrayType($array, $props = array()){
        $newArray = array();
        foreach($props as $prop){
            foreach($array as $element){
                if($element->type === $prop){
                    $newArray[$prop][] = $element;
                }
            }
        }
        return $newArray;
    }