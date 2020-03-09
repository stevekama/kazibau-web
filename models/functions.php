<?php 

function base_url(){
    $url = "http://localhost/kazibau-web/";
    // $url = "http://kazibau.co.ke/";
    return $url;
}

function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}