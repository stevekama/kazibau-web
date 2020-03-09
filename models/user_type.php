<?php 
require_once('initialization.php');

class User_Type{
    //Decalare table name 
    private $conn;
    private $table_name = 'user_type';
    //Declare class properties 
    public $id;
    public $user_type;
    public $created_date;
    public $edited_date;
    
    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function fetch_all(){
        $query = "SELECT * FROM ".$this->table_name." ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return $stmt;
        }
       
    }

    public function find_type_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute(array('id'=>$id))){
            $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
            return $wallet;
        }else{
            return false;
        }
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query = "INSERT INTO ".$this->table_name."(";
            $query .= "user_type, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_type, :created_date, :edited_date";
            $query .= ")";
        }else{
            $query = "UPDATE ".$this->table_name." SET ";
            $query .= "user_type=:user_type, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->user_type = htmlentities($this->user_type);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_type', $this->user_type);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        //Execute query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }
}