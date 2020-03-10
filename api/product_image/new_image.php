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

$product = new Products();

$product_id = htmlentities($_POST['product_id']);

$current_product = $product->find_product_by_id($product_id);

if(!$current_product){
    $data['message'] = "errProduct";
    echo json_encode($data);
    die();
}
$images = new Product_Images();
$images->user_id = $current_product['user_id'];
$images->category_id = $current_product['category_id'];
$images->brand_id = $current_product['brand_id'];
$images->product_id = $current_product['id'];
if(isset($_FILES["image"]["type"])){
    $images->attach_file($_FILES["image"]);
    $images->product_details = $_POST['details'];
    $images->created_date = $d->format("Y-m-d H:i:s");
    $images->edited_date = $d->format("Y-m-d H:i:s");
    if($images->save()){
        $data['message'] = "success";
    }
    echo json_encode($data);
}