/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $("form").submit(function (event) {
                event.preventDefault();

        var fname = $("[name='Fname']").val();
        var lname = $('[name="Lname"]').val();
        var code = $('[name="code"]').val();
        
              var data = {  
            fname :fname,
            lname :lname ,
            code :code ,
                };
       $.post("service/doctor.php",data, function (result) {
     console.log(result);
      if(result == 1)
        {
          $msg = "บันทึกข้อมูลสำเร็จแล้ว เพิ่มรายชื่อแพทย์อีกหรือไม่";
var r = confirm($msg);
if (r == true) {
 //$('#Fname').val("");
// $('#Lname').val("");
	$('#code').val("");
	$('#lname').val("");
	

   } else {
 window.location="editdata.php";
    }  
  		 
	
	
            
         }
         else if(result == "same")
         {
             alert("เลขหน่วยบริการนี้ได้เคยบันทึกแล้ว");
         }
         else
         {
             alert("ไม่สามารถบันทึกข้อมูลได้ ");
         }
    })
    .done(function () {
       //   alert( "second success" );
    })
    .fail(function () {
       //    alert( "error" );
    })
    .always(function () {
       //   alert( "finished" );
    });

          
    });

});