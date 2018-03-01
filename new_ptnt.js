/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
   
            $("form").submit(function (event) {
          event.preventDefault();
             var HN1 = $("[name='HN1']").val();
            var Fname = $("[name='Fname']").val();
            var Lname = $("[name='Lname']").val();
            var age = $("[name=age]").val();
            var sex = $("[name='sex']").val();
            var address = $("[name='address']").val();
            var hosp = $("#hosp").val();

   // alert(hosp);return;
      
        $.post("service/new_ptnt.php", {HN1:HN1,Fname:Fname,Lname: Lname,age:age,sex:sex,address:address,hosp:hosp}, function (data) {
         //   alert(data);
             
            if(data == "ok")
            { //alert( "success" );
            //window.location = "screening.php";
          if(confirm('บันทึกข้อมูลเรียบร้อย ต้องการทำ Assessment ต่อหรือไม่? ')==true){window.location.href='triagent.php?HN='+HN1;
	}else{window.location.href='screening.php';}
		  
            
         }
         else if(data == "same")
         {
             alert("same");
             
             $("[name='HN1']").focus();
             
         }
         else 
         {
                    alert("wrong");

         }
		
		 
        })
                .done(function () {
                     // alert( "second success" );
                })
                .fail(function () {
                      // alert( "error" );
                })
                .always(function () {
                     // alert( "finished" );
                });
                
          
    });

/*

$("#login_form").submit(function( event ) {
  
  event.preventDefault();
});*/
});