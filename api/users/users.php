<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../models/initialization.php';

if($_POST['action'] == 'FETCH_USER'){

    if($session->is_logged_in()){
        $user = new Users();
        $user_id = $session->user_id;
        $userData = $user->find_user_by_id($user_id);
        echo json_encode($userData);
    }else{
        echo json_encode(array('message'=>'notLoggedIn'));
    }   
    
} 

if($_POST['action'] == 'LOGOUT'){ 
    if($session->is_logged_in()){
        $session->logout();
        echo json_encode(array('message'=>'success'));
    }
} ?>