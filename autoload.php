<?php

function controllers_autoload($name){
    include "app/controllers/".$name.".php";
}

spl_autoload_register("controllers_autoload");