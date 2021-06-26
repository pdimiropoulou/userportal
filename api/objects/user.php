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
                    id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userid);
        $stmt->execute();
        
        return $stmt;
    }

        //Update
        function updateUser(){
            $query = "UPDATE  " . $this->table_name . " SET firstname=:firstname , lastname=:lastname , email=:email, type=:type
                      WHERE id:id";
            $stmt = $this->conn->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->firstname));
            $this->email=htmlspecialchars(strip_tags($this->lastname));
            $this->age=htmlspecialchars(strip_tags($this->email));
            $this->designation=htmlspecialchars(strip_tags($this->type));
            $this->id=htmlspecialchars(strip_tags($this->id));
                  
            // bind values
            $stmt->bindParam(":firstname", $this->firstname,PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $this->lastname,PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->email,PDO::PARAM_STR);
            $stmt->bindParam(":type", $this->type,PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id,PDO::PARAM_STR);
            echo $query;
             // execute query
            if($stmt->execute()){
                return true;
            }
                return false;
        }
}  

?>