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
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(!empty($data->firstname) &&!empty($data->lastname) &&!empty($data->email) &&!empty($data->type)&&!empty($data->id)){
    
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname ;
        $user->email = $data->email;
        $user->type = $data->type;
        $user->id = $data->id;  
    
        // create the user
        if($user->updateUser()){
            http_response_code(201);
            echo json_encode(array("message" => "user was updated."));
            //$data = [ 'message' => 'user was created', 'id' => -1 ];
            
        }
        else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update user."));
        }
    }

    else{
        // set response code - 400 bad request
        http_response_code(400);
        echo json_encode(array("message" => "Unable to update user. Data is incomplete."));
    }
?>