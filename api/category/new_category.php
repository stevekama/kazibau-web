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


$category->user_id = $session->user_id;
$category->category_name = $_POST['category'];
$category->category_description = $_POST['description'];
$category->num_brands = 0;
$category->num_products = 0;
$category->created_date = $d->format("Y-m-d");
$category->edited_date = $d->format("Y-m-d");

if($category->save()){
    $data['message'] = "success";
}
echo json_encode($data);