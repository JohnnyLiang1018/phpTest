<?php
    header("Access-Control-Allow-Origin: https://sevensea.herokuapp.com");
    header("Access-Control-Allow-Header:*");

    $servername = "us-cdbr-east-02.cleardb.com";
    $username = "ba03357e37cb47";
    $password = "74664542";
    $dbname = "heroku_84c7d2e25ecd866";
    $mysqli = new mysqli($servername,$username,$password,$dbname);

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    console_log("test");

    if($mysqli == false){
        die("Fail to connect");
    }

    if($_POST){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $query = "INSERT INTO Users (email,lName,fName,addr,cellp,homep) VALUES ('".$data["email"]."','".$data["lName"]."','".$data["fName"]."','".$data["addr"]."','".$data["cellp"]."','".$data["homep"]."');";
        if($res = $mysqli->query($query)){
            console_log("Success");
        }
        else{
            console_log("Failed");
        }
    }

    if($_GET){
        $query = "SELECT * FROM USER WHERE lName=".$_GET["lName"].",fName=".$_GET["fName"].",addr=".$_GET["addr"].",cellp=".$_GET['cellp'].",homep=".$_GET["homep"].";";
        $res = $mysqli->query($query);
        $arr = array();
        while($row = $res->fetch_array()){
            $arr[] = $row;
        }
        $data = json_encode($arr);
        echo $data;
    }

?>