<?php 
require_once('initialization.php');

class Brands{
    //Decalare table name 
    private $conn;
    private $table_name = 'brands';
    //Declare class properties 
    public $id;
    public $user_id;
    public $category_id;
    public $brand_name;
    public $brand_description;
    public $num_brand_products;
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

    public function find_products_by_user_id($user_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE user_id=:user_id ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array('user_id'=>$user_id))){
            return $stmt;
        }
    }

    public function find_products_by_category_id($category_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE category_id=:category_id ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array('category_id'=>$category_id))){
            return $stmt;
        }
    }

    public function find_brand_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute(array('id'=>$id))){
            $brand = $stmt->fetch(PDO::FETCH_ASSOC);
            return $brand;
        }else{
            return false;
        }
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query = "INSERT INTO ".$this->table_name."(";
            $query .= "user_id, category_id, brand_name, brand_description, ";
            $query .= "num_brand_products, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_id, :category_id, :brand_name, :brand_description, ";
            $query .= ":num_brand_products, :created_date, :edited_date";
            $query .= ")";
        }else{
            $query = "UPDATE ".$this->table_name." SET ";
            $query .= "user_id=:user_id, category_id=:category_id, brand_name=:brand_name, brand_description=:brand_description, ";
            $query .= "num_brand_products=:num_brand_products, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->user_id = htmlentities($this->user_id);
        $this->category_id = htmlentities($this->category_id);
        $this->brand_name = htmlentities($this->brand_name);
        $this->brand_description = htmlentities($this->brand_description);
        $this->num_brand_products = htmlentities($this->num_brand_products);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':brand_name', $this->brand_name);
        $stmt->bindParam(':brand_description', $this->brand_description);
        $stmt->bindParam(':num_brand_products', $this->num_brand_products);
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