<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("common.php");

global $left_sel;

$left = array("profile","history","follow","product","buy","shopping");
$left_sel = "profile";

if(http::is("u"))
{ 
    $http = http::get();
    
    if(!cusr::load_by_id($http))
    {
        header("location:index.php");
    }
    
    do
    {
        $c = current($left);
    
        if(http::is($c))
        {
            $left_sel = $c;
         
        }

    } 
    while(next($left));
    
    
}
else
{
    header("location:index.php");
}

com("page");
   
            $args[] = array("target"=>array("u_".$left_sel),
                            "data"=>array("sel"));
            
page::com(array("u_left","u_profile","u_history","u_follow","u_product","u_buy","u_shopping"));
page::arg($args); 
page::script("u");
page::load();
page::htm();


?>

