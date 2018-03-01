/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function prnt()
{
    
}
/*function prnt()
{	var hn=document.getElementById("HN").value;
	var message = "ต้องการพิมพ์ข้อมูลการคัดกรอง ?";
	var prnt="ต้องการประเมินอย่างละเอียดด้วย NT-2013 tool ?";
	 if(confirm(message)==true){window.print() ;
	 	if(confirm(prnt)==true){window.location.href='/nutrition/file/NT2013.php?HN='+hn;}else{window.location.href='/nutrition/file/screening.php';
	 }
	 
	 }else
	 {	
	 	if(confirm(prnt)==true){window.location.href='/nutrition/file/NT2013.php?HN='+hn;}else{window.location.href='/nutrition/file/screening.php';
	 }
	 }
}
*/



$(document).ready(function () {      


 var beforePrint = function() {
     
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
      
      
         if(risk == "High Risk")
         { 
                    if(confirm('ผู้ป่วยรายนี้ ==>'+risk+' ต่อภาวะทุพโภชนาการ คุณต้องการทำการประเมินอย่างละเอียดต่อไปหรือไม่?')==true)
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
     };       
        
    };

    if (window.matchMedia) {
      
        var mediaQueryList = window.matchMedia('print');
        
        
        mediaQueryList.addListener(function(mql) {
            
          
            if (mql.matches) {
                beforePrint();
            } else {  
                afterPrint();
                
                return false;
            }
        });
    }

    $("#print").click(function(e){
    e.preventDefault();
    
    window.print();
    })
});