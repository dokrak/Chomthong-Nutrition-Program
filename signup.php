<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "common.php";

com("page");

page::com(array("top_bar","signup"));

page::script("signup");
page::load();
page::htm();
 
?>