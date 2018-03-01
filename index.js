/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
   
     
        $("#uname").focus(function(){$(this).css('border','1px solid #6666FF');})
                   .blur(function(){$(this).css('border','');});
        
          $("#password").focus(function(){$(this).css('border','1px solid #6666FF');})
                       .blur(function(){$(this).css('border',''); })
    
       $("form").submit(function (event) {
          
         
        var name = $("#uname").val();

        var pass = $("#password").val();
         var rememberme = $("[name=rememberme]").prop("checked");
      
        $.post("service/login.php", {name: name, password: pass,rememberme:rememberme}, function (data) {
             
            if(data == "ok")
            {
                alert( "success" );
                
                window.location = "screening.php";
          

                 }
                 else
                 {
                     alert("incorrect");
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
                
          
event.preventDefault();
    });

/*

$("#login_form").submit(function( event ) {
  
  event.preventDefault();
});*/
});