
<?php 

include 'common.php';

$en1=db::real_escape_string($_GET['id']);


$sql="select * from en where id=".$en1;
$rs=db::query($sql) or die(mysql_error());
$row=db::arr($rs);
echo $row['cho'],'#',$row['prot'],'#',$row['fat'],'#',$row['nameE'];
?>
