<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    //API call
    $make_call = callAPI('GET', 'http://localhost/epignosisproject/api/user/getusers.php',"");
    $response = json_decode($make_call, true);
    
    //var_dump( $response["users"][0]);
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
        <th>User first name</th>
        <th>User last name</th>
        <th>User email</th>
        <th>User type</th>
    </tr>
    <?php
    $i = 0;
    if(array_key_exists('users', $response)){
        foreach ($response["users"]  as $r) {
            echo "<tr>";
            echo "<td>" . $r['firstname'] . "</td><td>" . $r['lastname'] . "</td><td>" . $r['email'] . "</td><td>" . $r['type'] . "</td>";
            echo "</tr>";

            $i++;
        }
    }
?>
</table>
</body>
</html>