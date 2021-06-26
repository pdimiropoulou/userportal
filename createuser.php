<?php
session_start();
include_once 'callapi.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['firstname']) && isset($_POST['lastname']) &&
        isset($_POST['mail']) &&
        isset($_POST['password'])&&
        isset($_POST['type']) && 
        $_POST['firstname']!="" && $_POST['lastname']!="" 
        && $_POST['mail']!="" && $_POST['password']!="" && $_POST['type']!="") {
           
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $type = $_POST['type'];

            //API call
            $data_array =  array(
            "firstname"    => $firstname,
            "lastname"    => $lastname,
            "email"    => $mail,
            "password"    => $password,
            "type"    => $type
            );
            $make_call = callAPI('POST', 'http://localhost/epignosisproject/login-registration-api/register.php', json_encode($data_array));
            $response = json_decode($make_call, true);
             
            if($response["success"]===1){
                header("location: admin.php");
            }
            else{
                var_dump($response);
                header("location: registeruser.html");
            }
    }
    else {
        header("location: registeruser.html");
     //   die();
    }
}
else {
    echo "Submit button is not set";
}
?>