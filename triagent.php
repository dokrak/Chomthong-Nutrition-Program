<?PHP
include 'common.php';
/* 	
  echo(" <script>


  if(confirm('บันทึกข้อมูลเรียบร้อยแล้ว ต้องการพิมพ์การคัดกรองนี้หรือไม่ ?')==true)
  {	//alert('yes');
  alert('success and ID='+$id+'$id');
  window.location.href='/nutrition/file/report/reportTriage.php?id='+$id;

  //window.location.href='ask.php';
  }else{ //alert('No');
  window.location.href='screening.php';
  }



  if(confirm('ผู้ป่วยรายนี้ ==>$risk ต่อภาวะทุพโภชนาการ  '+''+'คุณต้องการทำการประเมินอย่างละเอียดต่อไปหรือไม่?')==true)
  {	//alert('yes');
  window.location.href='BTN_old.php?HN='+'$HN';
  }else{ //alert('No');
  window.location.href='screening.php';}
  </script> ");

 */
/*
  $message1 = "บันทึกข้อมูลเรียบร้อยแล้ว";

  $confrm="<script type='text/javascript'>alert('$message1');</script>";


  echo(" <script> if(confirm('ผู้ป่วยรายนี้ ==>$risk ต่อภาวะทุพโภชนาการ  '+''+'คุณต้องการทำการประเมินอย่างละเอียดต่อไปหรือไม่?')==true)
  {	//alert('yes');
  window.location.href='BTN_old.php?HN='+'$HN';
  }else{ //alert('No');
  window.location.href='screening.php';}
  </script>");
 */

//}
if(!is_usr())
{
header("location:index.php");
}
if (!isset($_GET['HN'])) {

    header("location:screening.php");
}

$HN = $_GET['HN'];

$row_patient = patient_wrapper::load_by_hn($HN);


$ward = db::select(array("tbl" => "department", "where" => "hid='" . $row_patient['hid'] . "'"));

$row_ward = db::arrs($ward);
$totalRows_ward = db::num($ward);

$res = db::select(array("tbl" => "triagent"));

$row_triagent = db::arrs($res);

$row_triagent = $row_triagent[sizeof($row_triagent) - 1];

$colname_hospital = "-1";

if (u::is("hid"))
    $hid = u::get();
if (u::is("Fname"))
    $reporter = u::get();
$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$row_hospital = db::arr($ward);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script src="jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="triagent.js"></script>
        <title>Untitled Document</title>

        <script language="JavaScript">
            function chkConfirm()
            {
                if (confirm('คุณต้องการทำการประเมินอย่างละเอียดต่อไป?') == true)
                {
                    //alert('Going to http://www.thaicreate.com');
                    //window.location = 'http://www.thaicreate.com';
                    window.location.href = 'screening.php?HN=' + '$HN';
                } else
                {
                    alert('You selected to cancel.');
                }
            }



        </script>


        <style type="text/css">
            #left {
            }
        </style>
    </head>
    <link href="bootstrap/css/bootstrap.css"
    rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap-theme.css"
    rel="stylesheet" type="text/css" />
    <body>
    <div class="container">

    <center>
    <p><br />
            </p>
            <form id="form1" name="form1" method="POST" action="#">
                <table width="93%" border="0" cellspacing="2" cellpadding="2">
                    <tr bgcolor="#336666" >
                        <th class="list-group-item-success img-rounded" colspan="4" align="left" scope="col"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/">
                        <img src="<?PHP $logo="img/". $row_patient['hid'] .".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a>
                          <p><b>โปรแกรมคัดกรองความเสี่ยงของภาวะทุพโภชนาการ</b> <b>เบื้องต้น( </b>Triage ) </p>
                          <p class="img-rounded">โรงพยาบาล 
                            <input  name="hosp" type="text" class="bg-success img-rounded" id="hosp" style="background-color:#EFFDC2; text-align:center; font-size:16px" value="<?php echo $row_hospital['hosName']; ?>" size="20" readonly="readonly" />
                            <input  name="hid" type="hidden" class="alert-success" id="hid" style="background-color:#EFFDC2; text-align:center; font-size:16px" value="<?php echo $row_hospital['hid']; ?>" size="5" readonly="readonly" />
                          </p>
                          <p class="img-rounded">&nbsp;</p>
                        </div></th>
                    </tr>
                    <tr>
                        <th colspan="4" align="left" scope="col"> 
                            <div align="center">
                                เลขที่การคัดกรองเบื้องต้น : 
                                <label for="id"></label>
                                <input name="id" type="text" id="id" style="text-align:center;background-color:#E0E5B2" value="<?php echo $row_triagent['id'] + 1; ?>" size="5" />
                                วันที่ :
                                <input style="text-align:center;background-color:#E0E5B2"  name="Tdate" value="<?php $today = date('Y-m-d');
echo $today; ?>" type="text" id="Tdate" size="15" />      
                            </div></th>
                    </tr>
                    <tr>
                        <th colspan="4" align="left" scope="col"><div align="center"></div></th>
                    </tr>
                    <tr id="left">
                        <th colspan="4" align="left" scope="col"><dd>
                                <div align="center">
                                  <p>ชื่อ-สกุล:
                                    <input name="fname" type="text" class="img-rounded" id="fname" style="background-color: #D7E2FA" value="<?php echo $row_patient['Fname']; ?>" readonly="readonly" />
                                    -
                                    <input name="lname" type="text" class="img-rounded" id="lname" style="background-color: #D7E2FA" value="<?php echo $row_patient['Lname']; ?>" readonly="readonly" />
                                    HN :
                                    <input name="HN" type="text" class="img-rounded" style="background-color: #D7E2FA" value="<?php echo $row_patient['HN']; ?>" size="15" readonly="readonly" />
                                  </p>
                                </div>
                      <dd>
                        <div></div></th>
                                    </tr>
                    <tr>
                      <th colspan="4" align="left" scope="col">
                        <label for="sex3"></label>
<label for="sex4"></label>
<div align="center">อายุ :
  <input  name="age" type="text" class="img-rounded" id="age" style="background-color:#D7E2FA" value="<?php echo $row_patient['age']; ?>" size="10" readonly="readonly" />
Sex:
<input class="img-rounded" readonly="readonly" style="background-color:#D7E2FA"  name="sex" type="text" id="sex4" value="<?php echo $row_patient['sex']; ?>" size="10" />
  ที่อยู่s :
  <input class="img-rounded" readonly="readonly" style="background-color: #D7E2FA"  name="address" type="text" id="address" value="<?php echo $row_patient['address']; ?>" size="30" />
</div>
<label for="address"></label>
<div align="center"></div></th>
                    </tr>
                                    <tr>
                                        <td colspan="4" align="left"><dd>
                                                <div align="center"> AN:
                                                  <input name="AN" type="text" class="text-danger img-rounded bg-warning"id="AN" placeholder="ผู้ป่วยนอกใส่ 0"  size="15"   />
Ward :
<label for="ward3"></label>
<select   name="ward" class="btn-success" id="ward3">
  <?php
                                                    do {
                                                        $c = current($row_ward);
                                                        ?>
  <option value="<?php echo $c['dptname'] ?>"><?php echo $c['dptname'] ?></option>
  <?php
                                                    } while (next($row_ward));
                                                    ?>
</select>
                                                  BW :
                                                    <input name="bw" type='text' class="img-rounded text-danger bg-warning" id='bw'   size="5"/>

                                                    kg. Ht :
                                                    <input  name="ht" type='text' class="img-rounded text-danger bg-warning" id='ht'   size="5"/>
                                                    cm. BMI:
                                                    <input name="bmi" type='text' class="img-rounded" id='bmi' style="text-align:center;background-color: #F7E9D2"  size="7"  readonly="readonly"  />
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><div align="center">ผลลัพธ์  : <font id="show" color=""><br />
                                                </font></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><div align="left">ผู้ป่วยมีภาวะต่อไปนี้หรือไม่</div></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="16%"><blockquote>
                                                
                                            </blockquote></td>
                                        <td width="67%">1.)ผู้ป่วยกินได้น้อยลงใน 1 สัปดาห์ที่ผ่านมา?</td>
                                        <td width="12%"><select name="diet" class="btn-warning" id="diet" style="text-align:center">

                                                <option value="-">-</option>
                                                <option value="ไม่มี">ไม่มี</option>
                                                <option value="มี">มี</option>
                                      </select></td>
                                        <td width="5%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><blockquote>&nbsp;</blockquote></td>
                                        <td>2.)ผู้ป่วยมีภาวะน้ำหนักตัวลดลงภายใน 6 เดือนหรือไม่</td>
                                        <td><select name="wtloss" class="btn-warning" id="wtloss" style="text-align:center">
                                                <option value="-">-</option>
                                                <option value="ไม่มี">ไม่มี</option>
                                                <option value="มี">มี</option>
                                      </select></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>3.) มีภาวะวิกฤติหรือกึ่งวิกฤติร่วมด้วยหรือไม่</td>
                                        <td><div align="left">
                                                <select name="critical" class="btn-warning" id="critical" style="text-align:center">
                                                    <option value="-">-</option>
                                                    <option value="ไม่มี">ไม่มี</option>
                                                    <option value="มี">มี</option>
                                                </select>
                                            </div></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><blockquote>&nbsp;</blockquote></td>
                                        <td>4.) ผู้ป่วยมี BMI &lt;= 18.5 หรือ BMI &gt;= 25 ใช่หรือไม่?</td>
                                        <td><div align="left">
                                                <input name="bmi2" type='text'  disabled class="img-rounded text-warning bg-warning" id='bmi2' style="text-align:center"  size="7"/>
                                      </div></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"> <div align="center">คะแนนรวม=
                                                <input name="result" type='text'  disabled class="img-rounded" id='result' style="text-align:center; background:#EEF4B9"  size="10" />
                                                แปรผล : ผู้ป่วยรายนี้ :<font id="col" color="">
                                                    <input name="rec" type="text"  disabled class="bg-success img-rounded" id="rec" style="text-align:center" size="70" />
                                                </font></div></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><div align="center"><BR /></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><div align="center">ผู้คัดกรอง
                                                <input name="reporter" type="text"  disabled class="img-rounded" id="reporter" style="text-align:center; background:#DFDFDF" value="<?= $reporter; ?>" size="30" />
                                            </div>
                                            <label for="reporter"></label>
                                            <div align="center"></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><div align="center">
                                                <input type="submit" name="save" id="save" value="Save and print"  />
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><div align="center"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></div></td>
                                    </tr>
                                    </table>
                                    </form>
                                    </center>

                                    </body>
                                    </html>