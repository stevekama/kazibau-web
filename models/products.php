<?php 
require_once('initialization.php');

class Products{
    //Decalare table name 
    private $conn;
    private $table_name = 'products';
    //Declare class properties 
    public $id;
    public $user_id;
    public $category_id;
    public $brand_id;
    public $product;
    public $product_description;
    public $product_pic;
    public $product_status;
    public $product_price;
    public $created_date;
    public $edited_date;
    
    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function find_all_products(){
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "ORDER BY id DESC";
        
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

    public function find_products_by_brand_id($brand_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE brand_id=:brand_id ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array('brand_id'=>$brand_id))){
            return $stmt;
        }
    }

    public function find_product_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute(array('id'=>$id))){
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product;
        }else{
            return false;
        }
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "user_id, category_id, brand_id, ";
            $query .= "product, product_description, ";
            $query .= "product_pic, product_status, ";
            $query .= "product_price, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_id, :category_id, :brand_id, ";
            $query .= ":product, :product_description, ";
            $query .= ":product_pic, :product_status, ";
            $query .= ":product_price, :created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "user_id=:user_id, category_id=:category_id, brand_id=:brand_id, ";
            $query .= "product=:product, product_description=:product_description, ";
            $query .= "product_pic=:product_pic, product_status=:product_status, ";
            $query .= "product_price=:product_price, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->user_id = htmlentities($this->user_id);
        $this->category_id = htmlentities($this->category_id);
        $this->brand_id = htmlentities($this->brand_id);
        $this->product = htmlentities($this->product);
        $this->product_description = htmlentities($this->product_description);
        $this->product_pic = htmlentities($this->product_pic);
        $this->product_status = htmlentities($this->product_status);
        $this->product_price = htmlentities($this->product_price);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':brand_id', $this->brand_id);
        $stmt->bindParam(':product', $this->product);
        $stmt->bindParam(':product_description', $this->product_description);
        $stmt->bindParam(':product_pic', $this->product_pic);
        $stmt->bindParam(':product_status', $this->product_status);
        $stmt->bindParam(':product_price', $this->product_price);
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

    ///work on profile pic
    private $temp_path;
    protected $upload_dir = "products";

    //store errors
    public $errors = array();

    //upload errors
    protected $upload_errors = array(
        //http://www.php.net/manual/en/features.file-upload.errors.php
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Large than upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE => "Large than form max_size",
        UPLOAD_ERR_PARTIAL => "Partial upload",
        UPLOAD_ERR_NO_FILE => "No file",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
        UPLOAD_ERR_CANT_WRITE => "Cant write to disk",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension. "
    );

    //attach file removing all errors
    public function attach_file($file){
        /*
         * Perform error checking on the form parameters
         * set object attributes to form parameters
         * dont worry about saving anything to the database yet.
         */
        //perform error checking on the form parameters
        if(!$file || empty($file) || !is_array($file)){
            //error: nothing uploaded or wrong argument usage
            $this->errors[] = "No file was uploaded. ";
            return false;

        }elseif($file['error'] != 0){
            //error: report what PHP says went wrong
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }else{
            //Set object attributes to the form parameters
            $this->temp_path = $file['tmp_name'];
            $this->product_pic = $file['name'];
            //Dont worry about the databaseyet
            return true;
        }
    }

    public function save_photo(){
         /*
        * Make sure there are no errors
        * Attempt to move the file
        * Save corresponding entry to the database
        */
        //1. make sure there are no errors
        if(!empty($this->errors)){ return false; }
        
        //2. cant sae without filename and tempt location
        if(empty($this->pic) || empty($this->temp_path)){
            $this->errors[] = "The file location was not available. ";
            return false;
        }
        //3. Determine the target_path
        $target_path = SITE_ROOT.DS.'landing'.DS.'img'.DS.$this->upload_dir.DS.$this->product_pic;

        //4. make sure the file doesn't exist
        if(file_exists($target_path)){
            //if file exists unlink and move
            unlink($target_path) ? true : false;
            //5. Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){
                /// save the data in db 
                if($this->save()){
                    //unset the path return true
                    unset($this->temp_path);
                    return true;
                }
            }else{
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
                return false;
            }
        }else{
            //5. Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){
                /// save the data in db 
                if($this->save()){
                    //unset the path return true
                    unset($this->temp_path);
                    return true;
                }
            }else{
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
                return false;
            } 
        }

    }
}