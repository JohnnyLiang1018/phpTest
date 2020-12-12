<?php
    header("Access-Control-Allow-Origin: https://sevensea.herokuapp.com");
    header("Access-Control-Allow-Headers:*");

    $servername = "us-cdbr-east-02.cleardb.com";
    $username = "ba03357e37cb47";
    $password = "74664542";
    $dbname = "heroku_84c7d2e25ecd866";
    $mysqli = new mysqli($servername,$username,$password,$dbname);

    if($_POST){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
        }
        $query = sprintf("SELECT * FROM Users WHERE email=%s",$data->email);
        $result = $mysqli->query($query);
        if(!$result){
            
        }

    }

?>