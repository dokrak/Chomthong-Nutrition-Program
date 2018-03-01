/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
 
 var diet;
 var wtloss = 0;
 var bmis;
 var Hrisk="ผู้ป่วยมีโอกาสสูงที่จะเกิดภาวะทุพโภชนาการ ==> ควรประเมินต่อด้วย BNT2013 หรือ NAF";
 var Lrisk="ผู้ป่วยมีโอกาสต่ำที่จะเกิดภาวะทุพโภชนาการ ==>ควรประเมินซ้ำทุก 7 วัน ";       
 var hosp;
 var hcode;
  var Tdate;
  var HN;
  var AN;
  var ward;
  var bw;
  var ht;
  var critical;
  var bmi;
  var score;
  var bmis=0;
 // $('#AN').val(0);
  $('#AN').focus(0);
  $('#result').val(0);
  
 $("#AN").focus().keypress(function(e){
    
    if(e.keyCode == 13 || e.keyCode == 32)
    {   e.preventDefault();
      //  $("#bw").prop('disabled', false);

        $("#bw").focus();
        
      
   
    }
});

 $("#bw").change(function(e){
   
  //  if(e.keyCode == 13 || e.keyCode == 32)
  //  { 
        e.preventDefault();  
       
        //  $("#ht").prop('disabled', false); 
        $("#ht").focus();
        AN = $('#AN').val();
        
        if($('#bw').val() != "" && $('#ht').val() != "")
        {
            bmi=parseFloat((10000*$('#bw').val())/($('#ht').val()*$('#ht').val())).toFixed(2);
        
            $('#bmi').val(bmi);
    
            if(bmi<=18.5||bmi>=25)
            {
                if(bmis == 0)
                {
                    bmis=1;
                    
                    $('#bmi2').val("ใช่");

                    if($('#result').val() != "")
                    {
                        result = parseFloat($('#result').val())+bmis;
                        
                        $('#result').val(result);
                    }
                    else
                    $('#result').val(bmis);
                }
            }
            else
            {
                if(bmis ==1){$('#result').val( parseFloat($('#result').val())-1);}else{$('#result').val("0");}bmis=0;$('#bmi2').val("ไม่ใช่");}
            }
            
            var score =  $('#result').val();
	    if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);
    }
  
   // }
});
 
 $("#ht").change(function(e){
  
 //  if(e.keyCode == 13 || e.keyCode == 32)
  //  {
          e.preventDefault(); 
       //   $("#diet").prop('disabled', false);
          $("#diet").focus();
                  
          if($('#bw').val() != "" && $('#ht').val() != "")
        {
  	 bmi=parseFloat((10000*$('#bw').val())/($('#ht').val()*$('#ht').val())).toFixed(2);
        
        $('#bmi').val(bmi);
    
      if(bmi<=18.5||bmi>=25)
        { 
            if(bmis == 0)
            {
                bmis=1;
                $('#bmi2').val("ใช่");


                if($('#result').val() != "")
                {
                result = parseFloat($('#result').val())+bmis;
                 $('#result').val(result);
                }
                else
                $('#result').val(bmis);
            }
        }else{
            if(bmis ==1){$('#result').val( parseFloat($('#result').val())-1);}else{$('#result').val("0");}bmis=0;$('#bmi2').val("ไม่ใช่");
        }

        var score =  $('#result').val();
	if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);}
    } 
   // }
});
 $("#bw").keypress(function(e){
   
    if(e.keyCode == 13 || e.keyCode == 32)
   { 
        e.preventDefault();  
       
        //  $("#ht").prop('disabled', false); 
        $("#ht").focus();
        AN = $('#AN').val();
        
        if($('#bw').val() != "" && $('#ht').val() != "")
        {
            bmi=parseFloat((10000*$('#bw').val())/($('#ht').val()*$('#ht').val())).toFixed(2);
        
            $('#bmi').val(bmi);
    
            if(bmi<=18.5||bmi>=25)
            {
                if(bmis == 0)
                {
                    bmis=1;
                    
                    $('#bmi2').val("ใช่");

                    if($('#result').val() != "")
                    {
                        result = parseFloat($('#result').val())+bmis;
                        
                        $('#result').val(result);
                    }
                    else
                    $('#result').val(bmis);
                }
            }
            else
            {
                if(bmis ==1){$('#result').val( parseFloat($('#result').val())-1);}else{$('#result').val("0");}bmis=0;$('#bmi2').val("ไม่ใช่");}
            }
            
            var score =  $('#result').val();
	    if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);
    }
  
    }
});
 
 $("#ht").keypress(function(e){
  
if(e.keyCode == 13 || e.keyCode == 32)
    { 
          e.preventDefault(); 
       //   $("#diet").prop('disabled', false);
          $("#diet").focus();
                  
          if($('#bw').val() != "" && $('#ht').val() != "")
        {
  	 bmi=parseFloat((10000*$('#bw').val())/($('#ht').val()*$('#ht').val())).toFixed(2);
        
        $('#bmi').val(bmi);
    
        if(bmi<=18.5||bmi>=25)
        { 
            if(bmis == 0)
            {
                bmis=1;
                $('#bmi2').val("ใช่");


                if($('#result').val() != "")
                {
                result = parseFloat($('#result').val())+bmis;
                 $('#result').val(result);
                }
                else
                $('#result').val(bmis);
            }
        }else{
          
            if(bmis ==1){$('#result').val( parseFloat($('#result').val())-1);}else{$('#result').val("0");}bmis=0;$('#bmi2').val("ไม่ใช่");
        }

        var score =  $('#result').val();
	if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);}
    } 
    }
});
 $("#diet").change(function(){
     
    if($(this).val()!= "-")
    { 
        $("#wtloss").prop('disabled', false);
        $("#wtloss").focus();
        if($('#diet').val()=="มี"){diet=1;$('#result').val( parseFloat($('#result').val())+1);}else{if(diet ==1){$('#result').val( parseFloat($('#result').val())-1);}diet=0;}
        	 var score =  $('#result').val();
	if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);}
        
	 
    }
 });
 
 $("#wtloss").change(function(){
     
    if($(this).val()!= "-")
    { 
        $("#critical").prop('disabled', false);
        $("#critical").focus();
        
        if($('#wtloss').val()=="มี"){wtloss=1; $('#result').val( parseFloat($('#result').val())+1);}else{if(wtloss == 1){$('#result').val( parseFloat($('#result').val())-1);}wtloss=0;}
        	 var score =  $('#result').val();
	if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);}
     }
 });

 $("#critical").focus().change(function(){
     
    if($(this).val()!= "-")
    {
        if($('#critical').val()=="มี"){critical=1;$('#result').val( parseFloat($('#result').val())+1); }else{if(critical == 1){$('#result').val( parseFloat($('#result').val())-1);}critical=0;}
        
       
	 var score =  $('#result').val();
	if(score>=2){$('#rec').val(Hrisk);}else{$('#rec').val(Lrisk);}

    }
 });

 $("form").submit(function (event) {
   var Tdate =  $('#Tdate').val();
   var hosp =  $('#hosp').val();
	var hid=$('#hid').val();
   var  ward =  $('#ward3').val();
   var bw =  $('#bw').val();
   var ht =  $('#ht').val();
   var score =  $('#result').val();
    
   
var HN = $('[name="HN"]').val();
var reporter = $('#reporter').val();

  $.post("service/triagent.php", 
  {hosp:hosp,hid:hid,Tdate:Tdate,HN:HN,AN:AN,ward:ward,bw:bw,ht:ht,diet:diet,wtloss:wtloss,critical:critical,bmi:bmi,score:score,
   reporter:reporter}, function (data) {
           alert(data);
            if(data != "error")
            {
                 if(confirm('บันทึกข้อมูลเรียบร้อยแล้ว ต้องการพิมพ์การคัดกรองนี้หรือไม่ ?')==true)
                {	//alert('yes');
                            //alert('success and ID='+HN);
                            
                             window.location= "reportTriagent.php?HN="+HN+"&case="+data;
                             /*
                             if(data == "High Risk")
                             { 
                                        if(confirm('ผู้ป่วยรายนี้ ==>'+data+' ต่อภาวะทุพโภชนาการ คุณต้องการทำการประเมินอย่างละเอียดต่อไปหรือไม่?')==true)
                                        {	//alert('yes');
                                           window.location='/hospital/chose.php'; 


                                        }
                                        else
                                        { //alert('No');

                                               window.location='screening.php';
                                        }
                            }
                            else
                            {
                            window.location='screening.php';
                         };*/       
        
                }
                else
                { //alert('No');
                            window.location.href='screening.php';
                }
               
             }
             else
             {
                 alert("please login");
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

});