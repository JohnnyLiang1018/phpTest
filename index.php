<?php
    header("Access-Control-Allow-Origin: *");
    
    if($_GET){
        $contact = file("./resources/contact.txt");
        $contact_string = implode($contact);
        $list = explode(" ",$contact_string);
        $_GET["Email"] = $list[0];
        $_GET["Tel"] = $list[1];
        echo $_GET;
    }
?>