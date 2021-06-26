<?php
class Application{

    private $conn;
    private $table_name = "applications";
  
    // object properties
    public $id;
    public $created_at;
    public $days;
    public $reason;
    public $status;
    public $user_id;
    public $vacation_start_date;
    public $vacation_end_date;

    public function __construct($db){
        $this->conn = $db;
    }

    //get applications
    function getapplications($userid){    
        $query = "SELECT
                    id, reason, created_at as submission_date, vacation_start_date as vacation_start, 
                    vacation_end_date as vacation_end,DATEDIFF(vacation_end_date, vacation_start_date)  as days, status
                FROM
                    " . $this->table_name . "
                    WHERE user_id= ?
                ORDER BY
                    created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userid);
        $stmt->execute();
        
        return $stmt;
    }   
    
    //create application
    function create(){
        $query = "INSERT INTO
        " . $this->table_name . "
        SET
        vacation_start_date=:vacation_start_date, vacation_end_date=:vacation_end_date, reason=:reason, user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        /*$this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->created=htmlspecialchars(strip_tags($this->created));*/

        // bind values
        $stmt->bindParam(":vacation_start_date", $this->vacation_start_date);
        $stmt->bindParam(":vacation_end_date", $this->vacation_end_date);
        $stmt->bindParam(":reason", $this->reason);
        $stmt->bindParam(":user_id", $this->user_id);
        // execute query
        if($stmt->execute()){
            return true;
        }
            return false;

    }

    // update application
    function update(){
        $query = "UPDATE
        " . $this->table_name . "
        SET
        status = :status
        WHERE
        id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
          return true;
        }

        return false;
    }
    
    //get last pending application
    function getlastapplication($userid){    
        $query = "SELECT
                    vacation_start_date , 
                    vacation_end_date, reason
                FROM
                    " . $this->table_name . "
                    WHERE user_id= ? and status= 'Pending'
                ORDER BY
                    created_at DESC 
                    LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->vacation_start_date = $row['vacation_start_date'];
        $this->vacation_end_date = $row['vacation_end_date'];
        $this->reason = $row['reason'];
        
        return $stmt;
    }   
}
?>