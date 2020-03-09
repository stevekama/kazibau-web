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

$category = new Categories();

// find category by id
$category_id = htmlentities($_POST['category_id']);
$current_category = $category->find_category_by_id($category_id);
if(!$current_category){
    $data['message'] = "errCategory";
    echo json_encode($data);
    die();
}

$brand = new Brands();

// find brand by id
$brand_id = htmlentities($_POST['brand_id']);
$current_brand = $brand->find_brand_by_id($brand_id);
if(!$current_brand){
    $data['message'] = "errBrand";
    echo json_encode($data);
    die();
}

$product = new Products();

$product->user_id = $session->user_id;
$product->category_id = $current_category['id'];
$product->brand_id = $current_brand['id'];
$product->product = $_POST['product'];
$product->product_description = $_POST['description'];
$product->product_pic = "pic.png";
$product->product_status = "AVAILABLE";
$product->product_price = $_POST['price'];
$product->created_date = $d->format('Y-m-d H:i:s');
$product->edited_date = $d->format('Y-m-d H:i:s');

if($product->save()){
    $data['message'] = "success";
}
echo json_encode($data);