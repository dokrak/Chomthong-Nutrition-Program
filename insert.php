<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 

var_dump($_POST);

var_dump($_FILES);
echo move_uploaded_file($_FILES["map"]["tmp_name"],"img/".basename($_FILES['map']['name']));
?>