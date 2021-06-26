<?php
// Initialize the session
session_start();
include_once 'callapi.php';
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
    //"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    // <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
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
    <h1 class="my-5">Hello <?php echo htmlspecialchars($_SESSION["firstname"] ." " . $_SESSION["lastname"]); ?></h1>
    <h2><b>Your Applications</b></h2>
    <table class="table table-striped">
    <tr>
        <th scope="col">Date Submitted</th>
        <th scope="col">Vacation Start</th>
        <th scope="col">Vacation End</th>
        <th scope="col">Days Requested</th>
        <th scope="col">Status</th>
    </tr>
    <?php
    $i = 0;
    if(array_key_exists('applications', $response)){
        foreach ($response["applications"]  as $r) {
            echo "<tr>";
            echo "<td>" . $r['submission_date'] . "</td><td>" . $r['vacation_start'] . "</td><td>" . $r['vacation_end'] . "</td><td>" . $r['days'] . "</td><td>" . $r['status'] . "</td>";
            echo "</tr>";

            $i++;
        }
    }
    ?>
</table>
    <p>
        <a href="logout.php" class="btn btn-info">Sign Out of Your Account</a>
        <a href="applicationform.html" class="btn btn-success">Submit Request</a>
    </p>
    <div>

</div>

</body>
</html>
