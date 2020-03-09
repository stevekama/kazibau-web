<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

// Database Connect
$connection = $database->connect();

// user id
$user_id = $session->user_id;

$products = new Products();

$current_products = $products->find_products_by_user_id($user_id);

$num_products = $current_products->rowCount();

// start on the query
$query = "";
// output array
$output = array();

$query .= "SELECT products.id, categories.category_name, brands.brand_name, products.product, products.product_status, products.product_price FROM products "; 
$query .= "INNER JOIN categories ON products.category_id = categories.id ";
$query .= "INNER JOIN brands ON products.brand_id = brands.id ";
$query .= "WHERE products.user_id = '{$user_id}' ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "AND (";
	$query .= "categories.category_name LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR brands.brand_name LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR products.product LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR products.product_status LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR products.product_price LIKE '%{$_POST["search"]["value"]}%'";
	$query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY products.id DESC ";
}

// Pagging
if($_POST["length"] != -1){
	$query .= 'LIMIT '.intval($_POST["length"]).' OFFSET '.intval($_POST["start"]);
}

// run query
$statement = $connection->prepare($query);
$statement->execute();
// filter rows
$filtered_rows = $statement->rowCount();

// data array
$data = array();

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
	$sub_array = array();
	$sub_array[] = $row["category_name"];
	$sub_array[] = $row["brand_name"];
	$sub_array[] = $row['product'];
    $sub_array[] = $row['product_status'];
    $sub_array[] = $row['product_price'];
    $sub_array[] = '<button id="'.$row['id'].'" class="btn btn-sm btn-info view_product">Product</button>';
	$data[] = $sub_array;
}

// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_products,
	"data"				=>	$data
);
echo json_encode($output);