<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../models/initialization.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = new Users();

$usersD = $user->authenticate_user($email, $password);
if($usersD){
    $session->login($usersD);
    echo json_encode(array('message'=>'success'));
}else{
    echo json_encode(array('message'=>'failed'));
}

?>