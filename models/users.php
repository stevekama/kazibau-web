<?php 
require_once('initialization.php');

class Users {
    private $conn;
    
    // table name and schema 
    private $table_name = 'users';

    // Users properties 
    public $id;
    public $user_type_id;
    public $fullnames;
    public $email;
    public $phone;
    public $dob;
    public $date_registered;
    public $gender;
    public $location;
    public $profile;  
    public $username;
    public $password;
    public $confirm_password;
    public $forgot_code;
    public $created_date;
    public $edited_date;

    //db connect
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }

    //get user by id
    public function find_user_by_id($id=0){
        $query = "SELECT * FROM ".$this->table_name." WHERE id = :id LIMIT 1";
        
        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $user;
        }
    }

    //get user by email
    public function find_user_by_email($email=""){
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array('email'=>$email))){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }

    // find user by code 
    public function find_user_by_forgot_code($forgot_code=""){
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE forgot_code = :forgot_code LIMIT 1";
        
        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('forgot_code'=>$forgot_code))){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set ser
            return $user;
        }
    }

    // authenticate user
    public function authenticate_user($email = '', $password = ''){
        $user = $this->find_user_by_email($email);
        if($user){
            if(password_verify($password, $user['password'])){
                return $user;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // change password
    public function find_user_password($id, $password = ""){
        $user = $this->find_user_by_id($id);
        // find user by id
        if($user){
            /// verify password 
            if(password_verify($password, $user['password'])){
                return $user;
            }
        }
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "user_type_id, fullnames, email, phone, dob, ";
            $query .= "date_registered, gender, location, ";
            $query .= "profile, username, password, confirm_password, ";
            $query .= "forgot_code, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_type_id, :fullnames, :email, :phone, :dob, ";
            $query .= ":date_registered, :gender, :location, ";
            $query .= ":profile, :username, :password, :confirm_password, ";
            $query .= ":forgot_code, :created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->schema.".".$this->table_name." SET ";
            $query .= "user_type_id=:user_type_id, fullnames=:fullnames, email:email, phone=:phone, dob=:dob, ";
            $query .= "date_registered=:date_registered, gender=:gender, location=:location, ";
            $query .= "profile=:profile, username=:username, password=:password, confirm_password=:confirm_password, ";
            $query .= "forgot_code=:forgot_code, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->user_type_id = htmlentities($this->user_type_id);
        $this->fullnames = htmlentities($this->fullnames);
        $this->email = htmlentities($this->email);
        $this->phone = htmlentities($this->phone);
        $this->dob = htmlentities($this->dob);
        $this->date_registered = htmlentities($this->date_registered);
        $this->gender = htmlentities($this->gender);
        $this->location = htmlentities($this->location);
        $this->profile = htmlentities($this->profile);
        $this->username = htmlentities($this->username);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->confirm_password = password_hash($this->confirm_password, PASSWORD_DEFAULT);
        $this->forgot_code = htmlentities($this->forgot_code);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        //Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_type_id', $this->user_type_id);
        $stmt->bindParam(':fullnames', $this->fullnames);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':date_registered', $this->date_registered);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':profile', $this->profile);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':confirm_password', $this->confirm_password);
        $stmt->bindParam(':forgot_code', $this->forgot_code);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        //Execute Query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    // update new password
    public function update_new_password(){
        $query = "UPDATE ".$this->schema.".".$this->table_name." SET password = :password WHERE id = :id";

        //propare statement 
        $stmt = $this->conn->prepare($query);

        // hash password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        /// bind statements
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':password', $this->password);
         
        //Execute Query 
        if($stmt->execute()){
            return true;
        }
    }

    // update user password
    public function update_password($id=0, $password = "", $new_password = ""){
        //clean data
        $id = htmlentities($id);
        
        // use user id to get the user password and compare with the password
        $user = $this->find_user_by_id($id);
        // verify password
        // return $user['password'];
        if(password_verify($password, $user['password'])){
            // return $user;
            // change and update password
            $query = "UPDATE ".$this->schema.".".$this->table_name." SET password = :password WHERE id = :id";
            //prepare statement 
            $stmt = $this->conn->prepare($query);

            // hash password
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            //Bind Data
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':password', $new_password);
            //Execute Query 
            if($stmt->execute()){
                return true;
            } 
        }else{
            return false;
        }
        
    }

    /// update user  profile 
    private $temp_path;
    protected $upload_dir = "profile";

    // store errors
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
        }else {
            //Set object attributes to the form parameters
            $this->temp_path = $file['tmp_name'];
            $this->profile = basename(time().$file['name']);
            //Dont worry about the databaseyet
            return true;
        }

    }

    public function save_photo(){
        if(isset($this->id)){
            /*
            * Make sure there are no errors
             * Attempt to move the file
             * Save corresponding entry to the database
             */
            // 1. make sure there are no errors
            if(!empty($this->errors)){ return false; }
            
            //2. cant sae without filename and tempt location
            if(empty($this->profile) || empty($this->temp_path)){
                $this->errors[] = "The file location was not available.";
                return false;
            }

            // 3. Determine the target_path
            $target_path = SITE_ROOT.DS.'public'.DS.'dist'.DS.'img'.DS.$this->upload_dir.DS.$this->profile;
            //return $target_path;

            // 4. make sure the file doesn't exist
            if(file_exists($target_path)){
                return unlink($target_path) ? true : false;
            }

            // 5. Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){  
                // create query to update profile
                $query = "UPDATE ".$this->schema.".".$this->table_name." SET profile = :profile WHERE id = :id";

                //prepare statement 
                $stmt = $this->conn->prepare($query);

                //Bind Data
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':profile', $this->profile);

                 //Execute Query 
                if($stmt->execute()){
                    return true;
                } 
            }else{
                /*
                 * File was not moved
                 */
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
                return false;
            }
        }else{
            return false;
        }
    }
}