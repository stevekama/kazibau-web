<?php 
require_once('initialization.php');

class Product_Images{
    //Decalare table name 
    private $conn;
    private $table_name = 'product_images';
    //Declare class properties 
    public $id;
    public $user_id;
    public $category_id;
    public $brand_id;
    public $product_id;
    public $product_images;
    public $product_details;
    public $created_date;
    public $edited_date;
    
    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function find_all_product_images($product_id=0){
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE product_id = :product_id ";
        $query .= "ORDER BY id DESC";
        
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array('product_id'=>$product_id))){
            return $stmt;
        }
    }

    public function find_product_image_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute(array('id'=>$id))){
            $product_image = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product_image;
        }else{
            return false;
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
            $this->product_images = $file['name'];
            //Dont worry about the databaseyet
            return true;
        }
    }
    public function save()
    {
        /*
        * Make sure there are no errors
        * Attempt to move the file
        * Save corresponding entry to the database
        */
        //1. make sure there are no errors
        if(!empty($this->errors)){ return false; }
        //2. cant sae without filename and tempt location
        if(empty($this->product_images) || empty($this->temp_path)){
            $this->errors[] = "The file location was not available. ";
            return false;
        }
        //3. Determine the target_path
        $target_path = SITE_ROOT.DS.'landing'.DS.'img'.DS.$this->upload_dir.DS.$this->product_images;
        
        //4. make sure the file doesn't exist
        if(file_exists($target_path)){
            //if file exists unlink and move
            unlink($target_path) ? true : false;
            //5. Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){
                $query = "";
                if(isset($this->id)){
                    $query .= "UPDATE ".$this->table_name." SET ";
                    $query .= "user_id=:user_id, category_id=:category_id, brand_id=:brand_id, product_id=:product_id, ";
                    $query .= "product_images=:product_images, product_details=:product_details, created_date=:created_date, edited_date=:edited_date ";
                    $query .= "WHERE id=:id";
                }else{
                    $query .= "INSERT INTO ".$this->table_name."(";
                    $query .= "user_id, category_id, brand_id, product_id, ";
                    $query .= "product_images, product_details, ";
                    $query .= "created_date, edited_date";
                    $query .= ")VALUES(";
                    $query .= ":user_id, :category_id, :brand_id, :product_id, ";
                    $query .= ":product_images, :product_details, ";
                    $query .= ":created_date, :edited_date";
                    $query .= ")";
                }
                // prepare query 
                $stmt = $this->conn->prepare($query);

                if(isset($this->id)){
                    $this->id = htmlentities($this->id);
                }
                $this->user_id = htmlentities($this->user_id);
                $this->category_id = htmlentities($this->category_id);
                $this->brand_id = htmlentities($this->brand_id);
                $this->product_id = htmlentities($this->product_id);
                $this->product_images = htmlentities($this->product_images);
                $this->product_details = htmlentities($this->product_details);
                $this->created_date = htmlentities($this->created_date);
                $this->edited_date = htmlentities($this->edited_date);

                // Bind 
                if(isset($this->id)){
                    $stmt->bindParam(':id', $this->id);
                }
                $stmt->bindParam(':user_id', $this->user_id);
                $stmt->bindParam(':category_id', $this->category_id);
                $stmt->bindParam(':brand_id', $this->brand_id);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':product_images', $this->product_images);
                $stmt->bindParam(':product_details', $this->product_details);
                $stmt->bindParam(':created_date', $this->created_date);
                $stmt->bindParam(':edited_date', $this->edited_date);

                // execute statement
                if($stmt->execute()){
                    unset($this->temp_path);
                    if(!isset($this->id)){
                        $this->id = $this->conn->lastInsertId();
                    }
                    return true;
                }

            }else{
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
                return false;
            }
        }else{
            //5. Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){

                $query = "";
                if(isset($this->id)){
                    $query .= "UPDATE ".$this->table_name." SET ";
                    $query .= "user_id=:user_id, category_id=:category_id, brand_id=:brand_id, product_id=:product_id, ";
                    $query .= "product_images=:product_images, product_details=:product_details, ";
                    $query .= "created_date=:created_date, edited_date=:edited_date ";
                    $query .= "WHERE id=:id";
                }else{
                    $query .= "INSERT INTO ".$this->table_name."(";
                    $query .= "user_id, category_id, brand_id, product_id, ";
                    $query .= "product_images, product_details, created_date, edited_date";
                    $query .= ")VALUES(";
                    $query .= ":user_id, :category_id, :brand_id, :product_id, ";
                    $query .= ":product_images, :product_details, ";
                    $query .= ":created_date, :edited_date";
                    $query .= ")";
                }
                // prepare query 
                $stmt = $this->conn->prepare($query);
                
                if(isset($this->id)){
                    $this->id = htmlentities($this->id);
                }
                $this->user_id = htmlentities($this->user_id);
                $this->category_id = htmlentities($this->category_id);
                $this->brand_id = htmlentities($this->brand_id);
                $this->product_id = htmlentities($this->product_id);
                $this->product_images = htmlentities($this->product_images);
                $this->product_details = htmlentities($this->product_details);
                $this->created_date = htmlentities($this->created_date);
                $this->edited_date = htmlentities($this->edited_date);

                // Bind 
                if(isset($this->id)){
                    $stmt->bindParam(':id', $this->id);
                }
                $stmt->bindParam(':user_id', $this->user_id);
                $stmt->bindParam(':category_id', $this->category_id);
                $stmt->bindParam(':brand_id', $this->brand_id);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':product_images', $this->product_images);
                $stmt->bindParam(':product_details', $this->product_details);
                $stmt->bindParam(':created_date', $this->created_date);
                $stmt->bindParam(':edited_date', $this->edited_date);

                // execute statement
                if($stmt->execute()){
                    unset($this->temp_path);
                    if(!isset($this->id)){
                        $this->id = $this->conn->lastInsertId();
                    }
                    return true;
                }
            }else{
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
                return false;
            } 
        }
    }
}