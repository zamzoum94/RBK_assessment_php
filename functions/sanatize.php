<?php

    function escape($str){
        return htmlentities($str, ENT_QUOTES, "utf-8");
    }