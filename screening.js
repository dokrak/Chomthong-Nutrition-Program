/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
       
       $("form").submit(function (event) {
         
             event.preventDefault();

             var page = $(this).attr("id");
               
             var HN = $(this).find("#HN").val();
                $.post("service/screening.php", {HN:HN,page:page}, function (data) {
                
                    if(data == 1)
                    {
                        //alert("ปิด alert");
                        
                        window.location = page+".php?HN="+HN;
                    }
                    else if(data == "don't login")
                    window.location = "index.php";
                    else if(data == 0)
                    {
                        alert("ไม่พบผู้ป่วยรายนี้ โปรดลงทะเบียนผู้ป่วยใหม่");
                        
                        window.location = "new_ptnt.php?HN="+HN;
                    }
                    else if(data == 2)
                    {
                        alert("ผู้ป่วยรายนี้ยังไม่ผ่านการคัดกรองเบื้องต้น"); 
                        
                        $("#"+page).find("#HN").val('');
                        
                        $("#triagent").find("#HN").focus();
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
          
           
           $("#logout").click(function(){
                 $.post("service/logout.php", function (data,status) {alert(status);window.location="index.php"});
           });
    });