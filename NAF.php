
<?php

include 'common.php';

if(!is_usr())
{
header("location:index.php");
}

if(session::is('hn'))
$HN = session::get();
else
header("location:screening.php");

$row_patient = patient_wrapper::load_by_hn($HN);

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $row_patient['hid'] . "'"));

$hospital = db::arr($ward);

$ward = db::select(array("tbl" => "department", "where" => "hid='" . $row_patient['hid'] . "'"));

$row_ward = db::arrs($ward);
$totalRows_ward = db::num($ward);

$ward = db::select(array("tbl" => "doctor"));

$row_doctor = db::arrs($ward);
$totalRows_doctor = db::num($ward);

$reporter = u::is("Fname")?u::get()." ":"";
$reporter .= u::is("Lname")?u::get():"";

$row_ID = 1;

$res = db::select(array("tbl" => "naf"));

if($res->num_rows > 0)
{
$arr = db::arrs($res);

$row_ID = $arr[sizeof($arr)-1]["screenid"]+1;
}

$BW= "";
$HT= "";
$AN="";
$BMI = "";
if(session::is("triagent"))
{
    $triagent = session::get();
    $BW= floatval($triagent["BW"]);
$HT= floatval($triagent["HT"]);
$AN=$triagent["AN"];
$BMI=floatval(($BW*10000)/($HT*$HT));
if( $row_patient['sex']=="male"){$IBW=(50+(0.91*($HT-152.4)));}else if( $row_patient['sex']=="female"){$IBW=45.5+(0.91*($HT-152.4));}

    
}

$freq = db::select(array("tbl" => "naf","where"=>"HN='".$HN."'"));
 
$row_freq = db::num($freq)+1;

if (u::is("hid"))
    $hid = u::get();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="NAF.js"></script>

<title>Untitled Document</title>


</head>
<link href="bootstrap/css/bootstrap.css"
    rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap-theme.css"
    rel="stylesheet" type="text/css" />
    
<body>
<div class="container">
<table width="89%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td><form id="form" name="form">
      <div align="right">
        <table width="83%" border="0" align="center" cellpadding="2" cellspacing="2">
        <tr>
          <td colspan="2" ><div style="background-color:" align="right">
            <div align="right">
              <table width="83%" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td colspan="2" ><div style="background-color:" align="right">
                  <div align="right">
                    <table width="83%" border="0" align="center" cellpadding="2" cellspacing="2">
                    <tr>
                      <td colspan="2" ><div style="background-color:" align="right">
                        <div align="right">
                          <table width="83%" border="0" align="center" cellpadding="2" cellspacing="2">
                          <tr>
                            <td colspan="2" ><div style="background-color:" align="right">
                              <div align="right">
                                <table width="850" border="0" align="center" cellpadding="2" cellspacing="2">
                                  <tr>
                                    <th  bgcolor="#FCD9C3" colspan="2" scope="col"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a></div></th>
                                  </tr>
                                  <tr>
                                    <th align="center" valign="middle"   bgcolor="#669966" colspan="2" scope="col"><div align="center"><font class="img-rounded" size="+1"    color="#333399" style="background-color: #98CE74; vertical-align:central">&nbsp;&nbsp;&nbsp;&nbsp;แบบประเมินภาวะทุพโภชนาการ NAF โรงพยาบาล 
                                      <input class="img-rounded" readonly="readonly" style="border:none; font-size:14px; text-align:center" maxlength="9" name="hosp2" type="text" id="hosp2" value="<?php echo  $hospital['hosName'];?>" size="20" />
                                      &nbsp;&nbsp;&nbsp;&nbsp;</font></div></th>
                                  </tr>
                                  <tr>
                                    <td align="center"  colspan="2">Assessment No.
                                     
                                      <input readonly="readonly" style="background-color: #F0E4D1; text-align:center; border:none" name="ID" type="text" id="id" value="<?php echo $row_ID; ?>"  size="15" />
                                      
                                      
                                      ประเมินครั้งที่ :
                                      
                                      <input readonly="readonly" style="text-align:center; background:#D3E3F3; border:none " name="screenNo" type="text" id="screenNo" value="<?php echo $row_freq;?>" size="5" /> &nbsp;&nbsp;</td>
                                  </tr>
                                  <tr bgcolor="#F5F5F5">
                                    <td colspan="2">ชื่อ:
                                      <input style="background-color:#F2F2F2" readonly="readonly" name="fname" type="text" id="fname" value="<?php echo $row_patient['Fname']; ?>" />
                                      นามสกุล :
                                       <input style="background-color:#F2F2F2"readonly="readonly" name="lname" type="text" id="lname" value="<?php echo $row_patient['Lname']; ?>" />
                                      HN :
                                      <label for="HN"></label>
                                      <input style="background-color:#F2F2F2 "readonly="readonly" maxlength="9" name="HN" type="text" id="HN" value="<?php echo $row_patient['HN']; ?>" size="15" />
AN:
<input placeholder="ผู้ป่วยนอกใส่ 0" onblur="next1()"  maxlength="9" name="AN" type="text" id="AN"   size="15" value ="<?php echo $AN;?>" /></td>
                                  </tr>
                                  <tr bgcolor="#F5F5F5">
                                    <td colspan="2">Age :
                                      <input  readonly="readonly" maxlength="3" style="text-align:center;background-color:#F2F2F2"   name="age" type="text" id="age" value="<?php echo $row_patient['age']; ?>" size="10" />
                                      Sex:
                                      <input style="background-color:#F2F2F2 "readonly="readonly" maxlength="6"  name="sex" type="text" id="sex" value="<?php echo $row_patient['sex']; ?>" size="10" />
                                      Date:
                                      
                                      <input style="background-color:#F2F2F2 "readonly="readonly" placeholder="yyyy-mm-dd" name="screenDate" type="text" id="screenDate" size="15" value="<?php $today=date('Y-m-d');echo $today;?>" />
                                      Warrd :
                                     
                                      <select onblur="next2()" onchange="next2()" name="ward" id="ward" title="<?php echo $row_triageData['ward']; ?>">
                                        <?php
do { 
    $c = current($row_ward);
?>
                                        <option value="<?php echo $c['dptname']?>"<?php if (!(strcmp($c['dptname'], "-"))) {echo "selected=\"selected\"";} ?>><?php echo $c['dptname']?></option>
                                        <?php
} while (next($row_ward));
  
?>
                                      </select></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" bgcolor="#EAEAEA"  style="border-color:#FC6">คำนวน BMI และ Ideal BW : <font   color="">&nbsp;</font> <font   color="">IBW =<font id="idw1" color="#CC3300">&nbsp;</font>&nbsp;
                                      <input readonly="readonly" style="text-align:center; background-color: #DFDFDF"    name="IBW" type='text' id='IBW'  size="8" />
                                      kg. </font>&nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td  colspan="2"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principle Diagnosis :<font id="show3" color="">
                                      <input   style="text-align:left; background-color: #FFF4CE; text-indent:inherit; border-color: #99F" onblur="next4()" name="diag" type='text' id='diag'  size="80" />
                                      </font></div></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#E5E5E5" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ECOG Score :
                                      <select onchange="next5()"   name="ecog" id="ecog">
                                        <option value="-">-</option>
                                        <option value=0>ทำกิจกรรมต่างๆได้ปกติ</option>
                                        <option value=1>ทำงานหรือกิจกรรมเบาๆได้ เช่นงานบ้าน งานใน office</option>
                                        <option value=2>เคลื่อนไหวได้ ช่วยเหลือตัวเองได้ แต่ทำงานไม่ได้ นั่งยืนได้มากกว่า 50% ขณะตื่น</option>
                                        <option value=3>ติดเตียง ช่วยตัวเองพอได้ นอนมากกว่า 50% ของช่วงเวลาตื่น</option>
                                        <option value=4>ช่วยเหลือตัวเองไม่ได้ ติดตเตียง-ล้อเข็น</option>
                                      </select></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#E5E5E5" colspan="2"><p>1.)
                                      
                                      
                                      ส่วนสูง/ความยาวลำตัว /ความยาวช่วงแขนจากปลายนิ้วกลางทั้ง 2 ข้าง (Arm span) 
                                    </p></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#E5E5E5" colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                      <tr>
                                        <td width="7%">&nbsp;</td>
                                        <td width="51%">1.1)วัดความยาวลำตัว<font   color="">
                                        <input   name="length" type='text' id='length' placeholder="ใส่เมื่อไม่รู้ความสูง" value="0" size="10" align="middle" />
cm.</font></td>
                                        <td width="42%">1.2 )Arm span <font   color="">
                                        <input  name="arm" type='text' id='arm' placeholder="ใส่เมื่อไม่รู้ความสูง" value="0" size="10" align="middle" />
cm. </font></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td colspan="2">1.3) ความสูง(High) : <font   color=""> 
                                          <input onclick="JavaScript:show1(this);" type="radio" name="ht1" value="1" id="ht1" />
                                          </font>วัดได้<font   color="">
                                            <input onclick="JavaScript:show1(this);" type="radio" name="ht1" value="2" id="ht2" />
                                            </font>ญาติบอก<font   color="">
                                              :
                                              <input style="text-align:center"    onchange="bws()"     name="ht" type='text' id='ht' size="8" value="<?php echo $HT;?>" />
                                              <input  style="text-align:center"     name="ht_tell" type='text' id='ht_tell' size="8" />
                                              cm</font>.</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td width="83%"  bgcolor="#A4CAEC"><p>2.) น้ำหนักและดัชนีมวลกาย &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;ทราบน้ำหนักตัวหรือไม่ 
                                        <input onClick="JavaScript:show(this);" type="radio" name="bw3" value="1" id="bw3_0" />
                                            ทราบ</label>
                                      
                                            <input onClick="JavaScript:show(this);" type="radio" name="bw3" value="2" id="bw3_1" />
                                            ไม่ทราบ</label>
                                    </p>
                                      <div id="bwdiv" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  BW:
                                        
                                        <input  onchange="bws()"  name="bw" type='text' id='bw' size="8" value="<?php echo $BW;?>" />
                                        k
                                        
                                        g.  </font>วิธีการชั่ง :
                                        <select onchange="bws()" style="text-align:center; border:none"     name="wt_method" id="wt_method">
                                          <option  value="-">-</option>
                                          <option value="3">ชั่งท่านอน(1)</option>
                                          <option value="2">ชั่งท่ายืน(0)</option>
                                          <option value="1">ชั่งไม่ได้(0)</option>
                                          <option value="0">ญาติบอก(0)</option>
                                        </select>
                                        BMI :
                                        =
                                        <input readonly="readonly" style="text-align:center; background-color: #DFDFDF"    name="bmi" type='text' id='bmi'  size="8" value="<?php echo $BMI;?>" />
                                      </div>
                                    <div id="text" align="left"> - หากไม่ทราบน้ำหนักให้ระบุค่า albumin หรือ Total Lymphocyte Count (TLC)</div>
                                      <div id="albdiv" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Albumin level : =<font   color="">
                                        <input   onclick="wbcdis()"   name="alb" type='text' id='alb' size="8" />
                                      </font>g/dl
                                    </div>
                                      <div id="wbcdiv" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WBC=<font   color="">
                                        <input onclick="albdis()"   name="wbc" type='text' id='wbc' size="8" />
                                        </font> %Lymphocyte=<font   color="">
                                          <input  onclick="albdis()" name="lymp" type='text' id='lymp' size="8" />
                                          </font>; TLC = <font   color="">
                                            <input style="background-color:#DEDEDE" readonly="readonly"  onblur="bmi()" name="TLC" type='text' id='TLC' size="8" />
                                      </font>cells/ml
                                      <br />
                                      </div>
                                      <div id="lab"></div>
                                      
                                      
                                  </p></td>
                                    <td bgcolor="#A4CAEC" ><div style="background-color: #E8F2F1" align="right"><div align="center"><strong>BMI</strong><font color=""><strong> score<br /> </strong>
                                          <input name="bmi_s" type='text' id='bmi_s' style="text-align:center; background-color:#CF9"  value="0"  size="10" readonly="readonly" />
                                    </font></div>
                                    </div></td>
                                  </tr>
                                  <tr bgcolor="#D1F8C3">
                                    <td   >3.)รูปร่างของผู้ป่วย : 
                                      <select style="text-align:center; border:none"     name="shape" id="shape">
                                        <option  value="-">-</option>
                                        <option value="3">ผอมมาก(2)</option>
                                        <option value="2">ผอม(1)</option>
                                        <option value="1">อ้วนมาก(1)</option>
                                        <option value="0">ปกติ-อ้วนปานกลาง(0)</option>
                                      </select></td>
                                    <td   ><div align="center">Shape score<span style="background-color: #E8F2F1"><font color=""><br />
                                      <input name="shape_s" type='text' id='shape_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </font></span></div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#EEEBAC"> 4.) ประวัติน้ำหนักที่เปลี่ยนแปลงใน 4 สัปดาห์ : 
                                      <select style="text-align:center; border:none"     name="wt_change" id="wt_change">
                                        <option  value="-">-</option>
                                        <option value="3">ลดลง/ผอมลง(2)</option>
                                        <option value="2">เพิ่มขึ้น/อ้วนขึ้น(1)</option>
                                        <option value="1">ไม่ทราบ(0)</option>
                                        <option value="0">คงเดิม(0)</option>
                                      </select></td>
                                    <td width="17%" bgcolor="#EEEBAC"><div style="background-color: #E8F2F1" align="right"> <div align="center"><strong>Wt loss score </strong><br />
<input  name="wt_s" type='text' id='wt_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div>
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#DDDFF7">5.) อาหารที่กินในช่วง 2 สัปดาห์ที่ผ่านมา
                                      : 
                                      <label for="diet_cal"></label>
                                      <label for="intake"><br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลักษณะอาหาร : 
                                        <select  style="text-align:center; border:none"     name="diet_type" id="diet_type">
                                          <option  value="-">-</option>
                                          <option value="3">อาหารนา้ๆ(2)</option>
                                          <option value="2">อาหารเหลวๆ(2)</option>
                                          <option value="1">อาหารนุ่มกว่าปกติ(1)</option>
                                          <option value="0">อาหารเหมอืนปกติ(0)</option>
                                        </select>
                                        <br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปริมาณที่กิน :
                                        <select style="text-align:center; border:none"     name="diet_qnt" id="diet_qnt">
                                          <option  value="-">-</option>
                                          <option value="3">กินนอ้ยมาก(2)</option>
                                          <option value="2">กินนอ้ยลง(1)</option>
                                          <option value="1">กินมากข้นึ (0)</option>
                                          <option value="0">กินเท่าปกติ(0)</option>
                                        </select>
                                      </label></td>
                                    <td bgcolor="#DDDFF7"><div style="background-color: #E8F2F1" align="right"> <div align="center"><strong>Diet score</strong><br /><input   name="diet_s" type='text' id='diet_s' style="text-align:center; background-color:#CF9" value="0"  size="10" readonly="readonly" />
                                    </div>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#F5D5E1"><p>6.) อาการต่อเนื่อง &gt; 2 สัปดาห์ที่ผ่านมา (เลือกได้มากกว่า 1 ข้อ)
                                      
                                      :
                                      
                                    </p></td>
                                    <td rowspan="2" bgcolor="#F5D5E1"><div style="background-color: #E8F2F1" align="right"> <div align="center"><strong>GI symptom score</strong>
                                          <input  name="gi_s" type='text' id='gi_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" /></div>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#F5D5E1"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                      <tr>
                                        <td valign="top" width="234">&nbsp;6.1ปัญหาการเคี้ยว/กลีนอาหาร                                    </td>
                                        <td valign="top" width="109"><input onclick="chksw1()"  type="checkbox" name="sw1" id="sw1" value="2" />
                                          <label for="tsw1"></label>
สำลัก(2)</td>
                                        <td width="163"><input  onclick="chksw2()"  type="checkbox" name="sw2" id="sw2" value="1" />
                                          <label for="sw2"></label>
เคี้ยว/กลีนลำบาก/<br />ได้อาาหารทางสาย(2)</td>
                                        <td valign="top" width="124"><input onclick="chksw3()" type="checkbox" name="sw3" id="sw3" value="0" />
กลืนไดป้กติ(0)
  <label for="sw3"></label></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;6.2ปัญหาระบบทางเดินอาหาร </td>
                                        <td><input onclick="chkGI1()" type="checkbox" name="GI1" id="GI1" value="2" />
                                          
ทอ้งเสีย(2)</td>
                                        <td><input onclick="chkGI2(this.value)" type="checkbox" name="GI2" id="GI2" value="1" />
                                         
ปวดท้อง(2) </td>
                                        <td><input onclick="chkGI3(this.value)" type="checkbox" name="GI3" id="GI3"  value="0"/>
                                         
ปกติ(0) </td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;6.3ปัญหาระหว่างกินอาหาร </td>
                                        <td><input onclick="chkvom1()" type="checkbox" name="vom1" id="vom1" value = '1' />
                                          <label for="tsw3"></label>
อาเจียน(2)</td>
                                        <td><input onclick="chkvom2()" type="checkbox" name="vom2" id="vom2"  value ='2'/>
                                          <label for="swallow5"></label>
คลื่นไส้(2) </td>
                                        <td><input onclick="chkvom3()" type="checkbox" name="vom3" id="vom3" value = '3' />
                                          <label for="swallow10"></label>
ปกติ(0) </td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#D8F6CE" >7.) ความสามารถในการ เข้าถึงอากหาร 
                                      
:
<select style="text-align:center; border:none"  name="status" id="status">
  <option value="-">-</option>
  <option value="3">นอนติดเตียง(2)</option>
  <option value="2">ต้องมีผู้ชาวยบ้าง (1)</option>
  <option value="1">นั่งๆนอนๆ(0)</option>
  <option value="0">ปกติ(0)</option>
</select></td>
                                    <td bgcolor="#D8F6CE"><div style="background-color: #E8F2F1" align="right"> 
                                      <div align="center"><strong>Status score</strong><br />
                                        <input  name="status_s" type='text' id='status_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                      </div>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#F1D9D1">8.)โรคที่เป็นอยู่ (เลือกได้มากกว่า 1 ข้อ):
                                      <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                        <tr>
                                          <td valign="top" width="24%"><label>
                                            <input onclick="chkdis1()" type="checkbox" name="dm" value="3" id="dm" />
                                            DM (3)<br />
                                            <input onclick="chkdis2()" type="checkbox" name="ca" value="3" id="ca" />
                                            Solid cancer  (3)<br />
                                            <input onclick="chkdis3()" type="checkbox" name="hip" value="3" id="hip" />
                                            Hip fracture  (3)<br />
                                            <input onclick="chkdis4()" type="checkbox" name="cva" value="6" id="cva" />
                                            Stroke/CVA(6)<br />
                                            <input onclick="chkdis5()" type="checkbox" name="mulfx" value="6" id="mulfx" />
                                            Multiplefracture(6)<br />
                                          </label></td>
                                          <td valign="top" width="35%"><p>
                                            <label>
                                              <input onclick="chkdis6()" type="checkbox" name="ckd" value="3" id="ckd" />
                                              CKD-ESRD (3)
                                              <br />
                                              <input  onclick="chkdis7()" type="checkbox" name="chf" value="3" id="chf" />
                                              Chronic heart failure  (3) </label>
                                            <br />
                                            
                                            <input onclick="chkdis8()" type="checkbox" name="copd" value="3" id="copd" />
                                            COPD (3)
                                            <br />
                                            <input onclick="chkdis9()" type="checkbox" name="sepsis" value="3" id="sepsis" />
                                            Septicemia(3)<br />
                                            <input onclick="chkdis10()" type="checkbox" name="hemato" value="6" id="hemato" />
                                            Malignanthematologicdisease/ Bonemarrowtransplant (6) </p></td>
                                          <td valign="top" width="41%"><label>
                                            <input onclick="chkdis11()" type="checkbox" name="liver" value="3" id="liver" />
                                            CLD/Cirrhosis/Hepatic encephalopathy (3)
                                            <br />
                                            <input onclick="chkdis12()" type="checkbox" name="hi" value="3" id="hi" />
                                            Severe head injury  (3) <br/>
  <input onclick="chkdis13()" type="checkbox" name="burn" value="3" id="burn" />
  &gt; 2nd degree burn  (3)<br />
  <input onclick="chkdis14()" type="checkbox" name="pneumo" value="3" id="pneumo" />
                                            Severe pneumonia(6) </label>
                                            <br />
                                            <input onclick="chkdis15()" type="checkbox" name="critical" value="6" id="critical" />
                                            Critically ill(ผู้ป่วยวิกฤติ)(6) </td>
                                          </tr>
                                        </table>
                                      <p><br />
                                        </p></td>
                                    <td bgcolor="#F1D9D1"><div style="background-color: #E8F2F1" align="right">
                                      <div align="center">Diseases<strong> score</strong><br /><input  name="dis_s" type='text' id='dis_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div>
                                      </div></td>
                                  </tr>
                                  <tr align="right">
                                    <td ><label for="spinal"></label>
                                      <label for="spinal"></label>
                                      <div align="left">
                                        <div style="background-color: #E8F2F1" align="right"></div>
                                      </div></td>
                                    </tr>
                                  <tr align="right">
                                   
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#FFCC99" align="center" colspan="2"><p>&nbsp;NAF Score = <font id="show" color="">
                                      <input   name="score" type='text' id='score' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size" value="0"  size="8"  readonly="readonly" />
                                      </font> ICD-10 :<font id="show4" color="">
                                      <input   name="icd" type='text' id='icd' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size"  size="10"  readonly="readonly" />
                                      </font><br />
                                      แปลผล
                                      :<font id="show2" color="">
                                        <input  name="level" type='text' id='level' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size"  size="50"  readonly="readonly" />
                                        </font>ข้อแนะนำ :<font color="">
                                        <input name="result1" type='text' id='result1' style="text-align:center; background-color: #FAFAFA; width:auto "  size="40" readonly="readonly" />
                                        </font></p></td>
                                  </tr>
                                  <tr>
                                    <td align="center" colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                      <tr>
                                        <th bgcolor="#FEEFF7" scope="col">Calory Requirement (Kcal/d) 
                                        <br /><font color="">
                                            <input readonly="readonly" style="text-align:center; background-color: #EBEBEB " name="cal_req" type='text' id='cal_req'  size="10" />
                                            <font id="cal"></font></font><font color=""><BR />
                                            <input readonly="readonly" style="text-align:center; background: #EAFEE4" name="cal_req2" type='text' id='cal_req2'  size="20" />
                                            </font><font color=""><br />
                                            </font>
                                         
                                        </th>
                                        <th bgcolor="#D5EBFC" scope="col">Protein requirement (gm/d)
                                          <font color="">
                                            <br /> <input readonly="readonly" style="text-align:center; background-color: #EBEBEB" name="prot_req" type='text' id='prot_req'  size="10" />
                                            <font id="prot"></font></font><font color="">
                                            <br /><input readonly="readonly" style="text-align:center; background-color: #EAFEE4" name="prot_req2" type='text' id='prot_req2'  size="20" />
                                            </font></th>
                                        <th bgcolor="#E6F5B6" scope="col"><p>Fat<font color=""> requirement (</font>gm<font color="">/d)</font>
                                          <font color="">
                                           <br /> <input readonly="readonly" style="text-align:center; background-color: #EBEBEB " name="fat_req" type='text' id='fat_req'  size="10" />
                                            <font id="vol2"></font></font><font color=""> <br />
                                             <input readonly="readonly" style="text-align:center; background-color: #EAFEE4 " name="fat_req2" type='text' id='fat_req2'  size="20" />
                                            </font>
                                          </th>
                                        <th bgcolor="#E6F5B6" scope="col"><font color="">Volume requirement (ml/d)</font><font color="">
                                            <br /><input readonly="readonly" style="text-align:center; background-color: #EBEBEB " name="vol_req" type='text' id='vol_req'  size="10" />
                                            <font id="vol"></font></font><font color="">
                                            <input readonly="readonly" style="text-align:center; background-color: #EAFEE4 " name="vol_req2" type='text' id='vol_req2'  size="20" />
                                            </font></th>
                                        <th bgcolor="#EBE1FF" scope="col">NPC:N ที่ควรได้
                                         <font color="">
                                           <br /> <input readonly="readonly" style="text-align:center; background-color: #EBEBEB" name="npc" type='text' id='npc'  size="10" />
                                          </font><font color="">
                                          <input readonly="readonly" style="text-align:center; background-color:#EAFEE4" name="npc2" type='text' id='npc2'  size="25" />
                                          </font></th>
                                      </tr>
                                      <tr>
                                        <td colspan="5"><div align="center"><em><a href="/nutrition/file/file_download/program_guide.docx"></a></em> </div></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td align="center" colspan="2">แพทย์ :
                                      <select  name="doctor" id="doctor">
                                        <?php
do {  
    $c = current($row_doctor);
?>
                                        <option value="<?php echo $c['Fname'].'  '.$c['Lname']?>"><?php echo $c['Fname'].'  '.$c['Lname']?></option>
                                        <?php
} while (next($row_doctor));
 
?>
                                      </select>
                                                                           ผู้รายงาน :<input readonly="readonly" style="text-align:center; background-color:#EAFEE4" type='text' id='reporter'size="25" value ="<?php echo $reporter;?>" />

                                      </td>
                                  </tr>
                                  <tr>
                                    <td align="center" colspan="2"><div style="width:20; background-color: #F3C9B7">
                                      <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                        <tr>
                                          <td width="32%">&nbsp;</td>
                                          <td width="41%"><div style="background-color: #C1D3F1" align="center">
                                            <input  type="submit" name="save" id="save" value="save" />
                                          </div></td>
                                          <td width="27%">&nbsp;</td>
                                        </tr>
                                      </table></div></td>
                                  </tr>
                                  <tr>
                                     <td style="visibility:collapse"  colspan="2"  ><div  align="left"><font   color="">
                                      <input style="background-color:#CFF" name="bw_s" type='text' id='bw_s'  onblur="bmi()" onclick="wbcdis()" value="0" size="3" />
                                    </font><font   color="">
                                    <input  style="background-color:#CFF"name="alb_s" type='text' id='alb_s'  onblur="bmi()" onclick="wbcdis()" value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#CFF" name="wbc_s" type='text' id='wbc_s'  onblur="bmi()" onclick="wbcdis()" value="0" size="3" />
                                    </font><font   color="">
                                      <input  name="tsw1" type='text' id='tsw1' value="0" size="3" />
                                      <input  name="tsw2" type='text' id='tsw2' value="0" size="3" />
                                      <input  name="tsw3" type='text' id='tsw3' value="0" size="3" />
                                      <input style="background-color:#FCF"  name="sw_s" type='text' id='sw_s' value="0" size="3" />
<input  name="tgi1" type='text' id='tgi1' value="0" size="3" />
                                    </font><font   color="">
                                    <input  name="tgi2" type='text' id='tgi2' value="0" size="3" />
                                    </font><font   color="">
                                    <input  name="tgi3" type='text' id='tgi3' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FCF"  name="tgi_s" type='text' id='tgi_s' value="0" size="3" />
                                    <input  name="tvom1" type='text' id='tvom1' value="0" size="3" />
                                    </font><font   color="">
                                    <input  name="tvom2" type='text' id='tvom2' value="0" size="3" />
                                    </font><font   color="">
                                    <input  name="tvom3" type='text' id='tvom3' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FCF"  name="tvom_s" type='text' id='tvom_s' value="0" size="3" />
                                    <input  name="tdiet_type" type='text' id='tdiet_type' value="0" size="3" />
                                    </font><font   color="">
                                    <input  name="tdiet_qnt" type='text' id='tdiet_qnt' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tdm" type='text' id='tdm' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tca" type='text' id='tca' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="thip" type='text' id='thip' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tcva" type='text' id='tcva' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tmulfx" type='text' id='tmulfx' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tckd" type='text' id='tckd' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tchf" type='text' id='tchf' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tcopd" type='text' id='tcopd' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tsepsis" type='text' id='tsepsis' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="themato" type='text' id='themato' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tliver" type='text' id='tliver' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="thi" type='text' id='thi' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tburn" type='text' id='tburn' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tpneumo" type='text' id='tpneumo' value="0" size="3" />
                                    </font><font   color="">
                                    <input style="background-color:#FFC"  name="tcritical" type='text' id='tcritical' value="0" size="3" />
                                    </font></div></td>
                                  </tr>
                                  <tr>
                                  
                                    <td colspan="2"><div align="center"><em><a href="/hospital/screening.php">Back to home</a><a href="/nutrition/file/file_download/program_guide.docx"></a></em></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><div align="center"><a href="/hospital/screening.php"></a><em><a href="/nutrition/file/file_download/program_guide.docx"><strong><font size="-1">ดู References สำหรับการคำนวนต่างๆในโปรแกรม)</font></strong></a></em></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><div align="center"><a href="/nutrition/file/file_download/NAF.pdf">Download แบบฟอร์ม Modified NAF</a></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><div align="center"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></div></td>
                                  </tr>
                                </table>
                                <p>&nbsp;</p>
                              </div>
                              </div></td>
                          </tr>
                          </table>
                        </div>
                        </div></td>
                    </tr>
                    </table>
                  </div>
                  </div></td>
              </tr>
              </table>
            </div>
            </div></td>
        </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </div>
    </form></td>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>
