<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "common.php";

if(!is_usr())
{
header("location:index.php");
}
$com = array("chose");

com("page");

page::com($com);
page::script("chose");
page::load();
page::htm();
 
?>




 
