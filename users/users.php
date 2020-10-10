<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");

    if($_GET){
        echo json_encode("<div>Hello World</div>");
    }

?>