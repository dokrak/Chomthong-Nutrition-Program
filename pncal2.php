
<?php 
include 'common.php';

$pn1=db::real_escape_string($_GET['id']);
$sql="select * from pn where id=".$pn1;
$rs=db::query($sql);
$row=db::arr($rs);
echo $row['cal'],'#',$row['prot'],'#',$row['fat'],'#',$row['n'],'#',$row['vol'],'#',$row['nameP'];
?>
