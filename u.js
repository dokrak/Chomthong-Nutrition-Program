/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
   
    var event_click = function() 
    {
        var classname = $(this).attr("class");
        
        $("."+classname).off("click");
        $("."+show).on("click",event_click);
        $(".u_"+show).hide();
        show = classname;
        
        $(".u_"+classname).show();
    }
    
    var show = $(".right_col:visible").attr("class").split("right_col u_")["1"];
  $(".side-menu").children().not($("."+show)).on("click",event_click);
  

});