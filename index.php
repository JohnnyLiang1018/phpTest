<?php
    header("Access-Control-Allow-Origin: https://sevensea.herokuapp.com");
    header("Access-Control-Allow-Headers");
    
    if($_GET){
        $contact = file("./resources/contact.txt");
        $contact_string = implode($contact);
        $list = explode(" ",$contact_string);
        echo json_encode($list);
    }

    if($_POST){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
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
    }
?>