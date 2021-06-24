<?php
   session_start();
   include_once 'api/config/database.php';
   $database = new Database();
   $db = $database->getConnection();
   $query = "SELECT
   id, vacation_start_date , 
   vacation_end_date, reason FROM applications WHERE user_id= " . $_SESSION["id"] ." and status= 'Pending'
   ORDER BY created_at DESC LIMIT 1";
   $stmt = $db->query($query);
   $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $start_date = $row['vacation_start_date'];
   $end_date = $row['vacation_end_date'];
   $reason = $row['reason'];
   $id = $row['id'];

   $to_email = "polina.dimiropoulou@gmail.com";
   $subject = "Pending Application";
   $body = "<p> Dear supervisor, employee <b>". $_SESSION["firstname"] ." " . $_SESSION["lastname"] ." </b> requested for some time off, starting on <b> {$start_date} </b> 
   and ending on <b> {$end_date} </b>, stating the reason: <b> {$reason} </b> </p>
   <p> Click on one of the below links to approve or reject the application:
   <a href =http://localhost/epignosisproject/updateapplication.php?id={$id}&status=Approved&userid={$_SESSION["id"]}>Approve</a> -  <a href =http://localhost/epignosisproject/updateapplication.php?id={$id}&status=Rejected&userid={$_SESSION["id"]}>Reject</a> </p>"; 
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   $headers .= 'From: polina.dimiropoulou@gmail.com' . "\r\n";

   if (mail($to_email, $subject, $body, $headers)) {
     // echo "Email successfully sent to $to_email..." ;
   } 
   else {
      echo "Email sending failed...";
   }

?>       