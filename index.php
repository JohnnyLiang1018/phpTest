<?php
    header("Access-Control-Allow-Origin: https://sevensea.herokuapp.com");
    header("Access-Control-Allow-Headers:*");
    
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

    if($_GET){
        $contact = file("./resources/contact.txt");
        $contact_string = implode($contact);
        $list = explode(" ",$contact_string);
        echo json_encode($list);
    }

    if($_POST){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        switch ($data->action) {
            case "admin":
                if(!$data->username || !$data->password){
                    echo json_encode(array('code'=>400,'data'=>'','message'=>'Login failed'));
                }
                else{
                    if($data->username == "admin" && $data->password == "password"){
                        $users = file("./resources/users.txt");
                        $users_string = implode($users);
                        $list = explode(",",$users_string);
                        echo json_encode(array('code'=>200,'data'=>$list,'message'=>'Success'));
                    }
                    else{
                        echo json_encode(array('code'=>401,'data'=>'','message'=>'Login failed'));
                    }
                }
                break;
            case "addUser":
                $query = "INSERT INTO Users (email,lName,fName,addr,cellp,homep) VALUES ('".$data["email"]."','".$data["lName"]."','".$data["fName"]."','".$data["addr"]."','".$data["cellp"]."','".$data["homep"]."');";
                if($res = $mysqli->query($query)){
                    console_log("Success");
                }
                else{
                    console_log("Failed");
                }
                break;
            default:
                echo json_encode(array('code'=>400,'data'=>'','message'=>'Request failed'));
        }
    }
?>