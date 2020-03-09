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

$categories = new Categories();

$current_categories = $categories->find_categories_by_user_id($user_id);

$num_categories = $current_categories->rowCount();

// start on the query
$query = "";
// output array
$output = array();

$query .= "SELECT * FROM categories WHERE user_id = '{$user_id}' ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "AND (";
	$query .= "category_name LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR category_description LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR num_brands LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR num_products LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY id DESC ";
}

// Pagging
if($_POST["length"] != -1){
	$query .= 'LIMIT '.intval($_POST["length"]).' OFFSET '.intval($_POST["start"]);
}

$statement = $connection->prepare($query);
$statement->execute();
$filtered_rows = $statement->rowCount();

// data array
$data = array();

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
	$sub_array = array();
	$sub_array[] = $row["category_name"];
	$sub_array[] = $row["category_description"];
	$num_brands = $row['num_brands'];
	$num_products = $row['num_products'];
	$brands = "";
	if($num_brands > 0){
		$brands .= '<span class="label label-success">'.$num_brands.'</span>';
	}else{
		$brands .= '<span class="label label-danger">'.$num_brands.'</span>';
	}
	$sub_array[] = $brands;

	$products = "";
	if($num_products > 0){
		$products .= '<span class="label label-success">'.$num_products.'</span>';
	}else{
		$products .= '<span class="label label-danger">'.$num_products.'</span>';
	}
	$sub_array[] = $products;
	$data[] = $sub_array;
}

// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_categories,
	"data"				=>	$data
);
echo json_encode($output);