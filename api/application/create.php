<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/application.php';
  
$database = new Database();
$db = $database->getConnection();
$application = new application($db);
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(!empty($data->vacation_start_date) &&!empty($data->vacation_end_date) &&!empty($data->reason) &&!empty($data->user_id)){
        $application->vacation_start_date = $data->vacation_start_date;
        $application->vacation_end_date = $data->vacation_end_date ;
        $application->reason = $data->reason;
        $application->user_id = $data->user_id;
        // $application->created = date('Y-m-d H:i:s');
    
        // create the application
        if($application->create()){
            http_response_code(201);
            echo json_encode(array("message" => "application was created."));
        }
        else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create application."));
        }
    }

    else{
        // set response code - 400 bad request
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create application. Data is incomplete."));
    }
?>