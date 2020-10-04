<?php

// http_response_code(200);
// $subject = $_GET('fname');
$contact = file(./resources/contact.txt);
$list = explode(" ",$contact);
echo $list;


?>