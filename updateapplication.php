<?php
include_once 'callapi.php';

//API call
$data_array =  array(
    "id"    => $_GET['id'],
    "status" => $_GET['status']
    );
    $make_call = callAPI('POST', 'http://localhost/epignosisproject/api/application/update.php', json_encode($data_array));
    $response = json_decode($make_call, true);

    if($response["message"]==="application was updated."){
        $db = new mysqli('localhost','root','','demo');
        $resource = $db->query("SELECT email FROM users WHERE id={$_GET['userid']}");
        $row = $resource->fetch_assoc();
        $email="{$row['email']}";
        $app = $db->query("SELECT created_at FROM applications WHERE id={$_GET['id']}");
        $row = $app->fetch_assoc();
        $date="{$row['created_at']}";
        $resource->free();
        $db->close();

        //send email to employee
        $to_email = $email;
        $subject = "Application Update";
        $body = "<p> Dear employee, your supervisor has ".$_GET['status'] ." your application
        submitted on {$date}</p>"; 
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: polina.dimiropoulou@gmail.com' . "\r\n";
        if (mail($to_email, $subject, $body, $headers)) {
          //  echo "Email successfully sent to $to_email..." ;
         } 
         else {
            echo "Email sending failed...";
         }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Application has been <?php echo htmlspecialchars($_GET['status']); ?></b></h1>
</body>
</html>