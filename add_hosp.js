/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $("form").submit(function (event) {
                event.preventDefault();

        var hid = $('#hid').val();
        var hosid = $('[name="hosID"]').val();
        var hosname = $('[name="hosName"]').val();
        var province = $('[name="province"]').val();
        
       if(!hosid.match(/^\d+$/)) {
           alert("only number");
           $('[name="hosID"]').val("").focus();
           
           return;

    // your code here
        }
   
        var data = {  
            hid:hid,
            hosid:hosid,
            hosname:hosname,
            province:province
      };
      
  $.post("service/add_hosp.php",data, function (result) {
     console.log(result);
      if(result == 1)
        {
            
  	$msg = "บันทึกข้อมูลสำเร็จแล้ว";
  	 
	if(confirm($msg)==true){window.location.href='add_hosp.php';}else{
	window.location.href='screening.php';}
	 
	 
	 
            
         }
         else if(result == "same")
         {
             alert("เลขหน่วยบริการนี้ได้เคยบันทึกแล้ว");
         }
         else
         {
             alert("ไม่สามารถบันทึกข้อมูลได้");
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