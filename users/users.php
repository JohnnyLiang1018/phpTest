<?php
    header("Access-Control-Allow-Origin: *");

    if($_GET){
        echo json_encode("Hello World");
    }

?>