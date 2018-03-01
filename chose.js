/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
   var name;
    $("form").submit(function (event) {
          
         event.preventDefault();

        var chose =$("[name='chose']:checked").val();

              
        if(chose == undefined)
        alert("กรถณาเลือกวิธีการ Assessment");
        else
        {
            if(chose == "naf")
            name = "NAF";
            else if(chose == "bnt2013")
            name = "NT2013";
      
           window.location = name+".php";
        }
    });

});