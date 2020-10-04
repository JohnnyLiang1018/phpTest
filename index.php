<?php
    header("Access-Control-Allow-Origin: *");
    
    if($_GET){
        $contact = file("./resources/contact.txt");
        $contact_string = implode($contact);
        $list = explode(" ",$contact_string);
        echo json_encode($list);
    }
?>