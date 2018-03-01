
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
$res = db::select(array("tbl" => "nt2013", "WHERE" => "HN='" . $HN . "'","order"=>"screenid"));

$row_nt2013 = db::arr($res);
$level = u::is("level")?u::get():"";
$hid = u::is("hid")?u::get():"";

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

<body >
<table align="center" width="800" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th scope="col"><form id="form1" name="form1" method="post" action="">
      <p><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></p>
      <table width="96%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th bgcolor="#D7DFFB" colspan="3" scope="col">ผลการประเมินภาวะทุพโภชนาการด้วย NT-2013<br /><font size="+1"><font color="#000099" style="background-color: #E0E8FC; text-shadow:#FFF"><?php echo "โรงพยาบาล".$row_nt2013['hosp']; ?></font></font></th>
          </tr>
        <tr>
          <td colspan="3"><div align="center">Assessment<font size="-1"> ID : 
          
                <input style="text-align:center; background-color:#FFC" name="id" type="text" id="id" value="<?php echo $row_nt2013['screenid']; ?>" size="10" />
          </font></div>            
            
            
            <font size="-1"><div align="center"><font size="-1">&nbsp;&nbsp;Date : <?php echo $row_nt2013['screendate']; ?>&nbsp;&nbsp;ประเมินครั้งที่ : <?php echo $row_nt2013['screenNo']; ?></font></div>
            </font></td>
          </tr>
        <tr><font size="-1">
          <td colspan="3"><div align="left"><dd><font size="-1">Name : <?php echo $row_nt2013['Fname']; ?> &nbsp;&nbsp;<?php echo $row_nt2013['Lname']; ?>&nbsp;&nbsp;อายุ : <?php echo $row_nt2013['age']; ?>&nbsp;&nbsp;เพศ : <?php echo $row_nt2013['sex']; ?> &nbsp;&nbsp;HN:
              <input name="HN" type="text" id="HN" value="<?php echo $row_nt2013['HN']; ?>" size="15" />
           
           AN:  </font>        
                <font size="-1"><font size="-1">
                <input name="AN" type="text" id="AN" value="<?php echo $row_nt2013['AN']; ?>" size="10" />
                </font></font>          
          </div>
            
            <div align="left"></div></td>
          </font></tr>
        <tr>
          <td colspan="3"><div align="left"><dd><font size="-1">นำ้หนัก : <?php echo $row_nt2013['bw']; ?> Kg. &nbsp;&nbsp;ความสูง : <?php echo $row_nt2013['ht']; ?> cm. &nbsp;&nbsp;Ideal BW : <?php echo $row_nt2013['IBW']; ?>kg.&nbsp;&nbsp;UBW : <?php echo $row_nt2013['UBW']; ?>kg.&nbsp;&nbsp;BMI:<?php echo $row_nt2013['bmi1']; ?></font>          
          </div></td>
          </tr>
        <tr>
          <td align="left" colspan="3"><div align="left"><dd><font size="-1">ECOG score : &nbsp;<?php echo $row_nt2013['ecog']; ?></td>
        </tr>
        <tr>
          <td colspan="3"><div align="left"><dd><font size="-1">Principle Diagnosis :</font><font size="-1" id="show7" color="">
            <input name="diag2" type='text' id='diag2'   style="text-align:left; background-color: #EAEAEA; text-indent:inherit " onblur="cill()" value="<?php echo $row_nt2013['diag']; ?>"  size="80" />
          </font></div></td>
          </tr>
        <tr>
          <td align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">1.) ประวัติการกิน-การได้รับสารอาหาร </font><font  size="-1"> #ได้รับสารอาหารทาง
                                      :
                                      <?php echo $row_nt2013['diet_type']; ?>
                                      <dd>#อาหารและพลังงานที่ได้รับจริง
                                      :
                                      
                                  
                                      <label for="diet_type"><?php echo $row_nt2013['intake']; ?></label>
<dd>#ระยะเวลาที่ได้รับอาหารดังกล่าว: <?php echo $row_nt2013['diet_period']; ?></font></td>
          <td><div align="right"><span style="background-color:"><font size="-1">Diet Score=
                  <input  name="bmi_s2" type='text' id='bmi_s2' style="text-align:center; background-color: #CF9"  onblur="bnt()" value="<?php echo $row_nt2013['diet_s']; ?>"  size="5" readonly="readonly" /></font>
            <span style="background-color:">
            <br>
            </span></span></div>
            <div align="right"><span style="background-color:"><br />
            </span></div></td>
          </tr>
        <tr>
          <td align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">2.)ประวัติน้ำหนักที่เปลี่ยนแปลง : </font><font  size="-1">
          <br><dd><?php  
					if($row_nt2013['wt_type']=="-"){echo("error"); }
					if($row_nt2013['wt_type']=="same"){echo("น้ำหนักคงที่"); }
					if($row_nt2013['wt_type']=="loss"){echo("น้ำหนักลดลง")."&nbsp;".$row_nt2013['wt_change']." kg"; }
					if($row_nt2013['wt_type']=="gain"){echo("น้ำหนักเพิ่มขึ้น")."&nbsp;".$row_nt2013['wt_change']." kg"; }
					?>
                    
                    <?php 
					$row_screening['wt_type']=0;
					$percent=$row_nt2013['wt_percent'];
					if($row_screening['wt_type']=="-"){echo("error");}
					if($row_nt2013['wt_type']=="same"){echo("คิดเป็น 0 %");}
					if($row_nt2013['wt_type']=="loss"){echo 'คิดเป็น '.$percent.' %'; }
					if($row_nt2013['wt_type']=="gain"){echo 'คิดเป็น '.$percent.'%'; }
					//(100*$row_nt2013['wt_change'])/($row_nt2013['bw']-$row_nt2013['wt_change']).'%';
			 ?>
  
            <?php 
			$wc=$row_nt2013['wt_change'];
			if($wc==0){echo "";} 
			if($wc==1){echo "ในช่วงระยะเวลา 1 สัปดาห์";} 
			if($wc==2){echo "ในช่วงระยะเวลา 2-3 สัปดาห์";} 
			if($wc==3){echo "ในช่วงระยะเวลา 1 เดือน";} 
			if($wc==4){echo "ในช่วงระยะเวลา 3 เดือน";}
			if($wc==5){echo "ในช่วงระยะเวลา > 5เดือน";} 
			if($wc==6){echo "ระยะเวลาไม่แน่นอน";}  
			?></dd></font></td>
            
          <td><div align="right"><font size="-1">Wt  loss Score=</font><span style="background-color:">
              <input  name="wt_score2" type='text' id='wt_score2' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['wtloss_s']; ?>"  size="5" readonly="readonly" />
          
              <br>
            </span> </div>            <div align="right"></div></td>
          </tr>
        <tr>
          <td align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">3.) ภาวะบวมน้ำ (Fluid accumulation)  :
           </font><font  size="-1"> <?php echo $row_nt2013['edema2']; ?></td>
          <td><div align="right"><font size="-1" color=""><strong>  Edema Score=</font><font id="show2" color="">
            <input name="diet_s2" type='text' id='diet_s2' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['edema']; ?>"  size="5" readonly="readonly" />
          </font><font color=""> 
            <br>
            </font></div>            <div align="right"></div></td>
          </tr>
        <tr>
          <td align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">4.) ระดับการสูญเสียมวลไขมัน (Body fat loss) ประเมินเฉลี่ยทั่วร่างกาย :</font><font size="-1">
            <?php echo $row_nt2013['fatloss']; ?></font></td>
          <td align="left"><div align="right"><font size="-1">Fat  loss Score=</font><span style="background-color:">
            <input  name="wt_score" type='text' id='wt_score' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['fatloss2']; ?>"  size="5" readonly="readonly" />
          </span></div></td>
        </tr>
        <tr>
          <td><div align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">5.) ระดับการสูญเสียมวลกล้ามเนื้อ (Muscle loss) ประเมินเฉลี่ยทั่วร่างกาย :</font><font size="-1"><?php echo $row_nt2013['mloss1']; ?>
            </font></div></td>
          <td><div align="right"><font size="-1">Muscleloss Score =<font id="show4" color="">
            <input name="age_score" type='text' id='age_score' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['mloss2']; ?>"  size="5" readonly="readonly" /></font>
            </font><font id="show" color="">
              <br>
            </font></div>            <div align="right"></div></td>
        </tr>
        <tr>
          <td height="20"><div align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">6.)สมรรถภาพกล้ามเนื้อ (ประเมินเฉลี่ยทั่วร่างกาย)  :</font><font size="-1"><?php echo $row_nt2013['mpower1']; ?></font></div></td>
          <td height="20"><div align="right"><font size="-1">Muscle Strength Score =<font id="show3" color="">
            <input name="age_score2" type='text' id='age_score2' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['mloss2']; ?>"  size="5" readonly="readonly" />
          </font> </font></div></td>
        </t>
        <tr > 
             
          <td align="left" height="20"><font  color="#000066" style="background: #E0E5F9" size="-1">7.) ระดับความรุนแรงของการเจ็บป่วยเรื้อรัง ( Chronic &gt; 3 mo) :</font>
          <dd><font size="-1">
          <?php if($row_nt2013['cancer']!="0"){echo "Cancer ความรุนแรง :".$row_nt2013['cancer'];}else{echo"No cancer";}
		  	if($row_nt2013['lung']!="0"){echo ";Pulmonary dis ความรุนแรง:".$row_nt2013['lung'];}else{echo" ";}	
			if($row_nt2013['ckd']!="0"){echo " ;CKD ความรุนแรง:".$row_nt2013['ckd'];}else{echo" ";}	
			if($row_nt2013['liver']!="0"){echo " ;Liverความรุนแรง:".$row_nt2013['liver'];}else{echo" ";}	
			if($row_nt2013['aids']!="0"){echo " ;HIV ความรุนแรง:".$row_nt2013['aids'];}else{echo" ";}	
			if($row_nt2013['ascites']!="0"){echo " ;Ascites ความรุนแรง:".$row_nt2013['ascites'];}else{echo" ";}	
			if($row_nt2013['bedsore']!="0"){echo " ;Bedsore ความรุนแรง:".$row_nt2013['bedsore'];}else{echo" ";}	
			if($row_nt2013['dm']!="0"){echo " ;Dm ความรุนแรง:".$row_nt2013['dm'];}else{echo" ";}	
			if($row_nt2013['neuro']!="0"){echo " ;Neuro ความรุนแรงระดับ :".$row_nt2013['neuro'];}else{echo" ";}			
			if($row_nt2013['heart']!="0"){echo " ;Heart dis ความรุนแรง:".$row_nt2013['heart'];}else{echo" ";}		
			if($row_nt2013['ostomy']!="0"){echo " ;Short bowel/Ostomy ความรุนแรง:".$row_nt2013['ostomy'];}else{echo" ";}	
		   ?></font>
             </td>
          <td height="20"><div align="right"><font size="-1">Chronic Illness Score =<font id="show5" color="">
            <input name="age_score3" type='text' id='age_score3' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['chronic']; ?>"  size="5" readonly="readonly" />
          </font></font></div></td>
        </tr>
        <tr>
          <td align="left" height="20"><div align="left"><font  color="#000066" style="background: #E0E5F9" size="-1">8.) ระดับความรุนแรงของการเจ็บป่วยเฉียบพลัน และกึ่งเฉียบพลัน (Acute Illness)</font></div>
          <dd><font style="text-align:left" size="-1">
          <?php if($row_nt2013['injury']!="0"){echo "Injury ความรุนแรง :".$row_nt2013['injury'];}else{echo" ";}
		  	if($row_nt2013['HI']!="0"){echo "; Head Injury ความรุนแรง:".$row_nt2013['HI'];}else{echo" ";}	
			if($row_nt2013['spinal']!="0"){echo " ; Spinal cord Injury ความรุนแรง:".$row_nt2013['spinal'];}else{echo" ";}	
			if($row_nt2013['burn']!="0"){echo " ; Burn ความรุนแรง:".$row_nt2013['burn'];}else{echo" ";}	
			if($row_nt2013['infection']!="0"){echo " ; Infection ความรุนแรง:".$row_nt2013['infection'];}else{echo" ";}	
			if($row_nt2013['surgery']!="0"){echo " ; Recent Surgery ใน 2-3 wk ความรุนแรง:".$row_nt2013['surgery'];}else{echo" ";}	
			if($row_nt2013['pancreas']!="0"){echo " ; Acute pancreatitis ความรุนแรง:".$row_nt2013['pancreas'];}else{echo" ";}	
			if($row_nt2013['peritonitis']!="0"){echo " ; Peritonitis ความรุนแรง:".$row_nt2013['peritonitis'];}else{echo" ";}	
			if($row_nt2013['hepatitis']!="0"){echo " ; Hepatitis ความรุนแรง:".$row_nt2013['hepatitis'];}else{echo" ";}			
			if($row_nt2013['NF']!="0"){echo " ; Necrotizing fasciitis ความรุนแรง:".$row_nt2013['NF'];}else{echo" ";}		
			if($row_nt2013['other2']!="0"){echo "; ".$row_nt2013['other1']." ความรุนแรง:".$row_nt2013['other2'];}else{echo" ";}		
		   ?></font>
          
          </td>
          
          
          
          <td height="20"><div align="right"><font size="-1">Acutc Illness Score =<font id="show6" color="">
            <input name="age_score4" type='text' id='age_score4' style="text-align:center; background-color:#CF9" onblur="bnt()" value="<?php echo $row_nt2013['acute']; ?>"  size="5" readonly="readonly" />
          </font></font></div></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="3"><div align="center"><font size="-1">สารอาหารและพลังงานที่ควรได้รับต่อวันของผู้ป่วยรายนี้</font></div></td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="16%"><div align="right"><font size="-1">Calory Requirement</font></div></td>
              <td width="16%"><font size="-1" color="">
                <input name="cal_req" type='text' id='cal_req' style="text-align:center; background-color: #E6E6E6 " value="<?php echo $row_nt2013['cal_req']; ?>"  size="10" readonly="readonly" />
                Kcal/d </font></td>
              <td width="19%"><div align="right"><font size="-1">Protein requirement</font></div></td>
              <td width="18%"><font size="-1" color="">
                <input name="prot_req" type='text' id='prot_req' style="text-align:center; background-color: #E6E6E6" value="<?php echo $row_nt2013['prot_req']; ?>"  size="10" readonly="readonly" />
                </font>gm/d</td>
              <td width="17%"><div align="right"><font size="-1">Fat</font><font size="-1" color=""> requirement </font></div></td>
              <td width="14%"><font size="-1" color="">
                <input value="<?php echo $row_nt2013['fat_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="fat_req" type='text' id='fat_req'  size="10" />
                ml/d</font></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="right"><font size="-1" color="">Volume requirement </font></div></td>
              <td><div align="left"><font size="-1" color="">
                <input value="<?php echo $row_nt2013['vol_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="vol_req" type='text' id='vol_req'  size="10" />
                ml/d</font></div></td>
              <td><div align="right"><font size="-1">NPC:N ที่ควรได้</font></div></td>
              <td><font size="-1" color="">
                <input value="<?php echo $row_nt2013['npc']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="npc" type='text' id='npc'  size="10" />
                </font></td>
              <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="3">
            </td>
        </tr>
        <tr>
          <td bgcolor="#F5E4F7" colspan="3"><div align="center">&nbsp;NT-2013 score = <font id="show10" color="">
                <input  name="score1" type='text' id='score1' style="text-align:center; background-color:#CCF; text-shadow:#F33; size:auto; text-size:max-size"   value="<?php echo $row_nt2013['score']; ?>"  size="5"  readonly="readonly" />
                ==&gt; </font>แปลผล :<font id="show8" color="">
                <input  name="level" type='text' id='level' style="text-align:center; background-color:#CCF; text-shadow:#F33; size:auto; text-size:max-size"  
                 value="<?php echo $row_nt2013['level']; ?>"  size="40"  readonly="readonly" />
                </font>&nbsp;<font id="show9" color=""> ==&gt;</font> ICD-10 : <font id="show13" color="">
                <?PHP
				$icd="";
				$bnt=$row_nt2013['score'];
				if($bnt<=7&&$bnt>=5)
					{$icd="E44.1";}
					else if($bnt<=10&&$bnt>=8)
					{$icd="E44.0";}
					else if($bnt>10)
					{$icd="E43";}
					
				?>
                <input  name="icd" type='text' id='icd' style="text-align:center; background-color:#CCF; text-shadow:#F33; size:auto; text-size:max-size"   value="<?php echo $icd; ?>"  size="10"  readonly="readonly" />
                </font><br />
                คำแนะนำ :
                <font style="border-color:#F30; background-color: " id="result2" size="+1" color="#3333FF">&nbsp;&nbsp;</font>&nbsp; <font color="">
                <input name="result1" type='text' id='result3' style="text-align:center; background-color:#E0E5F9" value="<?php echo $row_nt2013['result1']; ?>"  size="60" readonly="readonly" />
              
            </font></div></td>
        </tr>
        <tr>
          <td colspan="3"><div align="center"></div></td>
        </tr>
        <tr>
          <td colspan="3"><p align="center"> ผู้รายงาน : <font id="show12" color="">
          <input name="reporter" type='text' id='reporter' style="text-align:center; background-color:#FFC" onblur="bnt()" value="<?php echo $row_nt2013['reporter']; ?>"  size="25" readonly="readonly" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>แพทย์ : <font id="show11" color="">
<input name="doctor" type='text' id='doctor' style="text-align:center; background-color: #FFC; border-top:#933" onblur="bnt()" value="<?php echo $row_nt2013['doctor']; ?>"  size="25" readonly="readonly" />
</font>
          </td>
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
      <p>&nbsp;</p>
    </form></th>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

