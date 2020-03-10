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

$product_id = htmlentities($_POST['product_id']);

$images = new Product_Images();

// find imagesfor product 
$product_images = $images->find_all_product_images($product_id);

// num of images 
$num_images = $product_images->rowCount();

// start on the query
$query = "";

// output array
$output = array();

$query .= "SELECT * FROM product_images ";
$query .= "WHERE product_id = '{$product_id}' ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "AND (";
	$query .= "product_details LIKE '%{$_POST["search"]["value"]}%'";
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
// run query
$statement = $connection->prepare($query);
$statement->execute();
// filter rows
$filtered_rows = $statement->rowCount();

// data array
$data = array();
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $sub_array = array();
    $image = '<img src="'.base_url().'landing/img/products/'.$row['product_images'].'" class="img-thumbnail" width="80">';
	$sub_array[] = $image;
	$sub_array[] = $row["product_details"];
	$data[] = $sub_array;
}


// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_images,
	"data"				=>	$data
);
echo json_encode($output);