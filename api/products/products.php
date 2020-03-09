<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

$products = new Products();

$data = array();

if($_POST['action'] == "FETCH_NUM_PRODUCTS"){
    $user_id = $session->user_id;
    $user_products = $products->find_products_by_user_id($user_id);
    $num_products = $user_products->rowCount();
    $data['total'] = $num_products;
    echo json_encode($data);
}


if($_POST['action'] == "FIND_PRODUCT_BY_ID"){
    $product_id = htmlentities($_POST['product_id']);
    $current_product = $products->find_product_by_id($product_id);
    if(!$current_product){
        $data['message'] = "errProduct";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_product);
}