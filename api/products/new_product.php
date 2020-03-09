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
    // update num products on the brands
    $brand_products = $product->find_products_by_brand_id($product->brand_id);
    $num_brand_products = $brand_products->rowCount();
    // update brands
    $brand->id = $current_brand['id'];
    $brand->user_id = $current_brand['user_id'];
    $brand->category_id = $current_brand['category_id'];
    $brand->brand_name = $current_brand['brand_name'];
    $brand->brand_description = $current_brand['brand_description'];
    $brand->num_brand_products = $num_brand_products;
    $brand->created_date = $current_brand['created_date'];
    $brand->edited_date = $d->format("Y-m-d H:i:s");

    if($brand->save()){
        // update num of products on the category
        $category_products = $product->find_products_by_category_id($product->category_id);
        $num_category_products = $category_products->rowCount();
        // update category
        $category->id = $current_category['id'];
        $category->user_id = $current_category['user_id'];
        $category->category_name = $current_category['category_name'];
        $category->category_description = $current_category['category_description'];
        $category->num_brands = $current_category['num_brands'];
        $category->num_products = $num_category_products;
        $category->created_date = $current_category['created_date'];
        $category->edited_date = $d->format('Y-m-d H:i:s');

        if($category->save()){
            $data['message'] = "success";
        }
    }
}
echo json_encode($data);