<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//API call
$data_array =  array(
    "userid"    => $_SESSION["id"]
    );
    $make_call = callAPI('GET', 'http://localhost/epignosisproject/api/application/getapplications.php', $data_array);
    $response = json_decode($make_call, true);
    
    //var_dump( $response["applications"][0]);

    if(array_key_exists('applications', $response)){
        ksort($response["applications"]);
    }

    function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
        case "POST":
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
        case "PUT":
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
        break;
        default:
        if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
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
    <h1 class="my-5">Γεια σας <b><?php echo htmlspecialchars($_SESSION["firstname"] ." " . $_SESSION["lastname"]); ?></b></h1>
    <table class="center">
    <tr>
        <th>Date Submitted</th>
        <th>Vacation Start</th>
        <th>Vacation End</th>
        <th>Days Requested</th>
        <th>Status</th>
    </tr>
    <?php
    $i = 0;
    if(array_key_exists('applications', $response)){
        foreach ($response["applications"]  as $r) {
            echo "<tr>";
            echo "<td>" . $r['submission_date'] . "</td><td>" . $r['vacation_start'] . "</td><td>" . $r['vacation_start'] . "</td><td>" . $r['days'] . "</td><td>" . $r['status'] . "</td>";
            echo "</tr>";

            $i++;
        }
    }
    ?>
</table>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="sendemail.php" class="btn btn-danger ml-3">Submit</a>
    </p>
    <div>

</div>

</body>
</html>