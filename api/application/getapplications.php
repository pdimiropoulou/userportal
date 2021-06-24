<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/application.php';

$database = new Database();
$db = $database->getConnection();
$application = new Application($db);
$userid=isset($_GET["userid"]) ? $_GET["userid"] : "";
$stmt = $application->getapplications($userid);
$num = $stmt->rowCount();

// check if more than 0 record found
    if($num>0){
        $applications_arr=array();
        $applications_arr["applications"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $application_item=array(
                "id" => $id,
                "submission_date" => $submission_date, 
                "vacation_start" => $vacation_start, 
                "vacation_end" => $vacation_end,
                "days" => $days,
                "status" => $status
            );
            array_push($applications_arr["applications"], $application_item);
        }

        http_response_code(200);
        echo json_encode($applications_arr);
    }
  
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No applications found.")
        );
    }
?>