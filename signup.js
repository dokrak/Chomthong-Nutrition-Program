/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
    var uname = null;
    var password = null;
    var email = null;
    var sex = null;
    var province = null;
    
        $("#uname").focus(function(){$(this).css('border','1px solid #6666FF');})
                   .blur(function(){
                                      $(this).css('border','');
                uname = $(this).val();
             
                if(uname.length > 4)
                {
                   if($(".warning_uname").length)
                   {
                       $(".warning_uname").remove();
                   }
                   
                    if($(".success_uname").length)
                    {
                        $(".success_uname").css("color","#4ec34b");
                        
                        setTimeout(function(){$(".success_uname").css("color","#1ca129");},200);
                    }
                    else
                    {
                         $(this).after( "<span class='success_uname'>คุณสามารถใช้นามแฝงนี้ได้</span>");
                         
                         $(".success_uname").css("color","#1ca129");
                    }
                }
                else
                { 
                    if($(".warning_uname").length)
                    {
                        $(".warning_uname").css("color","#f00");
                        
                        setTimeout(function(){$(".warning_uname").css("color","f77");},200);
                    }
                    else
                    {
                        if($(".success_uname").length)
                        {
                            $(".success_uname").remove();
                        }
                        $(this).after( "<span class='warning_uname'>ต้องมีอย่างน้อย 6 ตัวอักษร</span>");
                        
                        $(".warning_uname").css("color","#f77");
                    }
                    
                    uname = null;
                }
            })
        
         
        $("#email").focus(function(){$(this).css('border','1px solid #6666FF');})
                   .blur(function(){
                       $(this).css('border',''); 
            
        
                email = $(this).val();
                
                if(email.length > 0)
                {
                    if(isValidEmailAddress(email))
                    {
                        if($(".warning_email_null").length)
                        {
                           $(".warning_email_null").remove();
                        }

                          if($(".warning_email_wrong").length)
                        {
                           $(".warning_email_wrong").remove();
                        }

                        if($(".success_email").length)
                        {
                            $(".success_email").css("color","#4ec34b");

                            setTimeout(function(){$(".success_email").css("color","#1ca129");},200);
                        }
                        else
                        {
                             $(this).after( "<span class='success_email'>คุณสามารถใช้อีเมล์นี้ได้</span>");

                             $(".success_email").css("color","#1ca129");
                        }
                    }
                    else
                    {
                         if($(".success_email").length)
                        {
                            $(".success_email").remove();
                        }

                         if($(".warning_email_null").length)
                         {
                                $(".warning_email_null").remove();
                         }
                         
                        if($(".warning_email_wrong").length)
                        {
                            $(".warning_email_wrong").css("color","#f00");

                            setTimeout(function(){$(".warning_email_wrong").css("color","f77");},200);
                        }
                        else
                        {
                            $(this).after( "<span class='warning_email_wrong'>กรุณาใช้รูปแบบอีเมล์ที่ถูกต้องและห้ามเคาะวรรค</span>");

                            $(".warning_email_wrong").css("color","#f77");
                        }

                        email = null;
                    }
                }
                else
                {
                    if($(".success_email").length)
                    {
                        $(".success_email").remove();
                    }

                    if($(".warning_email_wrong").length)
                    {
                        $(".warning_email_wrong").remove();
                    }
                    
                    if($(".warning_email_null").length)
                    {
                       $(".warning_email_null").css("color","#f00");

                       setTimeout(function(){$(".warning_email_null").css("color","f77");},200);
                    }
                    else
                    {
                        $(this).after("<span class='warning_email_null'>กรุณากรอกอีเมล์</span>");
                        
                        $(".warning_email_null").css("color","#f77");
                    }

                     email = null;
                }
            });
        
         $("#password").focus(function(){$(this).css('border','1px solid #6666FF');})
                       .blur(function(){$(this).css('border',''); 
               
                
                password = $(this).val();
                
                if(password.length > 4)
                {
                    
                }
                else
                {
                    password = null;
                    
                    $(this).after("ต้องมีอย่างน้อย 6 ตัวอักษร");
                }
            }
            
        );
        
         $("#sex").children("select").change(function(){
            
             sex = $(this).val();
             
         });
         
         $("#province").children("select").change(function(){
             
            province = $(this).val();
             
         });
         
         $("#signupform").submit(function (event) {
   //alert(uname+" "+email+"  "+password);
        event.preventDefault();
        
        var data ={};
     
        if(uname == null || password == null || email == null)
        return;
    
        data.uname = uname;
        data.email = email;
        data.password = password;
        data.sex = sex;
        data.province = province;


          $.ajax({
            type:'POST',
            url:  "service/signup.php",
            data:data,
            //cache:false,
           // contentType: false,
           // processData: false,
           // dataType:'json',
            success:function(data){ 
                alert(data);
                if(data == "accept")
                {
                    alert("ไปที่ email");
                }
                else if(data == "reject")
                {
                    alert("ผิดพลาด");
                }
                
              
            }
        });
       
    });

});