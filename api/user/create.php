<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: user/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/user.php';
  
$database = new Database();
$db = $database->getConnection();
$user = new user($db);
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(!empty($data->firstname) &&!empty($data->lastname) &&!empty($data->email) &&!empty($data->password) &&!empty($data->type)){
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname ;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->type = $data->type;
        
        // create the user
        if($user->create()){
            http_response_code(201);
            echo json_encode(array("message" => "user was created."));
        }
        else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create user."));
        }
    }

    else{
        // set response code - 400 bad request
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
    }
?>