<?php
    session_start();
    include_once 'callapi.php';
    //API call
    $data_array =  array(
        "id"    => $_GET['userid']
        );
    $make_call = callAPI('GET', 'http://localhost/epignosisproject/api/user/getuserbyid.php', $data_array);
    $response = json_decode($make_call, true);
   // var_dump($response);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Properties</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
<body>
<h1>User Properties</h1>
<h1 >Page is under construction</h1>
<form action="admin.php" method="POST">
<fieldset>
    <?php
    $i = 0;
    if(array_key_exists('users', $response)){
        foreach ($response["users"]  as $r) {
            echo "<label for=firstname>First Name:</label>";
            echo "<input type=text id=firstname name=firstname value=". $r['firstname'] .">";
            echo "<label for=lastname>Last Name:</label>";
            echo "<input type=text id=lastname name=lastname value=". $r['lastname'] .">";
            echo "<label for=email>Email:</label>";
            echo "<input type=text id=email name=email value=". $r['email'] .">";
            echo "<label for=type>User Type:</label>";
            echo "<select id=type name=type value=". $r['type'] .">";
            echo "<option value=Employee>Employee</option>";
            echo "<option value=Administrator>Administrator</option> </select> <button type=submit  name=submit>Update User</button>";
            $i++;
        }
    }
?>
</table>
</form>
</body>
</html>