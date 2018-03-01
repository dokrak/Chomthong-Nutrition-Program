/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
	
function total(){
	
		if(document.getElementById('cal1').value==""){document.getElementById('cal1').value=0;}
		if(document.getElementById('cal2').value==""){document.getElementById('cal2').value=0;}
		if(document.getElementById('cal3').value==""){document.getElementById('cal3').value=0;}
	var cal1=parseInt(document.getElementById('cal1').value);//parenteral calory1
       
	var cal2=parseInt(document.getElementById('cal2').value);//parenteral calory2
	var cal3=parseInt(document.getElementById('cal3').value);//enteral calory
        
      
		document.getElementById('tcal').value=cal1+cal2+cal3;
		//document.getElementById('en_cal').value=cal3;
		//document.getElementById('pn_cal').value=cal1+cal2;
	var prot1=parseInt(document.getElementById('prot1').value);
	var prot2=parseInt(document.getElementById('prot2').value);
	var prot3=parseInt(document.getElementById('prot3').value);
		document.getElementById('tprot').value=prot1+prot2+prot3;
	var fat1=parseInt(document.getElementById('fat1').value);
	var fat2=parseInt(document.getElementById('fat2').value);
	var fat3=parseInt(document.getElementById('fat3').value);
		document.getElementById('tfat').value=fat1+fat2+fat3;
	var tprot=document.getElementById('tprot').value;
	var tprot2=document.getElementById('tprot2').value;
	var tcal=parseInt(document.getElementById('tcal').value);
	var tcal2=parseInt(document.getElementById('tcal2').value);
	var tfat=parseInt(document.getElementById('tfat').value);
	var rq_cal=parseInt(document.getElementById('cal_req').value);
	var rq_prot=parseInt(document.getElementById('prot_req').value);
	var rq_fat=parseInt(document.getElementById('fat_req').value);
	var rq_n=document.getElementById('tNPC').value;
	var rq_vol=parseInt(document.getElementById('vol_req').value);
	
	var er=parseInt(document.getElementById('er').value);
	var water=parseInt(document.getElementById('water').value);
	var pr1=parseInt(document.getElementById('pr1').value).toFixed(2);
	var pr2=parseInt(document.getElementById('pr2').value).toFixed(2);
		//document.getElementById('en_pn').value=(100*cal3/rq_cal).toFixed(2);
		document.getElementById('en_pn').value=(100*cal3/rq_cal).toFixed(2);
		var e_ratio =document.getElementById('en_pn').value;		
		if(e_ratio>=60&&e_ratio<=100){
			document.getElementById('en_pn2').value="ผู้ป่วยได้รับสารอาหารทางลำไส้ได้พอสมควร";
			document.getElementById('sum').innerHTML="ควรพิจารณาหยุดการให้ Parenteral Supplement ได้";
			}else if(e_ratio<60){
			document.getElementById('en_pn2').value="ผู้ป่วยได้รับสารอาหารทางลำไส้น้อยกว่าที่ควร";
			document.getElementById('sum').innerHTML="ควรพิจารณาให้ Parenteral Supplement ต่อไป";
			}else if(e_ratio>100){
			document.getElementById('en_pn2').value="ผู้ป่วยได้รับสารอาหารทางลำไส้มากกว่าที่ควรได้รับ";
			document.getElementById('sum').innerHTML="ควรพิจารณาหยุด Parenteral และปรับ Enteral feeding ตามความเหมาะสมต่อไป";
			}
                        
                       
                        
		var NPC=(6.25*(parseInt(tcal)-(4*parseInt(tprot)))/parseInt(tprot)).toFixed(0);
                if(NPC == "NaN")NPC = 0;
		document.getElementById('tNPC').value=NPC+" : 1";
		document.getElementById('tcal2').value=(tcal*100/rq_cal).toFixed(2);
		document.getElementById('tprot2').value=(100*tprot/rq_prot).toFixed(2);
                var vol =er+water+24*(parseInt(pr1)+parseInt(pr2));
                if(isNaN(vol)){vol = 0;}
                
             //   alert(vol);
		document.getElementById('vol').value=vol;
		 
		document.getElementById('tfat2').value=(tfat*100/rq_fat).toFixed(2);
		document.getElementById('tvol').value=(vol*100/rq_vol).toFixed(2);
		
	}

function en(){
	document.getElementById('conc').focus();
	}
function con(){
	
	document.getElementById('er').focus();
	}
function p_1(){
	document.getElementById('pr1').value=0;
	document.getElementById('cal1').value="";
	document.getElementById('prot1').value="";
	document.getElementById('fat1').value="";
	document.getElementById('N1').value="";
	document.getElementById('pr1').focus();
	}
function p_2(){
	document.getElementById('pr2').value=0;
	document.getElementById('cal2').value="";
	document.getElementById('prot2').value="";
	document.getElementById('fat2').value="";
	document.getElementById('N2').value="";
	document.getElementById('pr2').focus();
	}
function fopr_1(){
	document.getElementById('pr1').value="";
	}
function fopr_2(){
	document.getElementById('pr2').value="";
	}
$(document).ready(function () {
    
    $("#tcal").val(0);
    $("#pr1").val(0);
    
    /*
echo("<script>");
  echo("alert('บันทึกข้อมูลสำเร็จ');");
  echo("window.location.href='/nutrition/file/screening.php';");
  echo("</script>");
  
  */
$('#en1,#conc,#er,#water').change(function(){
	var id=$('#en1').val();
	var conc=$('#conc').val();
	var er=$('#er').val();
	var water=$('#water').val();
	//alert("ID="+id+": Conc="+conc+": EN vol="+er);
        
        
        
	$.get("encal.php?id="+id,function(data){
		//alert(data);
		var en=data.split('#');
		var cal3=conc*er;
		var prot3=(en[1]*er)*conc/(1000);
		var fat3=en[2]*er*conc/(1000);
		var nameE1=en[3];
		//alert(E1);
		//alert("protein= "+prot3);
		$('#cal3').val(cal3);
		$('#prot3').val(prot3);
		$('#fat3').val(fat3);
		$('#N3').val(prot3/6.25);
		$('#nameE1').val(nameE1);
		total();
	});
	});

$('#pn1,#pr1').change(function(){
	
	var id=$('#pn1').val();
	var pr1=$('#pr1').val();
	var cal1=$('#cal1').value;
	var cal2=$('#cal2').value;
	var prot1=$('#prot1').value;
	var prot2=$('#prot2').value;
	var fat1=$('#fat1').value;
	var fat2=$('#fat2').value;
	//alert(id);
	$.get("pncal.php?id="+id,function(data){
		//alert(data);
		var pn=data.split('#');
		var cal1=pn[0]*pr1*24/pn[4];
                
             
		var prot1=pn[1]*pr1*24/pn[4];
		var fat1=pn[2]*pr1*24/pn[4];
		var N1=pn[3]*pr1*24/pn[4];
		var pname1=pn[5];
		$('#cal1').val(cal1);
		$('#prot1').val(prot1);
		$('#fat1').val(fat1);
		$('#N1').val(N1);
		$('#pname1').val(pname1);
		total();
	});
	
});

$('#pn2,#pr2').change(function(){
	
	var id=$('#pn2').val();
	var pr2=$('#pr2').val();
	//alert(id);
	$.get("pncal2.php?id="+id,function(data){
		//alert(data);
		var pn=data.split('#');
		var cal2=pn[0]*pr2*24/pn[4];
		var prot2=pn[1]*pr2*24/pn[4];
		var fat2=pn[2]*pr2*24/pn[4];
		var N2=pn[3]*pr2*24/pn[4];
		var pname2=pn[5];
		$('#cal2').val(cal2);
		$('#prot2').val(prot2);
		$('#fat2').val(fat2);
		$('#N2').val(N2);
		$('#pname2').val(pname2);
		total();
	});
});

    $("form").submit(function (event) {
        
        event.preventDefault();
        var hosp = $("#hosp").val();
        var HN = $("#HN").val();
        var AN = $("#AN").val();
        var treat_no = $("#treat_no").val();
        var score1 = $("#score1").val();
        var Fname = $("#Fname").val();
        var Lname = $("#Lname").val();
         var level = $("#result3").val();
        var risk = $("#risk").val();
        var age = $("#age").val();
        var sex = $("#sex").val();
        var en1 = $("#en1").val();
        var en2 = $("#en2").val();
        var pn1 = $("#pn1").val();
        var pn2 = $("#pn2").val();
        var pr1 = $("#pr1").val();
        var pr2 = $("#pr2").val();
        var tcal = $("#tcal").val();
        var cal_req = $("#cal_req").val();
        var vol = $("#vol").val();
        var vol_req = $("#vol_req").val();
        var tprot = $("#tprot").val();
        var prot_req = $("#prot_req").val();
        var tfat = $("#tfat").val();
        var fat_req = $("#fat_req").val();
        var tNPC = $("#tNPC").val();
        var cal3 = $("#cal3").val();
        var cal1 = $("#cal1").val();
        var cal2 = $("#cal2").val();
        var en_pn = $("#en_pn").val();
        var en_pn2 = $("#en_pn2").val();
        var screen_id = $("#screen_id").val();
        var Tdate = $("#Tdate").val();
               
        var data = {    
            hosp:hosp,
        HN:HN, 
        AN:AN,
        treat_no:treat_no,
        score1:score1,
        Fname:Fname,
        Lname:Lname,
        level:level,
        risk:risk,
        age:age,
        sex:sex,
        en1:en1,
        en2:en2,
        pn1:pn1,
        pn2:pn2, 
        pr1:pr1,
        pr2:pr2, 
        tcal:tcal,
        cal_req:cal_req, 
        vol:vol,
        vol_req:vol_req,
        tprot:tprot,
        prot_req:prot_req,
        tfat:tfat,
        fat_req:fat_req,
        tNPC:tNPC,
        cal3:cal3,
        cal1:cal1,
        cal2:cal2,
        en_pn:en_pn,
        en_pn2:en_pn2,
        screen_id:screen_id,
        Tdate:Tdate};
    
      $.post("service/treat_calNT.php",data, function (data) {
                
        if(data == 1)
        
		{	alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location='screening.php';
               /*
			    if(confirm('บันทึกข้อมูลเรียบร้อยแล้ว ต้องการพิมพ์การคัดกรองนี้หรือไม่ ?')==true)
                {	//alert('yes');
                    window.location='/hospital/reportTreat_calNT.php?HN='+HN;
       
                }
                else
                { //alert('No');
                            window.location='screening.php';
                }
				*/
            
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