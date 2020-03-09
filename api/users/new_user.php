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

$users = new Users();

$password = $_POST['password'];

$confirm_password = $_POST['confirm_password'];

if($password !== $confirm_password){
    $data['message'] = "errPassword";
    echo json_encode($data);
    die();
}
$users->user_type_id = $_POST['type_id'];
$users->fullnames = $_POST['fullnames'];
$users->email = $_POST['email'];
/// check if email exists
$user_email = $users->find_user_by_email($users->email);
if($user_email){
    $data['message'] = "errEmail";
    echo json_encode($data);
    die();
}
$users->phone = $_POST['phone'];
$users->dob = "0000-00-00";
$users->date_registered = $d->format("Y-m-d");
$users->gender = "";
$users->location = "";
$users->profile = "profile.png";
$users->username = $_POST['username'];
$users->password = $password;
$users->confirm_password = $confirm_password;
$users->forgot_code = "NULL";
$users->created_date = $d->format("Y-m-d");
$users->edited_date = $d->format("Y-m-d");

if($users->save()){
    $current_user = $users->find_user_by_id($users->id);
    $session->login($current_user);
    $data['message'] = "success";
}
echo json_encode($data);