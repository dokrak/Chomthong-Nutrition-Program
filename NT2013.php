<?php
include 'common.php';

if(!is_usr())
{
header("location:index.php");
}

$reporter = u::is("Fname")?u::get()." ":"";
$reporter .= u::is("Lname")?u::get():"";

$reporter = trim($reporter);

if (u::is("hid"))
    $hid = u::get();

if(session::is('hn'))
{
   
$HN = session::get();
}
else
header("location:screening.php");
//session::un_set('hn');
//echo $HN;

$row_patient = patient_wrapper::load_by_hn($HN);

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $row_patient['hid'] . "'"));

$hospital = db::arr($ward);

if(session::is("triagent"))
{
    $triagent = session::get();
$msg="<script>alert'".$triagent."';</script>";
echo $msg;
}
/*
$query_countID = "SELECT count(screenid) FROM nt2013";
$countID = mysql_query($query_countID, $nutrition) or die(mysql_error());
$row_countID = mysql_fetch_assoc($countID);
$totalRows_countID = mysql_num_rows($countID);
*/
$ward = db::select(array("tbl" => "department", "where" => "hid='" . $row_patient['hid'] . "'"));

$row_ward = db::arrs($ward);
$totalRows_ward = db::num($ward);

$ward = db::select(array("tbl" => "doctor"));

$row_doctor = db::arrs($ward);
$totalRows_doctor = db::num($ward);

$ID = db::select(array("tbl" => "nt2013"));
$row_ID = db::arrs($ID);

$row_ID = $row_ID[sizeof($row_ID)-1]["screenid"]+1;

$freq = db::select(array("tbl" => "nt2013","where"=>"HN='".$HN."'","order"=>"screenid"));
$row_freq = db::num($freq)+1;

$BW= "";
$HT= "";
$AN="";
$BMI="";
$IBW="";

if(session::is("triagent"))
{
    $triagent = session::get();
    
    $BW= floatval($triagent["BW"]);
$HT= floatval($triagent["HT"]);
$AN=$triagent["AN"];
$BMI=floatval(($BW*10000)/($HT*$HT));

if( $row_patient['sex']=="male")
{$IBW=(50+(0.91*($HT-152.4)));
}else if( $row_patient['sex']=="female")
	{$IBW=45.5+(0.91*($HT-152.4));
	}

    
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="NT2013.js"></script>
<title>NT2013</title>

</head>

<body>
<table width="89%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td><form id="form" name="form" action="#">
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
                                    <th  bgcolor="#FCD9C3" colspan="4" scope="col"><p><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a></p>
                                      <p><input  style="border:none; background-color:#D3E3F3; text-align:center" maxlength="9" name="hid" type="text" id="hid" value="<?PHP echo $hid; ?>" size="20" /></p></th>
                                  </tr>
                                  <tr>
                                    <th  bgcolor="#FF9933" colspan="4" scope="col"><font size="+1"    color="#333399" style="background-color: #FC6">&nbsp;&nbsp;&nbsp;&nbsp;แบบประเมินภาวะทุพโภชนาการ NT-2013 โรงพยาบาล  
                                        <input readonly="readonly" style="border:none; background-color:#D3E3F3; text-align:center" maxlength="9" name="hosp" type="text" id="hosp" value="<?php echo $hospital['hosName'];?>" size="20" />
                                      &nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                                  </tr>
                                  <tr>
                                    <td align="center"  colspan="4">Assessment No.
                                     
                                      <input readonly="readonly" style="background-color: #F0E4D1; text-align:center; border:none" name="ID" type="text" id="id" value="<?php echo $row_ID; ?>"  size="15" />
                                      
                                      
                                      ประเมินครั้งที่ :
                                      
                                      <input readonly="readonly" style="text-align:center; background:#D3E3F3; border:none " name="screenNo" type="text" id="screenNo" value="<?php echo $row_freq;?>" size="5" /> &nbsp;&nbsp;</td>
                                  </tr>
                                  <tr bgcolor="#F5F5F5">
                                    <td colspan="4">ชื่อ:
                                      <input style="background-color:#F2F2F2" readonly="readonly" name="fname" type="text" id="fname" value="<?php echo $row_patient['Fname']; ?>" />
                                      นามสกุล :
                                       <input style="background-color:#F2F2F2"readonly="readonly" name="lname" type="text" id="lname" value="<?php echo $row_patient['Lname']; ?>" />
                                      HN :
                                      <label for="HN"></label>
                                      <input  style="background-color:#F2F2F2 "readonly="readonly" maxlength="15" name="HN" type="text" id="HN" value="<?php echo $row_patient['HN']; ?>" size="15" />
AN:
<input placeholder="ผู้ป่วยนอกใส่ 0" onblur=""  maxlength="9" name="AN" type="text" id="AN"   size="15" value="<?php echo $AN;?>" /></td>
                                  </tr>
                                  <tr bgcolor="#F5F5F5">
                                    <td colspan="4">Age :
                                      <input  readonly="readonly" maxlength="3" style="text-align:center;background-color:#F2F2F2"   name="age" type="text" id="age" value="<?php echo $row_patient['age']; ?>" size="10" />
                                      Sex:
                                      <input style="background-color:#F2F2F2 "readonly="readonly" maxlength="6"  name="sex" type="text" id="sex" value="<?php echo $row_patient['sex']; ?>" size="10" />
                                      Date:
                                      
                                      <input style="background-color:#F2F2F2 "readonly="readonly" placeholder="yyyy-mm-dd" name="screenDate" type="text" id="screenDate" size="15" value="<?php $today=date('Y-m-d');echo $today;?>" />
                                      Warrd :
                                      <label for="ward2"></label>
                                      <select onblur="next2()" onchange="next2()" name="ward" id="ward2" title="<?php echo $row_triageData['ward']; ?>">
                                        <?php
                                                    do {
                                                        $c = current($row_ward);
                                                        ?>
                                                        <option value="<?php echo $c['dptname'] ?>"><?php echo $c['dptname'] ?></option>
                                                        <?php
                                                    } while (next($row_ward));
                                                    ?>
                                      </select></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" bgcolor="#EAEAEA"  style="border-color:#FC6">คำนวน BMI และ Ideal BW </td>
                                  </tr>
                                  <tr>
                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actual BW <font   color="">:
                                            <input  name="bw" type='text' id='bw' size="8" value="<?php echo $BW;?>" />
                                      Kg. Ht :
                                      <input   name="ht" type='text' id='ht' size="8" value="<?php echo $HT;?>" />
                                      cm.</font>&nbsp; <font   color="">Usual BW :
                                        <input placeholder="ไม่ทราบไม่ต้องใส่" style="background-color:#DEF3D6"  onblur="next3()" name="UBW" type='text' id='UBW' size="8" />
                                        &nbsp;</font> <font   color="">IBW =<font id="idw1" color="#CC3300">&nbsp;</font>&nbsp;
                                          <input readonly="readonly" style="text-align:center; background-color: #DFDFDF"    name="IBW" type='text' id='IBW'  size="8" />
                                          kg. </font>&nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp; &nbsp;BMI = &nbsp;&nbsp;&nbsp;
                                      <input    name="bmi" type='text' id='bmi' style="text-align:center; background-color: #DFDFDF" value="<?php echo $BMI;?>"  size="8" readonly="readonly" /></td>
                                  </tr>
                                  <tr>
                                    <td  colspan="4"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principle Diagnosis :<font id="show3" color="">
                                      <input   style="text-align:left; background-color: #FFF4CE; text-indent:inherit; border-color: #99F" onblur="next4()" name="diag" type='text' id='diag'  size="80" />
                                    </font></div></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#E5E5E5" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ECOG Score :
                                      <select onchange="next5()"   name="ecog" id="ecog">
                                        <option value="-">-</option>
                                        <option value=0>ทำกิจกรรมต่างๆได้ปกติ (0)</option>
                                        <option value=1>ทำงานหรือกิจกรรมเบาๆได้ เช่นงานบ้าน งานใน office(1)</option>
                                        <option value=2>เคลื่อนไหวได้ ช่วยเหลือตัวเองได้ แต่ทำงานไม่ได้ นั่งยืนได้มากกว่า 50% ขณะตื่น(2)</option>
                                        <option value=3>ติดเตียง ช่วยตัวเองพอได้ นอนมากกว่า 50% ของช่วงเวลาตื่น(3)</option>
                                        <option value=4>ช่วยเหลือตัวเองไม่ได้ ติดตเตียง-ล้อเข็น(4)</option>
                                      </select></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"  bgcolor="#A4CAEC">1.) ประวัติการกิน-การได้รับสารอาหาร  #ได้รับสารอาหารทาง
                                      :
                                      <select style="text-align:center; border:none" name="diet_type" id="diet_type">
                                        <option value="-">-</option>
                                        <option value="กินเองทางปาก">กินเองทางปาก</option>
                                        <option value="Tube feeding">Tube feeding</option>
                                        <option value="Parenteral route">Parenteral route</option>
                                        <option value="Standard IV">Standard IV</option>
                                        <option value="Combination">Combination</option>
                                      </select>
                                      #อาหารและพลังงานที่ได้รับจริง
                                      :
                                      <select style="text-align:center; border:none" name="intake" id="intake">
                                        <option value="0">75%-100% ของปกติหรือ Cal.ที่ต้องการ(0) </option>
                                        <option value="1">50-75% ของปกติหรือ Cal.ที่ต้องการ(1) </option>
                                        <option value="2">25-50% ของปกติหรือ Cal.ที่ต้องการ(2) </option>
                                        <option value="3">10-25% ของปกติหรือ Cal.ที่ต้องการ(3)</option>
                                        <option value="4">&lt;10% ของปกติ (NPO,ได้รับแต่ IV มาตรฐาน)(4) </option>
                                      </select>
                                      <label for="diet_type"></label>
                                      <label for="diet_type"></label>
                                      <br />#ระยะเวลาที่เปลี่ยนแปลง:
                                      <select style="text-align:center; border:none"  name="diet_period" id="diet_period">
                                        <option value="-">-</option>
                                        <option value="1">ไม่เกิน 7 วัน :เปลี่ยนแปลงเล็กน้อย(0)</option>
                                        <option value="2">ไม่เกิน 7 วัน:เปลี่ยนแปลงมาก(1)</option>
                                        <option value="3">8-14 วัน:เปลี่ยนแปลงเล็กน้อย(1)</option>
                                        <option value="4">8-14 วัน:เปลี่ยนแปลงมาก(2)</option>
                                        <option value="5">มากกว่า 14 วัน:เปลี่ยนแปลงเล็กน้อย(2)</option>
                                        <option value="6">มากกว่า 14 วัน:เปลี่ยนแปลงมาก(3)</option>
                                      </select>
                                     <br /></td>
                                    <td bgcolor="#A4CAEC" ><div style="background-color: #E8F2F1" align="right">
                                       <font color=""><strong>Dietary intake score= </strong>
                                        <input name="diet_s" type='text' id='diet_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                      </font>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#EEEBAC" colspan="3"> 2.) ประวัติน้ำหนักที่เปลี่ยนแปลง :
                                      <select style="text-align:center; border:none"     name="wt_type" id="wt_type">
                                        <option  value="-">-</option>
                                        <option  value="same">เท่าเดิม</option>
                                        <option value="gain">เพิ่มขึ้น</option>
                                        <option value="loss">ลดลง</option>
                                        </select>
                                      :
                                      <input style="text-align:center; border:none"  value=0  name="wt_change" type="text" id="wt_change" size="10" />
                                      kg. ในช่วงเวลา :
                                      <select style="text-align:center; border:none"  name="wt_period" id="wt_period">
                                        <option value="0">-</option>
                                        <option value="1">1 week</option>
                                        <option value="2">2-3 week</option>
                                        <option value="3">1 month</option>
                                        <option value="4">3 month</option>
                                        <option value="5">&gt;5 month</option>
                                        </select>
                                      ร้อยละของน้ำหนักที่เปลี่ยนเปลง :
                                      
                                      <font >
                                        <input readonly="readonly" style="border:none; text-align:center  "   name="wt_percent" type="text" id="wt_percent" size="10" />
                                        %</font></td>
                                    <td width="23%" bgcolor="#EEEBAC"><div style="background-color: #E8F2F1" align="right"> <strong>Wt loss score =</strong>
                                      <input  name="wtloss_s" type='text' id='wtloss_s' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"  bgcolor="#DDDFF7">3.) ภาวะบวมน้ำ (Fluid accumulation)  :
                                      <select style="text-align:center; border:none"   name="edema2" id="edema2">
                                        <option value="0">(0)ไม่มีบวม (มือ-แขนสองข้าง หน้าอก ลำตัว ท้อง ขาสองข้าง)</option>
                                        <option value="1">(1)บวมเล็กน้อย-บางแห่ง ระดับ +1 ถึง +2 (รอยบุ๋มลึก 2-4 mm.)</option>
                                        <option value="2">(2)บวมปานกลาง มือ-แขน หรือขา 2 ข้าง ระดับ +2 ถึง +3 (รอยบุ๋มลึก 2-4 mm.)</option>
                                        <option value="3">(3)บวมทั่วตัว ระดับ +3 ถึง +4 (รอยบุ๋มลึก 6-8 mm.)</option>
                                      </select>
                                      <label for="diet_cal"></label>
                                      <label for="intake"></label></td>
                                    <td bgcolor="#DDDFF7"><div style="background-color: #E8F2F1" align="right"> <strong>Edema score =</strong>
                                      <input   name="edema" type='text' id='edema' style="text-align:center; background-color:#CF9" value="0"  size="10" readonly="readonly" />
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"  bgcolor="#F5D5E1">4.) ระดับการสูญเสียมวลไขมัน (Body fat loss) ประเมินเฉลี่ยทั่วร่างกาย :
                                      <select style="text-align:center; border:none"  name="fatloss" id="fatloss">
                                        <option value="0">(0)ปกติ</option>
                                        <option value="1">(1)มีไขมันน้อย</option>
                                        <option value="2">(2)มีไขมันน้อยมาก</option>
                                        <option value="3">(3)หนังหุ้มกระดูก</option>
                                      </select></td>
                                    <td bgcolor="#F5D5E1"><div style="background-color: #E8F2F1" align="right"> <strong>Fat loss score =</strong>
                                      <input  name="fatloss1" type='text' id='fatloss1' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" bgcolor="#D8F6CE" >5.) ระดับการสูญเสียมวลกล้ามเนื้อ (Muscle loss) ประเมินเฉลี่ยทั่วร่างกาย :
                                      <select style="text-align:center; border:none"  name="mloss1" id="mloss1">
                                        <option value="0">(0)ปกติ</option>
                                        <option value="1">(1)กล้ามเนื้อน้อยลง</option>
                                        <option value="2">(2)กล้ามเนื้อรีบ</option>
                                        <option value="3">(3)หนังหุ้มกระดูก</option>
                                      </select></td>
                                    <td bgcolor="#D8F6CE"><div style="background-color: #E8F2F1" align="right"> <strong>Muscle loss score =</strong>
                                      <input  name="mloss2" type='text' id='mloss2' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" bgcolor="#F1D9D1">6.)สมรรถภาพกล้ามเนื้อ (ประเมินเฉลยี่ทว่ัร่างกาย) :
                                      <select style="text-align:center; border:none"  name="mpower1" id="mpower1">
                                        <option value="0">(0)muscle power Gr 4-5</option>
                                        <option value="1">(1)muscle power Gr 2-3</option>
                                        <option value="2">(2)muscle power Gr 1</option>
                                        <option value="3">(3)muscle power Gr 0</option>
                                      </select></td>
                                    <td bgcolor="#F1D9D1"><div style="background-color: #E8F2F1" align="right">Muscle strength<strong> score =</strong>
                                      <input  name="mpower2" type='text' id='mpower2' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"  bgcolor="#CDC5EF">7.) ระดับความรุนแรงของการเจ็บป่วยเรื้อรัง ( Chronic &gt; 3 mo)</td>
                                    <td colspan="2"  bgcolor="#B8D8BD">8.) ระดับความรุนแรงของการเจ็บป่วยเฉียบพลัน-กึ่งเฉียบพลัน</td>
                                  </tr>
                                  <tr align="right">
                                    <td width="21%" bgcolor="#EAD4FF"><div align="left">1.โรคมะเร็ง 
                                      : </div></td>
                                    <td align="left" width="23%"  bgcolor="#DCE2FE"><div align="left">
                                      <select style="text-align:center; border:none"  name="cancer" id="cancer">
                                        <option value="0">(0)ไม่มีมะเร็ง</option>
                                        <option value="0">(0)stage I ,normal nutrition</option>
                                        <option value="1">(1)stage II ,กระทบการกินไม่มาก</option>
                                        <option value="2">(2)stage III ,กระทบการกินมากพอควร</option>
                                        <option value="3">(3)stage IV,metastasis,กระทบการกินมากที่สุด</option>
                                      </select>
                                    </div></td>
                                    <td width="33%" bgcolor="#BEE0BB"><div align="left">1.การบาดเจ็บ :
                                      <div align="right"></div>
                                    </div></td>
                                    <td  bgcolor="#CAEBD0"><select style="text-align:center; border:none; width:300px"  name="injury" id="injury">
				
                                      <option value="0">(0)ไม่มี</option>
                                      <option value="1">(1)เล็กน้อย ,V/S และ Pulm func stable, no complication</option>
                                      <option value="2">(2)กระทบ V/S และ Pulm func , shock class II-III,no compliacation</option>
                                      <option value="3">(3)shock class III-IV,มี complication</option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">2.โรคปอด(COPD/TB) : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="lung" id="lung">
                                      <option value="0">(0)ไม่มี</option>
                                      <option value="1">(1)เหนื่อยหอบเล็กน้อย,นานๆครั้ง,ใช้ยาแก้ไขได้</option>
                                      <option value="2">(2)เหนื่อยหอบบ่อย,ใช้ยาบ่อยขึ้น,ทำกิจวัตรได้ลดลง</option>
                                      <option value="3">(3)หอบมาก รุนแรง ควบคุมด้วยยายาก,on ventilator</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">2.บาดเจ็บศีรษะ : </div></td>
                                    <td  bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px" name="HI" id="HI">
                                      <option value="0">(0) ไม่มี, GCS 15</option>
                                      <option value="1">(1) GCS 13-14</option>
                                      <option value="2">(2) GCS 8-12</option>
                                      <option value="3">(3) GCS 3-7</option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">3.โรคไต : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px"  name="ckd" id="ckd">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1) อาการเล็กน้อย ระยะเริ่มต้น</option>
                                      <option value="2">(2)BUN/Cr สูงไม่มาก ,HD/CAPD ได้ผลดี,Urine ยังออก</option>
                                      <option value="3">(3) ARF,CRF,Anemia,HD/PD 3-4 ครั้ง/wk</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">3.Acute spinal injury : </div></td>
                                    <td bgcolor="#CAEBD0"><div align="left">
                                      <select style="text-align:center; border:none;width:300px" name="spinal" id="spinal">
                                        <option value="0">(0)ไม่มี</option>
                                        <option value="1">(1) mild cord involvement</option>
                                        <option value="2">(2) Hemiplegia,paraplegia</option>
                                        <option value="3">(1) Tetraplegia</option>
                                      </select>
                                    </div></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">4.โรคตับ / Cirrhosis : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="liver" id="liver">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1);&quot;มีอาการเล็กน้อย N/V ท้องอืดแต่กินได้พอควร no jx</option>
                                      <option value="2">(2) มี jxไม่มาก(bilirubin2-3mg%)กระทบการกินไม่มาก</option>
                                      <option value="3">(3) jxชัดเจน bili&gt;3มีHx of HEโรคตับเรื้อรัง กินได้น้อย</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">4.Burn : </div></td>
                                    <td bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px"  name="burn" id="burn">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1) 1-2  degree&lt<15% , pulm function,face,neck, joint ,sex ปกติ</option>
                                      <option value="2">(2)  2 degree 15-20%, 3degree 5-10% มีผลต่อ pulm function,face,neck,sex</option>
                                      <option value="3">(3) 2 degree>20%, 3degree>10%, age&lt;10 or.&gt;50, electrictal,vital organ</option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">5.HIV / AIDS : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="aids" id="aids">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1) นน ลด<10% ติดเชื้อแต่ไม่มีอาการหรือมีน้อยมาก</option>
                                      <option value="2">(2) นน ลด<10% มีอาการหรือมีภาวะแทรกซ้อนแต่คุมได้ไม่ยาก</option>
                                      <option value="3">(3) นน ลด>10% อาการชัด ทรุดโทรม ภาวะอทรกซ้อนปานกลาง-รุนแรง</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">5. Sepsis / Infection : </div></td>
                                    <td bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px" name="infection" id="infection">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1) sepsis </option>
                                      <option value="2">(2) severe sepsis control ได้ด้วย ABO,กระทบการกิน</option>
                                      <option value="3">(3) septic shock </option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">6.Ascites : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="ascites" id="ascites">
                                      <option value="0">(0) ไม่มี</option>
                                      <option value="1">(1) พบเล็กน้อยจาก US</option>
                                      <option value="2">(2) moderate amount ระดับสะดือ ตรวจได้,ท้องโตไม่มาก,ไม่เคยเจาะท้อง</option>
                                      <option value="3">(3) เต็มท้อง ท้องแน่นตึง หรือเคยเจาะน้ำ</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">6.Recent major operation : </div></td>
                                    <td bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px"  name="surgery" id="surgery">
                                      <option value="0">(0) ;&quot;ไม่มีการผ่าตัดภายใน 1-2 สัปดาห์</option>
                                      <option value="1">(1) ;&quot;การผ่าตัดที่ไม่กระทบการกินหรือเพียงเล็กน้อย เช่น App , IIH</option>
                                      <option value="2">(2) ;&quot;การผ่าตัดที่กระทบต่อการกินปานกลาง เช่น GI Sx ที่ไม่มี complication </option>
                                      <option value="3">(3) ;&quot;การผ่าตัดที่มีผลกระทบการกินค่อนข้างมากหรือมี Post-op complication ต้อง NPO นาน </option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td  bgcolor="#EAD4FF"><div align="left">7.Bed sore </div></td>
                                    <td  bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="bedsore" id="bedsore">
                                      <option value="0">ไม่มี</option>
                                      <option value="1">stage I,ผิวแดง ดกไม่จาง ,stage II,แผลตื้น อาจมีอักเสบ</option>
                                      <option value="2">stage IIIแผลลึกถึงไขมัน+/- อักเสบไม่มาก</option>
                                      <option value="3">stage IV แผลลึกถึงกล้ามเนื้อ อักเสบติดเชื้อ</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">7.Acute pancreatitis : </div></td>
                                    <td bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px"  name="pancreas" id="pancreas">
                                      <option value="0">ไม่มี</option>
                                      <option value="1">mild น่าจะทุเลาใน 3-4 วัน</option>
                                      <option value="2">pain,N/V,กระทบ CVS,86,86,คุมได้ด้วย IV,กินไม่ค่อยได้&gt;5d</option>
                                      <option value="3">severe ต้องใช้ iv+inotrope,symptom&gt;7d ,รับ EN ไม่ได้</option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">8.โรคเบาหวาน : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="dm" id="dm">
                                      <option value="0">ไม่มี</option>
                                      <option value="1">ไม่มีอาการ,diet control,มช้ยาเล็กน้อย คุมอาการได้</option>
                                      <option value="2">ใช้ยามากขึ้นเพื่อคุม FBS 150-200, mild complication</option>
                                      <option value="3">ใช้ยาคุมน้ำตาลได้ยาก ,mod-severe complication</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">8.Peritonitis : </div></td>
                                    <td bgcolor="#CAEBD0"><select style="text-align:center; border:none;width:300px" name="peritonitis" id="peritonitis">
                                      <option value="0">ไม่มี</option>
                                      <option value="1">;&quot;ผิดปกติเล็กน้อย eg.PUP,no complicat,NPO=2-4d</option>
                                      <option value="2">P.O. Ilieus,NPO+ได้IV &gt;5-7d,+/-Complication</option>
                                      <option value="3">P.O. complication,IV&gt;7d,ให้ ENไม่ได้หรือ&lt;10%</option>
                                    </select></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">9.Neuromuscular disease : </div></td>
                                    <td bgcolor="#DCE2FE"><div align="left">
                                      <select style="text-align:center; border:none;width:280px"   name="neuro" id="neuro">
                                        <option value="0">ไม่มี</option>
                                        <option value="1">ช่วยตัวเองได้</option>
                                        <option value="2">ช่วยตัวเองได้บ้าง เช่น hemiplegia paraplegia</option>
                                        <option value="3">bed ridden ไม่รู้สึกตัว เป็นอัมพาต</option>
                                      </select>
                                    </div></td>
                                    <td bgcolor="#BEE0BB"><div align="left">9.Hepatitis   : </div></td>
                                    <td bgcolor="#CAEBD0"><div align="left">
                                      <select style="text-align:center; border:none;width:300px" name="hepatitis" id="hepatitis">
                                        <option value="0">ไม่รุนแรง</option>
                                        <option value="1">mild</option>
                                        <option value="2">moderate</option>
                                        <option value="3">severe</option>
                                      </select>
                                    </div></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">10.โรคหัวใจ : </div></td>
                                    <td bgcolor="#DCE2FE"><select style="text-align:center; border:none;width:300px" name="heart" id="heart">
                                      <option value="0">ไม่มี</option>
                                      <option value="1">;&quot;ไม่เหนื่อยหอบ ไม่บวม ยาคุมอาการได้ดี</option>
                                      <option value="2">;&quot;เหนื่อยหอบนอนราบไม่ได้ กิจวัตรลดลง ยาคุมอาการพอได้</option>
                                      <option value="3">CHF IHD ใช้ยาบ่อยครั้งมาก ใช้ ventilator</option>
                                    </select></td>
                                    <td bgcolor="#BEE0BB"><div align="left">10.Necrotizing fasciitis  : </div></td>
                                    <td bgcolor="#CAEBD0"><div align="left">
                                      <select onchange="aill()" name="NF" id="NF">
                                        <option value="0">ไม่รุนแรง</option>
                                        <option value="1">mild</option>
                                        <option value="2">moderate</option>
                                        <option value="3">severe</option>
                                      </select>
                                    </div></td>
                                  </tr>
                                  <tr align="right">
                                    <td bgcolor="#EAD4FF"><div align="left">12.Short bowel/Ostomy : </div></td>
                                    <td bgcolor="#DCE2FE"><div align="left">
                                      <select style="text-align:center; border:none;width:250px"  name="ostomy" id="ostomy">
                                        <option value="0">ไม่มี</option>
                                        <option value="1">;&quot;อุจจาระไม่มาก ถ่าย/เปลี่ยนถุง&lt;2ครั้ง/วัน</option>
                                        <option value="2">;&quot;ถ่าย/เปลี่ยนถุง3-5ครั้ง/วัน,ขาดน้ำ,e imbalance</option>
                                        <option value="3">;&quot;&gt;6ครั้ง/d ขาดน้ำ,e imbalanceและร่างกายซูบผอม</option>
                                      </select>
                                    </div></td>
                                    <td bgcolor="#CAEBD0" colspan="2"  ><p align="left">11.อื่นๆ:
                                      <input name="other1" type="text" id="other1" placeholder="GI bleeding,Diarrhea,Shock,EC fistula" size="30" />
                                      ความรุนแรง :
                                      <label for="other1"></label>
                                      <select onchange="aill()" name="other2" id="other2">
                                        <option value="0">ไม่รุนแรง</option>
                                        <option value="1">mild</option>
                                        <option value="2">moderate</option>
                                        <option value="3">severe</option>
                                      </select>
                                    </p></td>
                                  </tr>
                                  <tr align="right">
                                    <td colspan="2" ><label for="spinal"></label>
                                      <label for="spinal"></label>
                                      <div align="left">
                                        <div style="background-color: #E8F2F1" align="right"> <strong>Chronic illness score =</strong>
                                          <input  name="chronic" type='text' id='chronic' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                        </div>
                                      </div></td>
                                    <td colspan="2"  ><div style="background-color: #E8F2F1" align="right"> <strong>Acute illnees score =</strong>
                                      <input  name="acute" type='text' id='acute' style="text-align:center; background-color:#CF9" onblur="bnt()" value="0"  size="10" readonly="readonly" />
                                    </div></td>
                                    </tr>
                                  <tr align="right">
                                    <td colspan="4"  >                                      <div align="right"></div></td>
                                  </tr>
                                  <tr>
                                    <td  bgcolor="#FFCC99" align="center" colspan="4"><p>&nbsp;BNT2013 Score = <font id="show" color="">
                                      <input   name="score" type='text' id='score' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size" value="0"  size="8"  readonly="readonly" />
                                      </font>แปลผล
                                      :<font id="show2" color="">
                                      <input  name="level" type='text' id='level' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size"  size="40"  readonly="readonly" />
                                      </font>ICD-10: <font id="show4" color="">
                                      <input   name="icd" type='text' id='icd' style=" text-align:center; background-color:#FAFAFA; text-shadow:#F33; size:auto; text-size:max-size" value="0"  size="8"  readonly="readonly" />
                                      </font><br />
                                      ข้อแนะนำ : <font color="">
                                          <input name="result1" type='text' id='result1' style="text-align:center; background-color: #FAFAFA; width:auto "  size="60" readonly="readonly" />
                                          </font></p></td>
                                  </tr>
                                  <tr>
                                    <td align="center" colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2">
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
                                    <td align="center" colspan="4">แพทย์ :
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
                                    <td align="center" colspan="4"><p><div style="width:20; background-color: #F3C9B7">
                                      <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                        <tr>
                                          <td width="32%">&nbsp;</td>
                                          <td width="41%"><div style="background-color: #C1D3F1" align="center">
                                            <input  type="submit" name="save" id="save" value="save" />
                                          </div></td>
                                          <td width="27%">&nbsp;</td>
                                        </tr>
                                      </table></div>
                                    </p></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4"><div align="center"><a href="/hospital/screening.php">Back to home</a></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4"><div align="center"><em><a href="/nutrition/file/file_download/program_guide.pdf"><strong><font size="-1">(ดู References สำหรับการคำนวนต่างๆในโปรแกรม)</font></strong></a></em></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4"><div align="center"><a href="/nutrition/file/file_download/NT2013.pdf">Download แบบฟอร์ม NT-2013</a></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4"><div align="center"><font size="-2" color="#336633"><strong><em><a href="https://www.facebook.com/ekkawit.iamthongin">Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</a></em></strong></font></div></td>
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
