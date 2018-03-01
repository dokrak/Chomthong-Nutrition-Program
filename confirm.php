<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("common.php");

if(!$_GET["id"])header("location:index.php");

$id="'".$_GET["id"]."'";

if(session::is($id))
{$arr = session::get();   

session::un_set();
}


$sdate = date::sdate();
$stime = date::stime();

$uname = $arr["uname"];
$password = $arr["password"];
$email = $arr["email"];
$sex = $arr["sex"];
$province = $arr["province"];

if(cusr::insert("'".$sdate."','".$stime."','".$uname."','".$email."','".$password."','".$sex."','".$province."','1'"))
{
     $res = db::select(array("tbl"=>"usr","where"=>array("name='$name'","password='".$password."'")));
    
     $src = db::arr($res);
    //echo $rememberme;exit;
    if(is_array($src))
    {
       // if($rememberme == "check")
      //  rememberme::set($src["id"]);
      //  else{
        session::set("u",$src["id"]);//}

        session::set("login",1);    
        
   
        
    echo "welcome";
    
    echo "<script>";
    echo "window.location='index.php'";
    echo "</script>";
    
    } 
}



?>


 
