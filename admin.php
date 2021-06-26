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
    $make_call = callAPI('GET', 'http://localhost/epignosisproject/api/user/getusers.php',"");
    $response = json_decode($make_call, true);

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
     <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script>
          $(document).ready(function () {
            jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
          });
        </script>
</head>
<body>
    <h1 class="my-5">Hello <?php echo htmlspecialchars($_SESSION["firstname"] ." " . $_SESSION["lastname"]); ?></h1>
    <h2><b>Registered Users</b></h2>
    <table class="table table-striped" id="users">
    <tr>
        <th scope="col">User first name</th>
        <th scope="col">User last name</th>
        <th scope="col">User email</th>
        <th scope="col">User type</th>
        <th scope="col">&nbsp;</th>
        
    </tr>
    <?php
    $i = 0;
    if(array_key_exists('users', $response)){
        foreach ($response["users"]  as $r) {
            echo "<tr>";
            echo "<td>" . $r['firstname'] . "</td><td>" . $r['lastname'] . "</td><td>" . $r['email'] . "</td><td>" . $r['type'] . "</td> <td><a href=https://localhost/epignosisproject/getuser.php?userid=". $r['id'] .">Edit</a></td> ";
            echo "</tr>";

            $i++;
        }
    }
?>
</table>
<p>
        <a href="logout.php" class="btn btn-info">Sign Out of Your Account</a>
        <a href="registeruser.html" class="btn btn-success">Create User</a>
    </p>
</body>
</html>