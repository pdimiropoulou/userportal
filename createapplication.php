<?php
session_start();
include_once 'callapi.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['vacation_start']) && isset($_POST['vacation_end']) &&
        isset($_POST['reason']) && 
        $_POST['vacation_end']!="" && $_POST['vacation_start']!="" 
        && $_POST['reason']!="") {
            $vacation_start = $_POST['vacation_start'];
            $vacation_end = $_POST['vacation_end'];
            $reason = $_POST['reason'];

            //API call
            $data_array =  array(
            "vacation_start_date"    => $vacation_start,
            "vacation_end_date"    => $vacation_end,
            "reason"    => $reason,
            "user_id"    =>  $_SESSION["id"],
            );
            $make_call = callAPI('POST', 'http://localhost/epignosisproject/api/application/create.php', json_encode($data_array));
            $response = json_decode($make_call, true);
            
            if($response["message"]==="application was created."){
                header("location: welcome.php");
                include_once 'sendemailsupervisor.php';
               // var_dump($response);
            }
            else{
                header("location: applicationform.html");
            }
    }
    else {
        header("location: applicationform.html");
     //   die();
    }
}
else {
    echo "Submit button is not set";
}
?>