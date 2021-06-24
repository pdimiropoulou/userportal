<?php
class User{

    private $conn;
    private $table_name = "users";
  
    // object properties
    public $id;
    public $email;
    public $firstname;
    public $lastname;
    public $password;
    public $type;

    public function __construct($db){
        $this->conn = $db;
    }

    //get users
    function read(){    
        // select all 
        $query = "SELECT
                    id, firstname, lastname, email, type
                FROM
                    " . $this->table_name . "
                ORDER BY
                    lastname DESC";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    
     //create user
     function create(){
        $query = "INSERT INTO
        " . $this->table_name . "
        SET
        firstname=:firstname, lastname=:lastname, email=:email, password=:password, type=:type";
        $stmt = $this->conn->prepare($query);

        /*$this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->created=htmlspecialchars(strip_tags($this->created));*/

        // bind values
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":type", $this->type);

        if($stmt->execute()){
            return true;
        }

        return false;

    }
    
    //get by id
    function getOne($userid){
        $query = "SELECT
                     id, firstname, lastname, email, type
                    FROM
                    " . $this->table_name . "
                    WHERE
                    p.id = ? LIMIT 1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->$userid);
        $stmt->execute();
        
        return $stmt;
    }
}  

?>