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

$brands = new Brands();

$current_brands = $brands->find_products_by_user_id($user_id);

$num_brands = $current_brands->rowCount();

// start on the query
$query = "";
// output array
$output = array();

$query .= "SELECT * FROM brands "; 
$query .= "INNER JOIN categories ON brands.category_id = categories.id ";
$query .= "WHERE brands.user_id = '{$user_id}' ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "AND (";
	$query .= "categories.category_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR brands.brand_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR brands.brand_description LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR brands.num_brand_products LIKE '%{$_POST["search"]["value"]}%'";
	$query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY brands.id DESC ";
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
    $sub_array[] = $row["brand_name"];
    $sub_array[] = $row["brand_description"];
    $num_products = $row['num_brand_products'];
    
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
	"recordsFiltered"	=>	$num_brands,
	"data"				=>	$data
);
echo json_encode($output);