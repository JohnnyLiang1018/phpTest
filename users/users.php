<?php
    header("Access-Control-Allow-Origin: *");

    if($_GET){
        echo json_encode("<div>Hello World</div>");
    }

?>