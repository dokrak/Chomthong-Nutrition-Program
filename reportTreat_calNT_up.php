<?php


include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
if (!isset($_GET['HN'])) {
  header("location:index.php");
}
$HN = $_GET['HN'];



$res = db::query("SELECT t.* FROM treatnt as t WHERE t.HN='".$HN."' ORDER BY treat_No desc limit 1");
$row = db::arr($res);

$nt = db::query("SELECT b.* FROM nt2013  as b WHERE b.HN='".$HN."' ORDER BY b.screenid desc limit 1");
$row_nt = db::arr($nt);

$naf = db::query("SELECT * FROM naf   WHERE naf.HN='".$HN."' ORDER BY naf.screenid desc limit 1");
$row_naf = db::arr($naf);

$time=1;
$type="";
if($row_nt['screendate']>$row_naf['screendate']){
	$time=$row_nt['screenNo'];
	$type="BNT";
	}else{$time=$row_naf['screenNo'];
			$type="NAF";}


$res1=db::query("select * from en where id='".$row['en1']."' ");
$row_en=db::arr($res1);

$pn1=db::query("select * from pn where id='".$row['pn1']."' ");
$row_pn1=db::arr($pn1);

$pn2=db::query("select * from pn where id='".$row['pn2']."' ");
$row_pn2=db::arr($pn2);

if(session::is("pr1"))
{
$pr1 = session::get();

session::un_set();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script>
 function prnt(){
	 
	  	var message = "ต้องการพิมพ์รายละเอียดการคัดกรอง? ";
 		
if(confirm(message)==false){window.location.href='/hospital/screening.php';}
else{window.print();window.location.href='/hospital/screening.php';}
 
	 }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Report of treat_calNT</title>
</head>

<body>
<table width="809" border="0" align="center">
  <tr>
    <th bgcolor="#D7DFFB" colspan="6" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" align="middle" /></a></th>
  </tr>
  <tr>
    <th colspan="2"><p>แบบฟอร์มคำนวณทางโภชนบำบัด  รพ.จอมทอง</p><p>ใช้งานใน รพ. :&nbsp;<?php echo $row['hosp']; ?></p></th>
  </tr>
  <tr>
      <td colspan="2"><div></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp; 
    </td>
  </tr>
  <tr>
    <td colspan="2"><div>ชื่อ-สกุล : <?php echo $row['Fname']; ?> &nbsp;&nbsp;<?php echo $row['Lname']; ?>
    </td>
  </tr>
    <tr><td colspan="2"><div style="float: left">HN :</div><div style="float: left"><?php echo $row['HN']; ?></div>
      <div style="float: left"> AN:</div>
      <div><?php echo $row['AN']; ?>อายุ : <?php echo $row['age']; ?>&nbsp;&nbsp;เพศ : <?php echo $row['sex']; ?> </div></td>
        
    </tr>
    <tr>
      <td colspan="2"><div>
        <div align="center">คำนวนจากการประเมิน&nbsp;
  <?=$type;?>
  &nbsp;ครั้งที่ : 
  <?php  echo $time;?>
  &nbsp;&nbsp;(Screenin ID :<?php echo $row['screen_id']; ?>)เมื่อวันที่  : &nbsp;<?php echo $row['Tdate']; ?>&nbsp;
        </div>
      </div></td>
    </tr>
    <tr>
        <td colspan="2"><div>
          <div align="center"><span><?php echo $type." "; ?>score = <?=$row['score'];?>
          </span> แปลผล :&nbsp;<font style="border-color:#F30; background-color: " id="result" size="+1" color="#3333FF">&nbsp;</font>
            <input name="level" type='text' id='result3' style="text-align:center; background-color:#CF9" value="<?php echo $row['risk']; ?>"  size="40" readonly="readonly" />
          </div>
      </div></td>
  </tr>
  <tr>
    <td width="410">&nbsp;&nbsp;&nbsp;Calory Requirement =<?php echo $row['cal_req']; ?>(kcal/d)
    </td>
    <td width="407"> &nbsp;&nbsp;&nbsp;Volume requirement =<?php echo $row['vol_req']; ?>(ml/d) </td>
  </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Protein requirement=<?php echo $row['prot_req']; ?>(gm/d) </td>
      <td>&nbsp;&nbsp;&nbsp;Fat requirement=<?php echo $row['fat_req']; ?> (gm/d) </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
      <td align="center" colspan="2"><div>
        <div style=" background-color:#D2DFF2"  >การรักษาที่ให้ ครั้งที่ :<?php echo $row['treat_No']; ?> 
        &nbsp;
          Date :&nbsp; <?php $today=date('Y-m-d');echo $today;?>
         </div>
      </div></td>
      </tr>
  <tr>
    <td align="center" colspan="2"><strong><span style="float:left">Enteral Nutrition </span></strong></td>
  </tr>              
        <tr>
            <td scope="col">&nbsp;&nbsp;&nbsp;Enteral Nutrition ที่ให้ : 1)
          <?=$row_en['nameE'];?>
           </td>
            <td rowspan="2" scope="col"><span style="float:left">ได้รับจาก Calory  จากทาง enteral =
                <?php if($row_en['en_cal']!=0){echo $row_en['en_cal'];}else{echo"0";}?>
Kcal </span></td>
             
        </tr>
        <tr>
            <td scope="col">&nbsp;&nbsp;&nbsp; Other Enteral feeding :<?=$row['en2'];?></td>
        </tr>
         <tr>
           <td colspan="2" scope="col"><strong><span style="float:left">Parenteral Nutrition</span></strong></td>
         </tr>
         <tr>
           <td scope="col">&nbsp;&nbsp;&nbsp;Parenteral Nutrition ที่ให้ 1) :<?=$row_pn1['nameP'];?></td>
           <td rowspan="2" scope="col">ได้รับ calory จากทาง parenteral =
             <?php if($row_pn['pn_cal']!=0){echo $row_en['pn_cal'];}else{echo"0";}?>Kcal </td>
         </tr>
         <tr>
           <td scope="col">&nbsp;&nbsp;&nbsp;Parenteral Nutrition ที่ให้ 2) :<?=$row_pn2['nameP'];?></td>
         </tr>
         <tr>
           <td align="center" bgcolor="#D2DFF2"  colspan="2" scope="col">สรุป </td>
         </tr>
         <tr>
           <td scope="col">Calory ที่ได้รับทั้งหมด =<font size="-1">
             <?=$row["cal_gain"];?>
           (Kcal/d)</font></td>
           <td scope="col"><div  style="float:left">Protein ที่ได้รับ = </div>
             <div  style="float:left"></div>
             <font size="-1">
             <?=$row["prot_gain"];?>
(g/d)</font></td>
         </tr>
         <tr>
             <td scope="col"><div style="float:left">Fat ที่ได้รับ=</div>
               <div align="left">
                 <?=$row["fat_gain"];?>
             <font size="-1">(g/d)</font></div></td>
             <td scope="col"><div style="float:left">Volume ที่ได้รับ=</div>
               <div style="float:left"></div>
               <font size="-1"><span style="float:left">
               <?=$row['vol_gain'];?>
             </span>(ml/d)</font></td>
        </tr>
        <tr>
            <td  colspan="2" scope="col"><div >N:NPC ที่ได้รับ=
                <?=$row["NPCratio"];?>
            </div></td>
        </tr>
        <tr>
            <td colspan="2" scope="col"><div align="left">
              <div  style="float:left">สัดส่วน Enteral feeding =
                <?=$row["en_ratio"];?>
                % ของ  Required Calory ====&gt;
                <?=$row['en_pn2'];?>
              </div>
            </div></td>
          </tr>
        <tr>
            <td colspan="2" scope="col"></tr>
        <tr>
            <td colspan="2" scope="col">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
       
  <tr>
    <td bgcolor="#C8F1A0" colspan="6"><div align="center">
            <input onclick="javascript:window.print() " type="submit" name="prnt" id="prnt" value="print" />
     
    </div></td>
  </tr>

</table>
</body>
</html>

