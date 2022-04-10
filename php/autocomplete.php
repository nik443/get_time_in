<?php

spl_autoload_register(
    function ($classname) {
        require_once "php_classes/{$classname}.php";
    }
);

$city = file_get_contents('php://input')?? false;

if ($city) {
    $pdo_time_offset = new getOffset($city);

    echo $pdo_time_offset->getOffset();
}

?>