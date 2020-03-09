<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in initialization file
require_once('../../models/initialization.php');

$data = array();

$d = new DateTime("now");

$product_id = htmlentities($_POST['product_id']);

// initialize products 
$product = new Products();

$current_product = $product->find_product_by_id($product_id);

if(!$current_product){
    $data['message'] = "errProduct";
    echo json_encode($data);
    die();
}
$product->id = $current_product['id'];
$product->user_id = $current_product['user_id'];
$product->category_id = $current_product['category_id'];
$product->brand_id = $current_product['brand_id'];
$product->product = $current_product['product'];
$product->product_description = $current_product['description'];
if(isset($_FILES["pic"]["type"])){
    $product->attach_file($_FILES["pic"]);
    $product->product_status = $current_product['product_status'];
    $product->product_price = $current_product['product_price'];
    $product->created_date = $current_product['created_date'];
    $product->edited_date = $d->format("Y-m-d H:i:s");
    if($product->save_photo()){
        $data['message'] = "success";
    }
    echo json_encode($data);
}