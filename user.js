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
        var uname = $('[name="uname"]').val();
		var pw = $("[name='pw']").val();
        var level = $('[name="level"]').val();
        var mail = $('[name="mail"]').val();
        
              var data = {  
            Fname :fname,
            Lname :lname ,
            uname :uname ,
			pw :pw,
			level :level,
			mail :mail
                };
       $.post("service/user.php",data, function (result) {
     console.log(result);
      if(result == 1)
        {
          $msg = "บันทึกข้อมูลสำเร็จแล้ว เพิ่มรายชื่อผู้ใช้อีกหรือไม่?";
var r = confirm($msg);
if (r == true) {
	
 //$('#Fname').val("");
 //$('#Lname').val("");
	//$('#code').val("");
	//$('#lname').val("");
	//$('#Fname').focus();
	window.location="user.php";

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