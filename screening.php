<?php
include 'common.php';

if(!is_usr())
{
header("location:index.php");
}

$ward = db::select(array("tbl" => "department"));

if (u::is("hid"))
    $hid = u::get();
	
	
if (u::is("Fname"))
    $Fname = u::get();
if (u::is("Lname"))
    $Lname = u::get();	
	
$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$row_hospital = db::arr($ward);
if(session::is("triagent"))
{
    session::un_set();
    
    
    
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1" http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="screening.js"></script>
<title>Main page of program</title>
<style>
.link { text-decoration:none}
</style>


</head>
<link href="bootstrap/css/bootstrap.css"
    rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap-theme.css"
    rel="stylesheet" type="text/css" />
    
<body>
<div class="container">
&nbsp;
    <table id="tbl_BNT"  width="93%" border="0" align="center" cellpadding="2" cellspacing="1">
    <tr>
      <th height="10" colspan="3" bgcolor="#EEFFF1" class="img-rounded alert-success"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a></div></th>
    </tr>
    <tr>
      <th height="11" bgcolor="#EEFFF1"><div  align="left" class="text-success img-rounded">
        <div align="center">ยินดีต้อนรับ :&nbsp;<?php echo $Fname; ?> </div>
      </div></th>
      <th width="45%" height="11" bgcolor="#EEFFF1"><div align="center">
        <input  name="hosp2" type="text" class="img-rounded" id="hosp2" style="background-color: #EAEAEA; text-align:center; font-size:16px;" value="<?php echo "รพ. ".$row_hospital['hosName']; ?>" size="40" readonly="readonly" />
      </div></th>
      <th width="28%" bgcolor="#EEFFF1"><a class="label-danger btn-danger img-rounded" id = 'logout' href='#' style='float:right'>&nbsp;&nbsp;logout&nbsp;&nbsp;</a></th>
      </tr>
    <tr>
        <th colspan="3" bgcolor="#C5D2EE" class="img-rounded alert-info"><div align="center"><font size="+1" class="img-rounded collapsing" style="color:#30C">โปรแกรมการคัดกรองภาวะทุพโภชนาการและการให้โภชนบำบัด </font></div></th>
    </tr>
    <tr bg>
      <td align="center" colspan="3"><p class="bg-danger"><a href="guide.php">(คำแนะนำการใช้โปรแกรม)</a></p></td>
    </tr>
    <tr>
      <td colspan="3" class="img-rounded alert-success" ><a href="new_ptnt.php" class="list-group-item-success" style="text-shadow:#F36; text-decoration: inherit"> 1.) คัดกรองเบื้องต้น( Triage ) ในผู้ป่วยใหม่ทุกราย ก่อนทำ Assessment </a></td>
    </tr>
        <tr width="100%">
      <td colspan="3" class="img-rounded ">      <div  ><form id="triagent" action="#">
          <div align="left"><span class="img-rounded col-sm-offset-1"><img src="/hospital/img/Green-Apple.jpg" alt="" width="21" height="20" align="middle"/>  
            HN :
            <input name="HN" type="text" class="img-rounded alert-success" id="HN"  placeholder="HN ของผู้ป่วย" style="background-color: #E8FFCF; border-color: #063" size="15" maxlength="13" />
            <input name="go1" type="submit" class="btn-success img-rounded" id="go1" style=" background-color:#A8B7F6; border-bottom-color:#363" value="Triage " />
            </span>
          </div>
          </form>
        </div><br /></td>
      </tr>
    <tr>
      <td colspan="3" bgcolor="#E0E0E0" class="list-group-item-warning"><span class="img-rounded alert-warning">2.) ประเมินภาวะทุพโภชนาการละเอียดในกลุ่มเสี่ยง ด้วย  BNT-2013 หรือ NAF</span></td>
    </tr>
    <tr>
      <td colspan="3">
        <table    width="100%" border="0" cellspacing="2" cellpadding="2">
         
               <tr>
                      
            <td valign="middle">              <form id="NT2013" action="#">
              <span class="img-rounded col-sm-offset-1"><img src="/hospital/img/images-3.jpeg" alt="" width="20" height="20" class="img-rounded"   align="middle" />
              HN :
             <input name="HN" type="text" class="alert-warning img-rounded" id="HN" placeholder="ใส่ HN ของผู้ป่วย" style="background-color: #E8FFCF; border-color: #063" size="15" maxlength="13" />
              <font color="#FFFFFF">
              <input name="go3" type="submit" class="btn-warning img-rounded" id="go3"  style=" background-color:#A4B1FD; border-bottom-color:#363" value="BNT-2013 Assessment" />
              </font>
              </span>
            </form></td>
            </tr>
        
            <tr>
                                       

            <td>              <form id="NAF" action="#">
              <span class="img-rounded col-sm-offset-1"><img src="/hospital/img/images-3.jpeg" alt="" width="20" height="20" align="middle" />
              HN :
             <input name="HN" type="text" class="alert-warning img-rounded" id="HN" placeholder="ใส่ HN ของผู้ป่วย" style="background-color: #E8FFCF; border-color: #063" size="15" maxlength="13" />
              <input name="go3" type="submit" class="btn-warning img-rounded" id="go3" style=" background-color:#A4B1FD; border-bottom-color:#363" value="NAF Assessment" />
              </span>
            </form><br /></td>
          </tr>
          </table>
    </tr>
    <tr class="link">
      
      <td colspan="3" bgcolor="#E0E0E0" class="list-group-item-danger img-rounded"><span class="img-rounded alert-danger">3.) คำนวณ Nutritional Therapy (เมื่อแพทย์สั่งการรักษา)</span></td>
      
    </tr>
    <tr class="link">
    
      <td colspan="3" class="link">        <div >
        <form id="treat_calNT">
          <span class="img-rounded col-sm-offset-1"><img src="/hospital/img/redapp.jpg" alt="" width="20" height="20" align="middle" />
          HN :
            <input placeholder="ใส่ HN ผู้ป่วย" name="id" type="text" class="alert-danger img-rounded" id="HN" style="background-color: #E8FFCF; border-color: #063" size="15" maxlength="13" />
          <input name="btnRx" type="submit" class="btn-danger img-rounded" id="btnRx" style=" background-color:#768BD9; border-bottom-color:#363" value="คำนวณ" />
          </span>
        </form>
      </div></td>
      </tr>
    <tr class="link">
      <td colspan="3" bgcolor="#C0C8EF"><div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF"></td>
          </tr>
        </table>
      </div></td>
      </tr>
    <tr class="link">
      <td colspan="3"><div align="left">
        <table bgcolor="#F0F0F0" width="100%" border="0" cellspacing="2" cellpadding="2">
         <tr >
           <td colspan="2" class="img-circle">&nbsp;</td>
          </tr>
          <tr>
            <td width="31%" bgcolor="#D2D2D2" class="img-rounded"><img src="/hospital/img/Green-Apple.jpg" alt="" width="21" height="20" class="img-rounded" /><a class="link" href="/hospital/editdata.php">เปลี่ยนแปลงข้อมูลพื้นฐาน </a></td>
            <td bgcolor="#D2D2D2" class="img-rounded"><p><a href="searchBNT2013.php"><img src="/hospital/img/Green-Apple.jpg" alt="" width="21" height="20" class="img-rounded" />ค้นข้อมูลการประเมิน</a><a class="link" href="http://118.175.29.211/nutritionreport/site/index2"></a></p></td>
          </tr>
          <tr>
            <td  colspan="2"  bgcolor="#DCDCDC" class="breadcrumb"><div align="center">เอกสารที่เกี่ยวข้อง</div></td>
          </tr>
          <tr>
            <td  colspan="2"  bgcolor="#DCDCDC" class="img-rounded"><ol>
              <li><a class="link" href="icd10.php">เกณฑ์การให้การวินิจฉัยตาม ICD-10</a></li>
              <li><a class="link" href="/hospital/download/follow.pdf">แบบบันทึกติดตามการรักษา</a></li>
              <li><a class="link" href="download/program_guide.pdf">สูตรที่ใช้ในโปรแกรมและเอกสารอ้างอิงที่เกี่ยวข้อง</a></li>
              <li><a class="link" href="img/download/screening.pdf">แบบคัดกรองเบื้องต้น 4คำถาม</a></li>
              <li><a class="link" href="download/NT2013.pdf">แบบประเมิน NT2013</a></li>
              <li><a class="link" href="/hospital/download/NAF.pdf">แบบประเมิน Modified NAF</a></li>
            </ol></td>
          </tr>
          <tr>
            <td colspan="2"><div align="center"><a class="label-primary alert-danger img-rounded link" href="http://chomthonghospital.go.th/cth2015/"><font size="+1">&nbsp;&nbsp;&nbsp;Back to Home&nbsp;&nbsp;&nbsp;</font></a></div></td>
          </tr>
        </table>
      </div></td>
      <tr>
        <td align="center"><a href="order.php" target="new"></a>
      </td></tr>
      </tr>
    <tr class="link">
      <td colspan="3"><div align="center"><a class="link" href="http://chomthonghospital.go.th/cth2015/"></a></div>        <div align="center"></div></td>
    </tr>
    <tr>
      <td height="59" colspan="9" bgcolor="#EEFFF1"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="img/chomthong.jpg" width="200" height="60" alt="chomthong hospital" longdesc="http://chomthonghospital.go.th/cth2015/" /></a>&nbsp;<a href="https://www.facebook.com/programmergap"> <img src="img/gap1.png" alt="gap the coder" width="150" height="60" class="img-rounded" longdesc="https://www.facebook.com/1897940170481317/photos/1898557070419627/" /></a>&nbsp;<a href="https://www.fresenius-kabi.com/">  <img src="img/FK_RGB_jpg.jpg" alt="fresanius Kabi" width="180" height="60" class="img-rounded" /></a>&nbsp;<a href="http://www.spent.or.th/en2/welcome.php">  <img src="img/spent1.png" width="180" height="60" class="img-rounded" longdesc="http://www.spent.or.th/en2/welcome.php" /></a>&nbsp;<a href="http://www.nabla.co.th/project/nap/index.php/">&nbsp;<img src="img/screenSPENT.png" width="95" height="60" alt="SCREENING PROGRAM" /></a></div></td>
    </tr>
    <tr>
      <td height="59" colspan="9" bgcolor="#EEFFF1" class="img-rounded"><p align="center"><font size="-2" color="#336633"><strong><em><a href="https://www.facebook.com/ekkawit.iamthongin">Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</a></em></strong></font></p></td>
    </tr>
  </table>
</body>
</html>


