<?php 
require_once('initialization.php');

class Categories{
    //Decalare table name 
    private $conn;
    private $table_name = 'categories';
    //Declare class properties 
    public $id;
    public $user_id;
    public $category_name;
    public $category_description;
    public $num_brands;
    public $num_products;
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

    public function find_categories_by_user_id($user_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE user_id=:user_id ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array('user_id'=>$user_id))){
            return $stmt;
        }
    }

    public function find_category_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute(array('id'=>$id))){
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category;
        }else{
            return false;
        }
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query = "INSERT INTO ".$this->table_name."(";
            $query .= "user_id, category_name, category_description, "; 
            $query .= "num_brands, num_products, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_id, :category_name, :category_description, "; 
            $query .= ":num_brands, :num_products, :created_date, :edited_date";
            $query .= ")";
        }else{
            $query = "UPDATE ".$this->table_name." SET ";
            $query .= "user_id=:user_id, category_name=:category_name, category_description=:category_description, "; 
            $query .= "num_brands=:num_brands, num_products=:num_products, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->user_id = htmlentities($this->user_id);
        $this->category_name = htmlentities($this->category_name);
        $this->category_description = htmlentities($this->category_description);
        $this->num_brands = htmlentities($this->num_brands);
        $this->num_products = htmlentities($this->num_products);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':category_name', $this->category_name);
        $stmt->bindParam(':category_description', $this->category_description);
        $stmt->bindParam(':num_brands', $this->num_brands);
        $stmt->bindParam(':num_products', $this->num_products);
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