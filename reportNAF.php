<?php

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
if (!isset($_GET['id'])) {
  header("location:index.php");
}
$HN = $_GET['id'];

$res = db::query("SELECT p.*,t.*,p.score as score,p.critical as critical,p.ward as ward,p.reporter as reporter,p.result1 as result1 FROM triagent as t inner join naf as p on t.hn=p.hn WHERE t.HN='".$HN."' order by p.screenid desc");
 
 
$hid = u::is("hid")?u::get():"";
 
$n = db::arr($res);
$sel_sw = null;
$sel_vom= null;
$sel_gi = null;
 
if(session::is("sel_sw"))
{
$sel_sw = session::get();
var_dump($sel_sw);
$sel_sw = explode("_",$sel_sw);
session::un_set();
}
if(session::is("sel_gi"))
{
$sel_gi=session::get();

$sel_gi=explode("_",$sel_gi);

session::un_set();
}

if(session::is("sel_vom"))
{
$sel_vom = session::get();
$sel_vom = explode("_",$sel_vom);

session::un_set();
}


$shape = array("3"=>"ผอมมาก(2)","2"=>"ผอม(1)","1"=>"อ้วนมาก(1)","0"=>"ปกติ-อ้วนปานกลาง(0)");
$wt_change = array("3"=>"ลดลง/ผอมลง(2)","2"=>"เพิ่มขึ้น/อ้วนขึ้น(1)","1"=>"ไม่ทราบ(0)","0"=>"คงเดิม(0)");                                      
$diet_type = array("3"=>"อาหารนา้ๆ(2)","2"=>"อาหารเหลวๆ(2)","1"=>"อาหารนุ่มกว่าปกติ(1)","0"=>"อาหารเหมอืนปกติ(0)");
$diet_qnt = array("3"=>"กินนอ้ยมาก(2)","2"=>"กินนอ้ยลง(1)", "1"=>"กินมากข้นึ (0)", "0"=>"กินเท่าปกติ(0)");                                      
$swallow  = array("2"=>"สำลัก(2)","1"=>"เคี้ยว/กลีนลำบาก/<br />ได้อาหารทางสาย(2)","0"=>"กลืนไดป้กติ(0)");
 $GI =  array("2"=>"ทอ้งเสีย(2)","1"=>"ปวดท้อง(2)","0"=>"ปกติ(0)");
 $vom =    array("1"=>"อาเจียน(2)","2"=>"คลื่นไส้(2)","3"=>"ปกติ(0)");                                
$status = array("3"=>"นอนติดเตียง(2)","2"=>"ต้องมีผู้ช่วยบ้าง (1)","1"=>"นั่งๆนอนๆ(0)","0"=>"ปกติ(0)");

$sel_shape = $shape[$n["shape"]];
$sel_wt_change = $wt_change[$n["wt_change"]];
$sel_diet_type = $diet_type[$n["diet_type"]];
$sel_diet_qnt =$diet_qnt[$n["diet_qnt"]];

$sel_swallow = null;
$sel_GI = null;
$sel_vomit=null;

if(is_array($sel_sw))
{
var_dump($sel_sw);
do
{
    $c = current($sel_sw);
     
    if(array_key_exists($c,$swallow))$sel_swallow .= $swallow[$c]." ";
}while(next($sel_sw));
}
if(is_array($sel_gi))
{
do
{
    $c = current($sel_gi);
     
    if(array_key_exists($c,$GI))$sel_GI .= $GI[$c]." ";
}while(next($sel_gi));

}
if(is_array($sel_vom))
{

do
{
    $c = current($sel_vom);
     
    if(array_key_exists($c,$vom))$sel_vomit .= $vom[$c]." ";
}while(next($sel_vom));
}

$sel_status = $status[$n["status"]];

$bmi="";
$h1=$n["ht"];
$h2=$n["ht_tell"];
$w=$n["bw"];

if(($h1!=""||$h1!=0)&&($w!=""||$w!=0))
{$bmi=(10000*$w)/($h1*$h1);
}else if(($h2!=""||$h2!=0)&&($w!=""||$w!=0))
{$bmi=(10000*$w)/($h2*$h2);
	}else{echo"error";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script>
 function prnt(){
	 
	  	var message = "ต้องการพิมพ์รายละเอียดการคัดกรอง? ";
 		
if(confirm(message)==false){window.location.href='/hospital/screening.php';}
else{window.print();window.location.href='/hospital/screening.php';}
 		//window.location.href='/nutrition/file/screening.php';
 		
	 
	 
	 }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="850" border="0" align="center" cellpadding="2" cellspacing="2">

  <tr>
    <th colspan="2"  bgcolor="#FCD9C3" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></th>
  </tr>
  <tr>
    <th colspan="2"   bgcolor="#669966" scope="col"><font size="+1"    color="#333399" style="background-color: #98CE74">&nbsp;&nbsp;&nbsp;&nbsp;แบบประเมินภาวะทุพโภชนาการ NAF&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="+1" color="#333399">&nbsp;&nbsp;&nbsp;&nbsp;   
    <?=$n["hosp"];?>&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
  </tr>
  <tr>
    <td align="center" colspan="2">
     Assessment No.
        <?=$n["screenid"];?>
      ประเมินครั้งที่ :
          <?=$n["screenNo"];?>
          <?=$n["hosp"];?>
       </td>
  </tr>
  <tr bgcolor="#F5F5F5">
    <td colspan="2">
     ชื่อ:&nbsp; <?=$n["Fname"];?>&nbsp;นามสกุล :&nbsp; <?=$n["Lname"];?>
     &nbsp;&nbsp;HN :&nbsp;
          <?=$n["HN"];?>
     &nbsp;&nbsp;AN:&nbsp;
          <?=$n["AN"];?>
     &nbsp;&nbsp;Age :&nbsp;<?=$n["age"];?>
     &nbsp;&nbsp;Sex:&nbsp;
          <?=$n["sex"];?>
       
     &nbsp;&nbsp;Ward :&nbsp;
          <?=$n["ward"];?>
     </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คำนวน Ideal Body Weight=:
      <?=$n["IBW"];?>
kg.
      <div></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principle Diagnosis :
      <?=$n["diag"];?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ECOG Score :
      <?=$n["ecog"];?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">1.) ส่วนสูง/ความยาวลำตัว /ความยาวช่วงแขนจากปลายนิ้วกลางทั้ง 2 ข้าง (Arm span) 
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1)วัดความยาวลำตัว &nbsp;=
      <?=$n["length"];?>
    cm.
      </td>
  </tr>
  <tr>
    <td colspan="2"><div  width="42%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.2 )Arm span
      &nbsp;=
      <?=$n["arm"];?>&nbsp;cm.
    </div>
      <div></div>
      </td>
  </tr>
  <tr>
    <td colspan="2"><div>1.3) ความสูง(High) : วัดได้ :&nbsp; 
        <?=$n["ht"];?>
cm.&nbsp;&nbsp;&nbsp;ญาติบอก :&nbsp; 
          <?=$n["ht_tell"];?>
cm.</div>
      <div>
        <div></div>
      </div>
      <div>
        <div></div>
      </div></td>
  </tr>
  <tr bgcolor="#D4F0FD">
    <td bgcolor="#E5F2FF"  bordercolor="#E9E7F8" ><div id="bwdiv" align="left">2.) น้ำหนัก BW :=&nbsp;
        <?=$n["bw"];?>kg.&nbsp;&nbsp;ดัชนีมวลกาย :=&nbsp;<?=number_format($bmi,2,'.','');?>

</div>
      <div   id="textdiv" align="left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- หากไม่ทราบน้ำหนักให้ระบุค่า albumin หรือ Total Lymphocyte Count (TLC)</div>
      <div  id="albdiv" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Albumin level : =<font>
      <? if($n["alb"]==""||$n["alb"]==0){echo"_______";}else{echo$n["alb"];}?>
      g/dl </font>
      </div>
      <div  id="tlcdiv">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TLC =<? if($n["TLC"]==""||$n["TLC"]==0){echo"_______";}else{echo$n["TLC"];}?> cells/ml</div>
      </div></td>
      <td  bgcolor="#DEF1FF"><div align="center">BMI <strong>score<br><?=$n["bmi1"];?></strong>
        </div> </td>
  </tr>
  <tr bgcolor="#E6E1FE">
    <td bgcolor="#E6E1FE" >3.)รูปร่างของผู้ป่วย :&nbsp;
      <?=$sel_shape;?>
<div></div></td>
       <td align="center" bgcolor="#E6E1FE">Shape score<br> <span style="background-color: #E8F2F1">
       <?=$n["shape_s"];?>
       </span></td>
  </tr>
  <tr >
    <td  bgcolor="#E5F2FF" > 4.) ประวัติน้ำหนักที่เปลี่ยนแปลงใน 4 สัปดาห์ :&nbsp;
      <?=$sel_wt_change;?>
<div></div>
      <div style="background-color: #E8F2F1" align="right">
        <div align="center">
          <div></div>
        </div>
      </div></td>
       <td align="center" bgcolor="#DEF1FF">Wt loss <strong>score<br><?=$n["wt_s"];?> </strong><br />
       </td>
  </tr>
  <tr bgcolor="#E6E1FE">
    <td  >5.) อาหารที่กินในช่วง 2 สัปดาห์ที่ผ่านมา 
      <label for="diet_cal"></label>
      <label for="intake">&nbsp;ลักษณะอาหาร :&nbsp; 
        <?=$sel_diet_type;?>
      &nbsp;ปริมาณที่กิน :&nbsp;
      <?=$sel_diet_qnt;?>
      </label>
      <div></div>
      <div></div>
      <div>
        <div align="center">
          <div></div>
        </div>
      </div></td>
       <td align="center" bgcolor="#E6E1FE">Diet <strong>score<br>
       <?=$n["diet_s"];?></strong>       </td>
  </tr>
  <tr>
    <td bgcolor="#E5F2FF" >6.) อาการต่อเนื่อง > 2 สัปดาห์ที่ผ่านมา (เลือกได้มากกว่า 1 ข้อ) :</td>
     <td align="center" bgcolor="#DEF1FF" rowspan="4">GI symptom <strong>score<br>
     <?=$n["gi_s"];?>      </strong> </td>
  </tr>
  <tr>
    <td ><div>&nbsp;&nbsp;&nbsp;&nbsp;6.1 ปัญหาการเคี้ยวและการกลืน คะแน =&nbsp; <?php echo $sel_swallow;?></div></td>
  </tr>
  <tr>
    <td >&nbsp;&nbsp;&nbsp;&nbsp;6.2 ปัญหาระบบทางเดินอาหาร คะแนน =&nbsp; <?php echo $sel_GI;?></td>
  </tr>
  <tr>
    <td ><div  align="right">
      <div align="center">
        <div>
          <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;6.3ปัญหาระหว่างกินอาหาร คะแนน =&nbsp;<?php echo $sel_vomit;?></div>
        </div>
        </div>
    </div></td>
  </tr>
  <tr bgcolor="#E6E1FE">
    <td    >7.) ความสามารถในการ เข้าถึงอากหาร :
      <?=$sel_status;?>
      <div></div>
      <div></div></td>
    <td align="center"  >Status <strong>score<br>
      <?=$n["status_s"];?>      </strong> </td>
  </tr>
  <tr>
    <td bgcolor="#E5F2FF" >8.)โรคที่เป็นอยู่ (เลือกได้มากกว่า 1 ข้อ):
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td valign="top" width="24%">DM (3)=
              <? if($n["dm"]!=0||$n["dm"]!=""){echo $n["dm"];}else{echo"0";}?>
           
              <div></div>
            Solid cancer  (3)
            =<? if($n["cancer"]!=0||$n["cancer"]!=""){echo $n["cancer"];}else{echo"0";}?>
            <div></div>
            Hip fracture  (3)=
            <? if($n["hip"]!=0||$n["hip"]!=""){echo $n["hip"];}else{echo"0";}?>
            <div></div>
            Stroke/CVA(6)=
            <? if($n["cva"]!=0||$n["cva"]!=""){echo $n["cva"];}else{echo"0";}?>
            <div></div>
            Multiplefracture(6)=
            <? if($n["mulfx"]!=0||$n["mulfx"]!=""){echo $n["mulfx"];}else{echo"0";}?>
<div></div></td>
          <td valign="top" width="35%"><p>
            CKD-ESRD (3)=
              <? if($n["ckd"]!=0||$n["ckd"]!=""){echo $n["ckd"];}else{echo"0";}?>
              <br />
Chronic heart failure  (3)=
<? if($n["chf"]!=0||$n["chf"]!=""){echo $n["chf"];}else{echo"0";}?>         
           <br>COPD (3)=
    <? if($n["copd"]!=0||$n["copd"]!=""){echo $n["copd"];}else{echo"0";}?>
            
            <br>Septicemia(3)=
            <? if($n["sepsis"]!=0||$n["sepsis"]!=""){echo $n["sepsis"];}else{echo"0";}?>
            <br />
            Malignanthematologicdisease/ Bonemarrowtransplant (6)=
            <? if($n["hemato"]!=0||$n["hemato"]!=""){echo $n["hemato"];}else{echo"0";}?>
            <p></p>
            <div></div></td>
          <td valign="top" width="41%"> CLD/Cirrhosis/Hepatic enceph. (3)
            =
            <? if($n["liver"]!=0||$n["liver"]!=""){echo $n["liver"];}else{echo"0";}?>
            <div></div>
            <br />
            Severe head injury  (3) =
            <? if($n["hi"]!=0||$n["hi"]!=""){echo $n["hi"];}else{echo"0";}?>
            <br/>
            <div></div>
            &gt; 2nd degree burn  (3)=
            <? if($n["burn"]!=""||$n["burn"]!=0){echo $n["burn"];}else{echo"0";}?>
            <br />
            <div></div>
            Severe pneumonia(6)=
            <? if($n["pneumo"]!=0||$n["pneumo"]!=""){echo $n["pneumo"];}else{echo"0";}?>
            <div></div>
            Critically ill(ผู้ป่วยวิกฤติ)(6)=
			 <? if($n["critical"]!=0||$n["critical"]!=""){echo $n["critical"];} else {echo"0";}?>
             <div></div>
             </td>
          
        </tr>
        <tr>
          
        </tr>
      </table></td>
       <td align="center" bgcolor="#DEF1FF">Diseases<strong> score</strong><br><?=$n["dis_s"];?>       </td>
    
  </tr>
  <tr align="right">
    <td colspan="2" ><label for="spinal"></label>
      <label for="spinal"></label>
      <div align="left">
        <div style="background-color: #F9FDCF" align="right">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="6"><div align="center"><font size="-1">สารอาหารและพลังงานที่ควรได้รับต่อวันของผู้ป่วยรายนี้</font></div></td>
        </tr>
        <tr>
          <td width="14%"><div align="right"><font size="-1">Calory Requirement</font></div></td>
          <td width="16%"><font size="-1" color="">
            <input name="cal_req" type='text' id='cal_req' style="text-align:center; background-color: #E6E6E6 " value="<?php echo $n['cal_req']; ?>"  size="10" readonly="readonly" />
            Kcal/d </font></td>
          <td width="18%"><div align="right"><font size="-1">Protein requirement</font></div></td>
          <td width="16%"><font size="-1" color="">
            <input name="prot_req" type='text' id='prot_req' style="text-align:center; background-color: #E6E6E6" value="<?php echo $n['prot_req']; ?>"  size="10" readonly="readonly" />
          </font>gm/d</td>
          <td width="17%"><div align="right"><font size="-1">Fat</font><font size="-1" color=""> requirement </font></div></td>
          <td width="19%"><font size="-1" color="">
            <input value="<?php echo $n['fat_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="fat_req" type='text' id='fat_req'  size="10" />
            ml/d</font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align="right"><font size="-1" color="">Volume requirement </font></div></td>
          <td><div align="left"><font size="-1" color="">
            <input value="<?php echo $n['vol_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="vol_req" type='text' id='vol_req'  size="10" />
            ml/d</font></div></td>
          <td><div align="right"><font size="-1">NPC:N ที่ควรได้</font></div></td>
          <td><font size="-1" color="">
            <input value="<?php echo $n['npc']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="npc" type='text' id='npc'  size="10" />
          </font></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </div>
      </div></td>
  </tr>
  <tr>
    <td  
     bgcolor="#F3E3D7"  align="center" colspan="2"><div><font id="show">&nbsp;NAF Score =
<?PHP
				$icd="";
				$bnt=$n["score"];
				if($bnt<=4&&$bnt>=0)
					{$icd="E44.1";}
					else if($bnt<=14&&$bnt>=6)
					{$icd="E44.0";}
					else if($bnt>=15)
					{$icd="E43";}
				
				?>
        <input style="text-align:center"  size="8" value="<?=$n["score"];?>"/>  ==&gt; ICD-10 :<input name="icd" id="icd" style="text-align:center" value="<?=$icd;	?>" size="8" /></font><BR />
                <font  id="show2">แปลผล
      :<input style="text-align:center" size="40" 
      value="<?=$n["level"];?>"/>
      </font> ข้อแนะนำ : <font id="show3">
     <input style="text-align:center" size="40" value="<?=$n["result1"];?>"/>
      </font><br />
      </div>
      <div></div>
      <p></p></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><div>แพทย์ :
        <?=$n["doctor"];?>
      </div>      <div>ผู้รายงาน :
        <?=$n["reporter"];?>
      </div></td>
  </tr>
  <tr>
    <td bgcolor="#C8F1A0" colspan="3"><div align="center">
      <input onclick="javascript:window.print() " type="submit" name="prnt" id="prnt" value="print" />
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><a href="/hospital/screening.php">Back to home</a></div></td>
  </tr>
</table>
</body>
</html>

