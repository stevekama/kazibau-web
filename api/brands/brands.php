<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

$brands = new Brands();

$data = array();

if($_POST['action'] == "FETCH_NUM_BRANDS"){
    $user_id = $session->user_id;
    $user_brands = $brands->find_products_by_user_id($user_id);
    $num_brands = $user_brands->rowCount();
    $data['total'] = $num_brands;
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