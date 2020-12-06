<?php
//$s=parse_url(,PHP_URL_QUERY);
$arr=[];

$servername = "us-cdbr-east-02.cleardb.com";
$username = "ba03357e37cb47";
$password = "74664542";
$dbname = "heroku_84c7d2e25ecd866";
$mysqli = new mysqli($servername,$username,$password,$dbname);

if(empty($_SERVER['QUERY_STRING'])){
    //header("Location: user.php");
    die();
}
else {
    parse_str($_SERVER['QUERY_STRING'],$arr);
    if(!array_key_exists("fname",$arr)||!array_key_exists("lname",$arr)||!array_key_exists("email",$arr)
    ||!array_key_exists("pw",$arr)||!array_key_exists("addr",$arr)||!array_key_exists("hPho",$arr)||!array_key_exists("cPho",$arr)){
        echo "bad input";
    }
    else{
        //fval(...array_values($arr));
        $exists=checkDuplicateUsers($arr["email"]);
        if($exists){
            echo "duplicate email";
        }
        else{
            createUser(...array_values($arr));
        }
        //createUser(...array_values($arr));
    }
}




function checkDuplicateUsers($email){//make it so dupe users arent allowed adjust makeUser.php too
    if($mysqli->connect_error){
        echo $mysqli->connect_error;
    }
    $query = sprintf("SELECT * FROM Users WHERE email='%s'",
     sanitize($mysqli,$email));
    $result = $mysqli->query($query);
    $rows = $result->num_rows;
    $result->close(); #Got error when closing this for some reason
    if($rows==0){
        return false;
    }
    else{
        return true;
    }

   
   
}
function createUser($fname,$lname,$email,$pas,$addr, $hpho,$cpho){
    if($mysqli->connect_error){
        echo $mysqli->connect_error;
    }
    $query = sprintf("INSERT INTO Users (`fname`,`lname`,`email`,`addr`,`homep`,`cellp`,`password`)
    VALUES ('%s' , '%s' , '%s' , '%s', '%s', '%s', '%s')",
    sanitize($mysqli,$fname), sanitize($mysqli,$lname), sanitize($mysqli,$email),
    sanitize($mysqli,$addr), sanitizePhone($mysqli,$hpho), sanitizePhone($mysqli,$cpho),sanitize($mysqli,$pas));
    $result = $mysqli->query($query);
    if (!$result) {
        echo "Unable to insert into database, please refresh the page and try again<br><br>";
    }
    else{
        
        echo '
        <p>Successfully inserted into database</p>
        <br>';
       #$result->close(); #Got error when closing this for some reason
        #$conn->close();
    }
}

function sanitize($conn,$var){
    return $conn->real_escape_string($var);
}
function sanitizePhone($conn, $var){
    $temp=$conn->real_escape_string($var);
    $justNums = preg_replace("/[^0-9()]/", '', $temp);
    //eliminate leading 1 if its there
    if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);
    //if we don't have 10 digits left, it's probably valid.
    return $justNums;
}
?>