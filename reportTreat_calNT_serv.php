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

$res = db::query("SELECT t.* FROM treatnt as t WHERE t.HN='".$HN."' ORDER BY treat_No desc");
$row = db::arr($res);
$res1=db::query("select * from en where id='".$row['en1']."' ");
$row_en=db::arr($res1);  

$pn1=db::query("select * from pn where id='".$row['pn1']."' ");
$row_pn1=db::arr($pn1);

$pn2=db::query("select * from pn where id='".$row['pn2']."' ");
$row_pn2=db::arr($pn2);

$a_conc = array("1"=>"1 : 1","0.5"=>"0.5 : 1","1.5"=>"1.5 : 1","2"=>"2 : 1");

if(session::is("result1"))
{
$result1 = session::get();

session::un_set();
}
if(session::is("npc"))
{
$npc = session::get();

session::un_set();
}
if(session::is("conc"))
{
$conc = session::get();

if(array_key_exists($conc,$a_conc))
$conc = $a_conc[$conc];

session::un_set();
}
if(session::is("er"))
{
$er = session::get();
session::un_set();
}
if(session::is("water"))
{
$water = session::get();

session::un_set();
}
if(session::is("pr1"))
{
$pr1 = session::get();

session::un_set();
}
if(session::is("pr2"))
{
$pr2 = session::get();

session::un_set();
}
if(session::is("pn3"))
{
$pn3 = session::get();

session::un_set();
}
if(session::is("tcal2"))
{
$tcal2 = session::get();

session::un_set();
}
if(session::is("tprot2"))
{
$tprot2 = session::get();

session::un_set();
}
if(session::is("tfat2"))
{
$tfat2 = session::get();

session::un_set();
}
if(session::is("tvol"))
{
$tvol = session::get();

session::un_set();
}
if(session::is("adv"))
{
$adv = session::get();

session::un_set();
}
if(session::is("screenNo"))
{
$screenNo = session::get();

session::un_set();
}
if(session::is("screendate"))
{
$screendate = session::get();

session::un_set();
}

if(session::is("bw"))
{
$bw = session::get();

session::un_set();
}

if(session::is("ibw"))
{
$ibw = session::get();

session::un_set();
}
if(session::is("bmi1"))
{
$bmi1 = session::get();

session::un_set();
}

if(session::is("ecog"))
{
$ecog = session::get();

session::un_set();
}

if(session::is("diag"))
{
$diag = session::get();

session::un_set();
}

if(session::is("doctor"))
{
$doctor = session::get();

session::un_set();
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script>
 function prnt(){
	 
	  	var message = "ต้องการพิมพ์รายละเอียดการคัดกรอง? ";
 		
if(confirm(message)==false){window.location.href='/hospital/screening.php';}
else{window.print();window.location.href='/hospital/screening.php';}
 
	 }
</script>
</head>

<body>
<div  id=txt>
<form id="form1" name="form1" method="POST" action="#">
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th bgcolor="#D7DFFB" colspan="5" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" align="middle" /></a></th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" colspan="5" scope="col"><p>แบบฟอร์มคำนวณทางโภชนบำบัด  รพ.จอมทอง</p>
      <p>ใช้งานใน รพ. : 
        
        <input name="hosp" type="text" id="hosp"  value="<?php echo $row['hosp']; ?>" size="15" />
      </p></th>
  </tr>
  <tr>
    <td colspan="5"><div align="center"><font size="-1">Assessment</font><font size="-1"> ID :
          <input style="text-align:center; background-color:#FFC" name="screen_id" type="text" id="screen_id" value="<?php echo $row['screen_id']; ?>" size="10" />
    </font></div></td>
  </tr>
  <tr>
    <td colspan="5"><font size="-1">คำนวนจาก : &nbsp;การประเมินด้วย&nbsp; <?PHP echo $adv; ?>&nbsp;ครั้งที่ : <?php echo $screenNo; ?>&nbsp;      &nbsp;
      
      &nbsp;เมื่อวันที่  : <?php echo $row['Tdate']; ?>&nbsp;</font></td>
  </tr>
  <tr>
    <td colspan="5"><div align="left">
      <dd><font size="-1">Name : <?php echo $row['Fname']; ?> <font size="-1">
        <input name="Fname" type="hidden" id="Fname" value="<?php echo $row['Fname']; ?>" size="2" />
      </font>&nbsp;&nbsp;<?php echo $row['Lname']; ?>&nbsp;<font size="-1">
      <input name="Lname" type="hidden" id="Lname" value="<?php echo $row['Lname']; ?>" size="2" />
      </font>&nbsp;&nbsp;&nbsp;HN:
            <input name="HN" type="text" id="HN" value="<?php echo $row['HN']; ?>" size="10" />
          AN: 
          <input name="AN" type="text" id="AN"  value="<?php echo $row['AN']; ?>" size="15" />
          อายุ : <?php echo $row['age']; ?><font size="-1">
          <input name="age" type="hidden" id="age" value="<?php echo $row['age']; ?>" size="2" />
          </font>&nbsp;&nbsp;เพศ : <?php echo $row['sex']; ?> <font size="-1">
          <input name="sex" type="hidden" id="sex" value="<?php echo  $row['sex']; ?>" size="2" />
          </font>&nbsp;&nbsp;&nbsp;<BR />
          &nbsp;Actual BW :<?php echo $bw; ?> &nbsp;&nbsp;Ideal BW :<?php echo $ibw; ?>&nbsp;&nbsp;BMI:<?php echo $bmi1; ?>&nbsp;&nbsp; </font></dd>
    </div>
      
      <div align="left"></div></td>
  </tr>
  <tr>
    <td colspan="5"><dd><font size="-1">ECOG score : <?php echo $ecog; ?></font>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><div align="left">
      <dd><font size="-1">Principle Diagnosis :</font><font size="-1" id="show7" color="">
        <input name="diag" type='text' id='diag'   style="text-align:left; background-color: #E8F6C9; text-indent:inherit " value="<?php echo $diag; ?>"  size="80" />
      </font></dd>
    </div></td>
  </tr>
  <tr>
    <td height="20" colspan="5"><div align="center"><font size="-1"> 
	<?php echo $adv;?><font id="show10" color="">
    <input  name="score1" type='text' id='score1' style="text-align:center; background-color:#CCF; text-shadow:#F33; size:auto; text-size:max-size"  value="<?php echo $row['score']; ?>"  size="5"  readonly="readonly" />
 </font> <br> แปลผล :&nbsp;<font style="border-color:#F30; background-color: " id="result2" size="+1" color="#3333FF">&nbsp;&nbsp;</font>&nbsp;<font color="">
<input name="level" type='text' id='result3' style="text-align:center; background-color:#CF9" value="<?php echo $row["risk"]; ?>"  size="40" readonly="readonly" />
</font> <font color="">
<input name="result1" type='text' id='result1' style="text-align:center; background-color:#CF9" value="<?php echo $result1; ?>"  size="20" readonly="readonly" />
</font><font color=""><br />
</font></font></div></td>
  </tr>
  <tr>
    <td height="20" colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td  bgcolor="#E1DBEC" height="20" colspan="3"><div align="center">Target Requirement</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="22%">
      <font color="">
      <label for="CAL"></label>
      <div align="center"><font size="-1">Calory Requirement 
        (kcal/d)</font><br /><input name="cal_req" type='text' id='cal_req' style="text-align:center; background-color: #E6E6E6 " value="<?php echo $row['cal_req']; ?>"  size="10" readonly="readonly" />
      </div>
      </font>
    <div align="center"></div>      <div align="left"></div></td>
    <td height="20"><div align="center"><font size="-1" color="">Volume requirement 
      (ml/d)<br /><input value="<?php echo $row['vol_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="vol_req" type='text' id='vol_req'  size="10" />
      </font><font size="-1"><font size="-1">
     
      </font></font></div>
    <div align="left"></div></td>
    <td width="20%" height="20"><div align="center"><font size="-1" color="">
      </font><font size="-1">Protein requirement</font> <font size="-1" color="">
        (gm/d)<br /><input name="prot_req" type='text' id='prot_req' style="text-align:center; background-color: #E6E6E6" value="<?php echo $row['prot_req']; ?>"  size="10" readonly="readonly" />
      </font></div>
    <div align="left"></div></td>
    <td width="19%"><div align="center"><font size="-1">Fat requirement</font><font size="-1" color="">
      (gm/d)<br /><input value="<?php echo $row['fat_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="fat_req" type='text' id='fat_req'  size="10" />
    </font></div></td>
    <td width="19%"><div align="center"><font size="-1">NPC:N ที่ควรได้</font><font size="-1" color="">
      <br /><input value="<?php echo $npc; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="npc" type='text' id='npc'  size="10" />
    </font></div></td>
  </tr>
  <tr>
    <td colspan="5"> 
      <table width="103%" border="0" align="center" cellpadding="2" cellspacing="2">
        <tr bgcolor="#EDEDED">
          <td bgcolor="#CCCCCC" colspan="4" scope="col"><div align="center">การรักษาที่ให้ ครั้งที่ 
            <input style="text-align:center; background-color:#FC9" name="treat_No" type="text" id="treat_no" value="<?php ECHO $row["treat_No"]; ?>" size="5" />
          Date : 
            <input name="Tdate" type="text" id="Tdate" placeholder="yyyy-mm-dd" value="<?php $today=date('Y-m-d');echo $today;?>" size="15" />
            <br />
          </div></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><div align="left">
            <p align="center">Nutrition support ที่ให้</p>
          </div></td>
          <td align="center" colspan="3"  scope="col">  สารอาหารและพลังงานที่ได้รับ</td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td valign="middle" width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" /> Enteral Nutrition :
            <label for="er"></label>
            <label for="pr1"></label>
            <div name="en1" id="en1">
              <?php
echo $row_en["nameE"];
?>
            </div>
<BR /> &nbsp;&nbsp;&nbsp;&nbsp;
ความเข้มข้น :
<label for="conc"></label><div id ="con"><?php echo $conc;?></div>
 
ปริมาณ :
<input style="text-align:center" name="er" type="text" id="er"  value="<?php echo $er;?>" size="5" />
(ml/d)  +น้ำ 
<input style="text-align:center" name="water" type="text" id="water" value="<?php echo $water;?>" size="5" />
ml/d</td>
          <td width="9%" align="right" scope="col">Total Cal =</td>
          <td width="13%" align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tcal" type="text" id="tcal" size="7" value="<?php echo $row["cal_gain"];?>" />
           <font size="-1"> (Kcal/d)</font></div></td>
          <td width="21%" align="left" scope="col"> =
            <input style="text-align:center" name="tcal2" type="text" id="tcal2" size="7" value="<?php echo $tcal2;?>" />
% <font size="-1">of Target</font></td>
        </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"> &nbsp;&nbsp;&nbsp;&nbsp;Other Enteral feeding :
            <input name="en2" type="text" id="en2" size="40" value="<?php echo $row["en2"];?>" /></td>
          <td align="right" scope="col">Protein =</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tprot" type="text" id="tprot" size="7" value="<?php echo $row["prot_gain"];?>" />
            <font size="-1">(g/d)</font></div>            <div align="center"></div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tprot2" type="text" id="tprot2" size="7" value="<?php echo $tprot2;?>" />
% <font size="-1">of Target</font></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" />Parenteral Nutrition 1 :
              <label for="pn4"></label><div id ="pn1"><?php echo $row_pn1["nameP"];?></div>
            Rate :
<input name="pr1" type="text" id="pr1"  value="<?php echo $pr1;?>" size="5" />
(ml/hr) </td>
          <td align="right" scope="col">Fat =</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tfat" type="text" id="tfat" size="7" value="<?php echo $row["fat_gain"];?>" />
            <font size="-1">(g/d)</font> </div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tfat2" type="text" id="tfat2" size="7" value="<?php echo  $tfat2;?>" />
% <font size="-1">of Target</font></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" />Parenteral Nutrition 2 :
          
<div id ="pn1"><?php echo $row_pn2["nameP"];?></div>
           
                
Rate :
<input name="pr2" type="text" id="pr2" value="<?php echo $pr1;?>" size="5" />
(ml/hr) </td>
          <td align="right" scope="col">N:NPC =</td>
          <td colspan="2" align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tNPC" type="text" id="tNPC" size="7" value="<?php echo $row["NPCratio"];?>" />
          </div></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;Other Parenteral
              :
            <input name="pn3" type="text" id="pn3" size="40" value="<?php echo $pn3;?>" /></td>
          <td align="right" scope="col">Volume=</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="vol" type="text" id="vol" size="7" value="<?php echo $row["vol_gain"];?>" />
            <font size="-1">(ml/d)</font></div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tvol" type="text" id="tvol" size="7" value="<?php echo $tvol;?>" />
            % <font size="-1">of Target</font></td>
          </tr>
        <tr>
          <td colspan="4" bgcolor="#CCCCCC"><div align="center">สัดส่วน Enteral feeding = 
            <input style="text-align:center" name="en_pn" type="text" id="en_pn" size="7" value="<?php echo $row["en_ratio"];?>" />
            % ของ  Required Calory ====&gt; 
            <input style="text-align:center" name="en_pn2" type="text" id="en_pn2" size="35" value="<?php echo $row["en_pn2"];?>" />
            <p><font  id='sum'></font></p>
          </div></td>
        </tr>
        </table>
   </td>
  </tr>
  <tr>
    <td colspan="5"><p align="center"><font id="show12" color="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>แพทย์ : <font id="show11" color="">
        <input name="doctor" type='text' id='doctor' style="text-align:center; background-color: #FFC; border-top:#933" value="<?php echo $doctor;?>"  size="25" readonly="readonly" />
      </font> </p></td>
  </tr>
  <tr>
    <td bgcolor="#C8F1A0" colspan="5"><div align="center">
   <input onclick="javascript:window.print() " type="submit" name="prnt" id="prnt" value="print" />

     
    </div></td>
  </tr>
 
</table>


</div>

</body>
</html>


