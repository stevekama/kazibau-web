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

$category_id = htmlentities($_POST['category_id']);

$current_category = $category->find_category_by_id($category_id);

if(!$current_category){
    $data['message'] = "errCategory";
    echo json_encode($data);
    die();
}

$brands = new Brands();

$brands->user_id = $current_category['user_id'];
$brands->category_id = $current_category['id'];
$brands->brand_name = $_POST['brand'];
$brands->brand_description = $_POST['description'];
$brands->num_products = 0;
$brands->created_date = $d->format("Y-m-d");
$brands->edited_date = $d->format("Y-m-d");

if($brands->save()){
    $current_brands = $brands->find_products_by_category_id($brands->category_id);
    $num_brands = $current_brands->rowCount();
    $category->id = $current_category['id'];
    $category->user_id = $current_category['user_id'];
    $category->category_name = $current_category['category_name'];
    $category->category_description = $current_category['category_description'];
    $category->num_brands = $num_brands;
    $category->num_products = $current_category['num_products'];
    $category->created_date = $current_category['created_date'];
    $category->edited_date = $d->format('Y-m-d H:i:s');
    if($category->save()){
        $data['message'] = "success";
    }
}

echo json_encode($data);