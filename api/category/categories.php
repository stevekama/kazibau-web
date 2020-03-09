<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

$categories = new Categories();

$data = array();

if($_POST['action'] == "FETCH_NUM_CATEGORIES"){
    $user_id = $session->user_id;
    $user_categories = $categories->find_categories_by_user_id($user_id);
    $num_categories = $user_categories->rowCount();
    $data['total'] = $num_categories;
    echo json_encode($data);
}

if($_POST['action'] == "FIND_ALL_CATEGORIES"){
    $all_categories = $categories->fetch_all();
    $count = $all_categories->rowCount();
    if($count > 0){
        while($categories = $all_categories->fetch(PDO::FETCH_ASSOC)){
            $data[] = $categories;
        }
    }
}

if($_POST['action'] == "FIND_CATEGORY_BY_ID"){
    $category_id = htmlentities($_POST['category_id']);
    $current_category = $categories->find_category_by_id($category_id);
    if(!$current_category){
        $data['message'] = "errCategory";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_category);
}