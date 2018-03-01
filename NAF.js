/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function wbcdis(){
	var alb=document.getElementById('albdiv');
	var wbc=document.getElementById('wbcdiv');
	var bw_s=$('#bw_s');
	var alb_s=$('#alb_s');
	var wbc_s=$('#wbc_s');
	wbc.style.display="none";
	//wbc_s.value(0);
       
	}
function albdis(){
	var alb=document.getElementById('albdiv');
	var wbc=document.getElementById('wbcdiv');
	alb.style.display="none";
	//alb_s.value(0);
	}
        
function show(box) 
{	var bw= document.getElementById('bwdiv');
	var alb=document.getElementById('albdiv');
	var wbc=document.getElementById('wbcdiv');
	var text=document.getElementById('text');
	
		bw.style.display="none";
		alb.style.display="none";
		wbc.style.display="none";
		text.style.display="none";
	//alert(box.value);	
	if(box.value==1)
		{	//alert(box.value);
		bw.style.display="";
		alb.style.display="none";
		wbc.style.display="none";
		text.style.display="none";
		//alert("ทราบน้ำหนัก");
		//bw.style.display="";
		$('#bw_s').val(0);
		$('#bw').focus();
		//bw.value("");
		alb.style.display="none";
		$('#alb').val(0);
		
		$('#alb_s').val(0);
		wbc.style.display="none";
		$('wbc').val(0);
		$('#lymp').val(0);
		$('#TLC').val(0);
		$('#wbc_s').val(0);
		text.style.display="none";
		}else if(box.value==2)
			{	
			//alert(box.value);
			bw.style.display="none";
			//alert("ไม่ทราบน้ำหนัก");
			$('#bw_s').val(0);
			$('#bw').val(0);
			$('#bmi').val(0);
			alb.style.display="";
			wbc.style.display="";
			text.style.display="";
			//alb.style.display="";
			$('wbc').val(0);
			$('#alb_s').val(0);
			$('#wbc_s').val(0);
			
		
			}
	

}

function show1(box) 
{
    var ht= document.getElementById('ht');
    var ht_tell= document.getElementById('ht_tell');
    var ht1= document.getElementById('ht1');
    var ht2= document.getElementById('ht2');

    if(box.value==1)
    {
            ht.style.display="";
           ht_tell.style.display="none";
            ht_tell.value="0";
			ht.value="";
			ht.focus();
    }
    else if(box.value==2)
    {
        ht_tell.style.display="";
        ht.style.display="none";
        ht.value="0";
		ht_tell.value="";
		ht_tell.focus();
    }
}

function start(){
	$('#AN').focus();
	document.getElementById('bwdiv').style.display='none';
	document.getElementById('text').style.display='none';
	document.getElementById('albdiv').style.display='none';
	document.getElementById('wbcdiv').style.display='none';
	//document.getElementById('ht').style.display='none';
	document.getElementById('ht_tell').style.display='none';
	}
function next1(){
	$('#ward').focus();
	}
function next2(){
	$('#bw').focus();
	}
function next3(){
	$('#diag').focus();
	}	
function next4(){
	$('#ecog').focus();
	}
function next5(){
	$('#diet_type').focus();
	}
		
function score(){
	var bmi_s=parseInt($('#bmi_s').val());
	var shape_s=parseInt($('#shape_s').val());
        
	var wt_s=parseInt($('#wt_s').val());
	var  diet_s=parseInt($('#diet_s').val());
	var  gi_s=parseInt($('#gi_s').val());
	var  status_s=parseInt($('#status_s').val());
	var  dis_s=parseInt($('#dis_s').val());
	/*
	alert(bmi_s);
	alert(shape_s);
	alert(wt_s);
	alert(diet_s);
	alert(gi_s);
	alert(status_s);
	alert(dis_s);
	*/
	var score=parseInt(bmi_s+shape_s+wt_s+diet_s+gi_s+status_s+dis_s);
        
      
	//alert("NAF score = "+score);
	$('#score').val(score);



	if(score>=0&&score<=5){
		var score=$('#score').val();
		var bw=$('#bw').val();
		var cal=22.5*bw;
		var cal2="("+20*bw+"-"+25*bw+") Kcal/d";  //20-25kcal/kg/d
		var prot=1*bw;
		var prot2="("+parseInt(0.8*bw)+"-"+parseInt(1.2*bw)+") gm/d"; //0.8-1.2 gm/kg/d
		var fat1=parseInt(1.1*bw);
		var fat2="("+parseInt(0.7*bw)+"-"+parseInt(1.5*bw)+")gm/d"; //0.7-1.5 gm/kg/d
		var vol=30*bw;
		var vol2="("+25*bw+"-"+35*bw+") ml/d"; //30-40 ml/kg/d
		var npc=cal-4*prot;
		var n=prot/6.25; 
		var npcn=parseInt(npc/n);
		//alert("Modified NAF = A");
		//alert("score"+cal);alert("score"+prot);alert("score"+vol);
		$('#cal_req').val(cal);$('#cal_req2').val(cal2);
		$('#prot_req').val(prot);$('#prot_req2').val(prot2);
		$('#fat_req').val(fat1);$('#fat_req2').val(fat2);
		$('#vol_req').val(vol);$('#vol_req2').val(vol2);
		$('#npc').val(npcn+":"+1);$('#npc2').val("ได้โปรตีน="+parseInt(400*prot/cal)+"% ของ cal");
		$('#level').val("Modified NAF = A :มีความเสี่ยงต่ำต่อการเกิดภาวะทุพโภชนาการ");
		$('#result1').val("ติดตามประเมินทุก 6-8 wk");
		
		}else if(score>=6&&score<=14){
		//alert("Modified NAF = B ");//alert("score"+cal);alert("score"+prot);alert("score"+vol);
		var score=$('#score').val();
		var bw=$('#bw').val();
		var cal=27.5*bw;
		var cal2="("+25*bw+"-"+30*bw+") Kcal/d";  //25-30.5kcal/kg/d
		var prot=1.5*bw;
		var prot2="("+parseInt(1.25*bw)+"-"+parseInt(1.75*bw)+") gm/d"; //1.25-1.75 gm/kg/d
		var fat1=parseInt(1.1*bw);
		var fat2="("+parseInt(0.7*bw)+"-"+parseInt(1.5*bw)+")gm/d"; //0.7-1.5 gm/kg/d
		var vol=30*bw;
		var vol2="("+30*bw+"-"+40*bw+") ml/d"; //30-40 ml/kg/d
		var npc=cal-4*prot;
		var n=prot/6.25; 
		var npcn=parseInt(npc/n);
		$('#cal_req').val(cal);$('#cal_req2').val(cal2);
		$('#prot_req').val(prot);$('#prot_req2').val(prot2);
		$('#fat_req').val(fat1);$('#fat_req2').val(fat2);
		$('#vol_req').val(vol);$('#vol_req2').val(vol2);
		$('#npc').val(npcn+":"+1);$('#npc2').val("ควรได้โปรตีน="+parseInt(400*prot/cal)+"% ของ cal");
		$('#level').val("Modified NAF = B  : มีภาวะทุพโภชนาการปานกลาง");
		$('#result1').val("ควรให้การรักษาทางโภชนบำบัด");
		
		}else if(score>=15){
		//alert("Modified NAF = C : มีภาวะทุพโภชนาการรุนแรง");//alert("score"+cal);alert("score"+prot);alert("score"+vol);
		var score=$('#score').val();
		var bw=$('#bw').val();
		var cal=32.5*bw;
		var cal2="("+30*bw+"-"+35*bw+") Kcal/d";  //30-35kcal/kg/d
		var prot=2*bw;
		var prot2="("+1.8*bw+"-"+2.25*bw+") gm/d"; //1.8-2.5 gm/kg/d
		var fat1=parseInt(1.1*bw);
		var fat2="("+parseInt(0.7*bw)+"-"+parseInt(1.5*bw)+")gm/d"; //0.7-1.5 gm/kg/d
		var vol=35*bw;
		var vol2="("+30*bw+"-"+40*bw+") ml/d"; //30-40 ml/kg/d
		var npc=cal-4*prot;
		var n=prot/6.25; 
		var npcn=parseInt(npc/n);
		$('#cal_req').val(cal);$('#cal_req2').val(cal2);
		$('#prot_req').val(prot);$('#prot_req2').val(prot2);
		$('#fat_req').val(fat1);$('#fat_req2').val(fat2);
		$('#vol_req').val(vol);$('#vol_req2').val(vol2);
		$('#npc').val(npcn+":"+1); $('#npc2').val("ควรได้โปรตีน="+parseInt(400*prot/cal)+"% ของ cal");
		$('#level').val("Modified NAF = C : มีภาวะทุพโภชนาการรุนแรง");
		$('#result1').val("ควรปรึกษาทีมโภชนบำบัด");
		}
	}


function bws()
{ 
    var bw_s=parseInt($('#bw_s').val());
	
   
	
	var ht_tell=$('#ht_tell').val();
	 if(ht_tell.length > 0 && !$.isNumeric(ht_tell))
    {
        alert("please numeric");

        $('#ht_tell').val(""); 
		$('#ht_tell').focus();               
		$('#ht').val(0); 
        return;
    }
	
     var ht=$('#ht').val();
    if(ht.length > 0 && !$.isNumeric(ht))
    {
        alert("please numeric");

        $('#ht').val(""); 
		$('#ht').focus();
		$('#ht_tell').val(0);                

        return;
    }
    
    var bw=$('#bw').val();
    
    if(bw.length > 0 && !$.isNumeric(bw))
    {
        alert("please numeric");

        $('#bw').val("");   
		$('#bw').focus();             

        return;
    }
	var h=parseInt(ht);
    var bmi;
    if($.isNumeric(bw) && $.isNumeric(ht))
    { if(ht!=0&&ht_tell==0){
        bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);
		}else if(ht==0&&ht_tell!=0)
		{
		
		bmi=parseFloat(10000*bw/(ht_tell*ht_tell)).toFixed(2);	
		}
		
    	$('#bmi').val(bmi);
    }else{ 
		$('#bmi').val("error");
	}
    
    var wtm;
    var wts;
    wtm=parseInt($('#wt_method').val());

    if($.isNumeric(wtm))
    { 
        if(wtm==3)
        {
            wts=1;
                //alert("WT method="+wts)
        }
        else
        {
            wts=0;
                                //alert("WT method="+wts)
        }
    }
    
    if($.isNumeric(bmi) && $.isNumeric(wts))
    {
    //alert(wts);	
    if(bmi<17&&bmi>0)
    {
        var bmis=2;
            //alert("BMI="+bmi+": score="+bmis);
    }
    else if ((bmi>=17&&bmi<=18))
    {
        var bmis=1;
                    //alert("BMI="+bmi+": score="+bmis);
    }
    else if (bmi>18&&bmi<30)
    {
    var bmis=0;
    //alert("BMI="+bmi+": score="+bmis);
    }
    else if(bmi>=30){
        var bmis=1;
    //alert("BMI="+bmi+": score="+bmis);
    }

    bw_s=parseInt(wts)+parseInt(bmis);
    //alert("BW score="+bw_s);
    $('#bw_s').val(bw_s);
    $('#bmi_s').val(bw_s);
    $('#alb_s').val(0);
    $('#wbc_s').val(0);

    score();}
}
	
function chksw1(){
	var sw1=document.getElementById('sw1');
	var tsw1=$('#tsw1').val();
	if(sw1.checked){ 
		//alert("sw1 checked");
		$('#tsw1').val(2);
		var tsw1=2;
		}else{
			//alert("sw1 not checked");
			$('#tsw1').val(0);
			var tsw1=0;
			}
	sw_s();
	gi_s();
	score();
}

function chksw2(){
	var sw2=document.getElementById('sw2');
	var tsw2=$('#tsw2').val();
	if(sw2.checked){ 
		//alert("sw2 checked");
		$('#tsw2').val(2);
		var tsw2=2;
		}else{
			//alert("sw2 not checked");
			$('#tsw2').val(0);
			var tsw2=0;
			}
	sw_s();
	gi_s();
	
}

function chksw3(){
	var sw1=document.getElementById('sw1');
	var sw2=document.getElementById('sw2');
	var sw3=document.getElementById('sw3');
	var tsw3=$('#tsw3').val();
	if(sw3.checked){ 
		//alert("sw3 checked");
		var tsw2=sw2.value;
		var tsw1=sw1.value;
		$('#tsw1').val(0);
		//tsw1=0;
		$('#tsw2').val(0);
		//tsw2=0;
		$('#tsw3').val(0);
		var tsw3=0;
		}
	sw_s();
	gi_s();
	
}

function sw_s(){
	var sw1=document.getElementById('tsw1').value;
	var sw2=document.getElementById('tsw2').value;
	var sw3=document.getElementById('tsw3').value;
	var sw_s=document.getElementById('sw_s').value;
	sw_s=parseInt(sw1)+parseInt(sw2)+parseInt(sw3);
	$('#sw_s').val(sw_s);
	}
	
function chkGI3(){
	var gi3=document.getElementById('GI3');
	var tgi3=$('#tgi3').val();
	if(gi3.checked){ 
		//alert("GI3 checked");
		$('#tgi1').val(0);
		$('#tgi2').val(0);
		$('#tgi3').val(0);
		
		var tgi3=0;
		}
	tgi_s();
	gi_s();
}

function chkGI2(val){
	var gi2=document.getElementById('GI2');
	var tgi2=$('#tgi2').val();
	if(gi2.checked){ 
		//alert("GI2 checked");
		$('#tgi2').val(2);
		var tgi2=2;
		}else{
			//alert("GI2 not checked");
			$('#tgi2').val(0);
			var tgi2=0;
			}
		tgi_s();
		gi_s();
}

function chkGI1(){
	var gi1=document.getElementById('GI1');
	var tgi1=$('#tgi1').val();
	if(gi1.checked){ 
		//alert("GI1 checked");
		$('#tgi1').val(2);
		var tgi1=2;
		}else{
			//alert("GI1 not checked");
			$('#tgi1').val(0);
			var tgi1=0;
			}
	tgi_s();
	gi_s();
}

function tgi_s(){
	var tgi1=document.getElementById('tgi1').value;
	var tgi2=document.getElementById('tgi2').value;
	var tgi3=document.getElementById('tgi3').value;
	var tgi_s=document.getElementById('sw_s').value;
	tgi_s=parseInt(tgi1)+parseInt(tgi2)+parseInt(tgi3);
	$('#tgi_s').val(tgi_s);
	
	}


function chkvom1(){
	var vom1=document.getElementById('vom1');
	var tvom1=$('#tvom1').val();
	if(vom1.checked){ 
		//alert("vom1 checked");
		$('#tvom1').val(2);
		var tvom1=2;
		}else{
			//alert("vom1 not checked");
			$('#tvom1').val(0);
			var tvom1=0;
			}
			tvom_s();
			gi_s();
}

function chkvom2(){
	var vom2=document.getElementById('vom2');
	var tvom2=$('#tvom2').val();
	if(vom2.checked){ 
		//alert("vom2 checked");
		$('#tvom2').val(2);
		var tvom2=2;
		}else{
			//alert("vom2 not checked");
			$('#tvom2').val(0);
			var tvom2=0;
			}
			tvom_s();
			gi_s();
}
function tvom_s(){
	var tvom1=document.getElementById('tvom1').value;
	var tvom2=document.getElementById('tvom2').value;
	var tvom3=document.getElementById('tvom3').value;
	var tvom_s=document.getElementById('tvom_s').value;
	tvom_s=parseInt(tvom1)+parseInt(tvom2)+parseInt(tvom3);
	$('#tvom_s').val(tvom_s);
	
	}

function chkvom3(){
	var vom3=document.getElementById('vom3');
	var tvom3=$('#tvom3').val();
	if(vom3.checked){ 
		//alert("vom3 checked");
		$('#tvom3').val(0);
		var tvom3=0;
		}else{ 
			//alert("vom3 not checked");
			$('#tvom3').val(0);
			var tvom3=0;
			}
			tvom_s();
			gi_s();
}


function gi_s(){
	var gi_s=$('#gi_s').val();
	var tsw1=$('#tsw1').val();
		if($('#tsw1').val()==""){tsw1=0; }else{tsw1=$('#tsw1').val();}
	var tsw2=$('#tsw2').val();
		if($('#tsw2').val()==""){tsw2=0; }else{tsw2=$('#tsw2').val();}
	var tsw3=$('#tsw3').val();
		if($('#tsw3').val()==""){tsw3=0; }else{tsw3=$('#tsw3').val();}	
		
	var tgi1=$('#tgi1').val();
		if($('#tgi1').val()==""){tgi1=0; }else{tgi1=$('#tgi1').val();}
	var tgi2=$('#tgi2').val();
		if($('#tgi2').val()==""){tgi2=0; }else{tgi2=$('#tgi2').val();}
	var tgi3=$('#tgi3').val();
		if($('#tgi3').val()==""){tgi3=0; }else{tgi3=$('#tgi3').val();}
	
	var tvom1=$('#tvom1').val();
		if($('#tvom1').val()==""){tvom1=0; }else{tvom1=$('#tvom1').val();}
	var tvom2=$('#tvom2').val();
		if($('#tvom2').val()==""){tvom2=0; }else{tvom2=$('#tvom2').val();}
	var tvom3=$('#tvom3').val();
		if($('#tvom3').val()==""){tvom3=0; }else{tvom3=$('#tvom3').val();}
	
	
	gi_s=parseInt(tsw1)+parseInt(tsw2)+parseInt(tsw3)+parseInt(tgi1)+parseInt(tgi2)+parseInt(tgi3)+parseInt(tvom1)+parseInt(tvom2)+parseInt(tvom3);
	//gi_s=parseInt(sw_s)+parseInt(tgi_s)+parseInt(tvom_s);
	
	$('#gi_s').val(gi_s);
	//alert("คแแนนอาการของระบบทางเดินอาหาร="+gi_s);
	score();
	
	}	
	
//DISEASE SCORE	
function chkdis1(){
	var dm=document.getElementById('dm');
	var tdm=document.getElementById('tdm').value;
	if(dm.checked){
		//alert("tdm=3");
		$('#tdm').val(3);
		var tdm=3;
		}else{$('#tdm').val(0);
		var tdm=0;}
		dis_s();
	}
function chkdis2(){
	var ca=document.getElementById('ca');
	var tca=document.getElementById('tca').value;
	if(ca.checked){
		//alert("tca=3");
		$('#tca').val(3);
		var tca=3;
		}else{$('#tca').val(0);
		var tca=0;}
		dis_s();
	}
	
function chkdis3(){
	var hip=document.getElementById('hip');
	var thip=document.getElementById('thip').value;
	if(hip.checked){
		//alert(3);
		$('#thip').val(3);
		var thip =3;
		}else{$('#thip').val(0);
		var thip =0;}
		dis_s();
	}
function chkdis4(){
	var cva=document.getElementById('cva');
	var tcva=document.getElementById('tcva').value;
	if(cva.checked){
		//alert(6);
		$('#tcva').val(6);
		var tcva =6;
		}else{$('#tcva').val(0);
		var tcva =0;}
		dis_s();
	}
function chkdis5(){
	var mulfx=document.getElementById('mulfx');
	var tmulfx=document.getElementById('tmulfx').value;
	if(mulfx.checked){
		//alert(6);
		$('#tmulfx').val(6);
		var tmulfx=6;
		}else{$('#tmulfx').val(0);
			var tmulfx=0;}
		dis_s();
	}
	
//แถวที่ 2
function chkdis6(){
	var ckd=document.getElementById('ckd');
	var tckd=document.getElementById('tckd').value;
	if(ckd.checked){
		//alert(3);
		$('#tckd').val(3);
		var tckd=3;
		}else{$('#tckd').val(0);
			var tckd=0;}
		dis_s();
	}
	
function chkdis7(){
	var chf=document.getElementById('chf');
	var tchf=document.getElementById('tchf').value;
	if(chf.checked){
		//alert(3);
		$('#tchf').val(3);
		var tchf=3;
		}else{$('#tchf').val(0);
			var tchf=0;}
		dis_s();
	}
	
function chkdis8(){
	var copd=document.getElementById('copd');
	var tcopd=document.getElementById('tcopd').value;
	if(copd.checked){
		//alert(3);
		$('#tcopd').val(3);
		var tcopd=3;
		}else{$('#tcopd').val(0);
			var tcopd=0;}
		dis_s();
	}
	
function chkdis9(){
	var sepsis=document.getElementById('sepsis');
	var tsepsis=document.getElementById('tsepsis').value;
	if(sepsis.checked){
		//alert(3);
		$('#tsepsis').val(3);
		var tsepsis=3;
		}else{$('#tsepsis').val(0);
			var tsepsis=0;}
		dis_s();
	}
	
function chkdis10(){
	var hemato=document.getElementById('hemato');
	var themato=document.getElementById('themato').value;
	if(hemato.checked){
		//alert(6);
		$('#themato').val(6);
		var themato=6;
		}else{$('#themato').val(0);
			var themato=0;}
		dis_s();
	}
	
//แถวที่ 3
function chkdis11(){
	var liver=document.getElementById('liver');
	var tliver=document.getElementById('tliver').value;
	if(liver.checked){
		//alert(3);
		$('#tliver').val(3);
		var tliver=3;
		}else{$('#tliver').val(0);
			var tliver=0;}
		dis_s();
}
	
function chkdis12(){
	var hi=document.getElementById('hi');
	var thi=document.getElementById('thi').value;
	if(hi.checked){
		//alert(3);
		$('#thi').val(3);
		var thi=3;
		}else{$('#thi').val(0);
			var thi=0;}
		dis_s();
}	
function chkdis13(){
	var burn=document.getElementById('burn');
	var tburn=document.getElementById('tburn').value;
	if(burn.checked){
		//alert(3);
		$('#tburn').val(3);
		var tburn=3;
		}else{$('#tburn').val(0);
			var tburn=0;}
		dis_s();
}
function chkdis14(){
	var pneumo=document.getElementById('pneumo');
	var tpneumo=document.getElementById('tpneumo').value;
	if(pneumo.checked){
		//alert(6);
		$('#tpneumo').val(6);
		var tpneumo=6;
		}else{$('#tpneumo').val(0);
			var tpneumo=0;}
		dis_s();
}

function chkdis15(){
	var critical=document.getElementById('critical');
	var tcritical=document.getElementById('tcritical').value;
	if(critical.checked){
		//alert(6);
		$('#tcritical').val(6);
		var tcritical=6;
		}else{$('#tcritical').val(0);
			var tcritical=0;}
		dis_s();
	}

function dis_s(){
	var dis_s=$('#dis_s').val();
//row1
	var tdm=$('#tdm').val();
		if($('#tdm').val()==""||$('#tdm').val()==0){tdm=0; }else{tdm=$('#tdm').val();}
	var tca=$('#tca').val();
		if($('#tca').val()==""){tca=0;}else{tca=$('#tca').val();}
	var thip=$('#thip').val();
		if($('#thip').val()==""){thip=0; }else{thip=$('#thip').val();}
	var tcva=$('#tcv').val();
		if($('#tcva').val()==""){tcva=0; }else{tcva=$('#tcva').val();}	
	var tmulfx=$('#tmulfx').val();
		if($('#tmulfx').val()==""){tmulfx=0; }else{tmulfx=$('#tmulfx').val();}
//row2
	var tckd=$('#tckd').val();
		if($('#tckd').val()==""||$('#tckd').val()==0){tckd=0; }else{tckd=$('#tckd').val();}
	var tchf=$('#tchf').val();
		if($('#tchf').val()==""||$('#tchf').val()==0){tchf=0; }else{tchf=$('#tchf').val();}
	var tcopd=$('#tcopd').val();
		if($('#tcopd').val()==""||$('#tcopd').val()==0){tcopd=0; }else{tcopd=$('#tcopd').val();}
	var tsepsis=$('#tsepsis').val();
		if($('#tsepsis').val()==""||$('#tsepsis').val()==0){tsepsis=0; }else{tsepsis=$('#tsepsis').val();}
	var themato=$('#themato').val();
		if($('#themato').val()==""||$('#themato').val()==0){themato=0; }else{themato=$('#themato').val();}		
//row3
	var tliver=$('#tliver').val();
		if($('#tliver').val()==""||$('#tliver').val()==0){tliver=0; }else{tliver=$('#tliver').val();}
	var thi=$('#thi').val();
		if($('#thi').val()==""||$('#thi').val()==0){thi=0; }else{thi=$('#thi').val();}
	var tburn=$('#tburn').val();
		if($('#tburn').val()==""||$('#tburn').val()==0){tburn=0; }else{tburn=$('#tburn').val();}
	var tpneumo=$('#tpneumo').val();
		if($('#tpneumo').val()==""||$('#tpneumo').val()==0){tpneumo=0; }else{tpneumo=$('#tpneumo').val();}
	var tcritical=$('#tcritical').val();
		if($('#tcritical').val()==""||$('#tcritical').val()==0){tcritical=0; }else{tcritical=$('#tcritical').val();}

	dis_s=parseInt(tdm)+parseInt(tca)+parseInt(thip)+parseInt(tcva)+parseInt(tmulfx)+parseInt(tckd)+parseInt(tchf)+parseInt(tcopd)+parseInt(tsepsis)+parseInt(themato)+parseInt(tliver)+parseInt(thi)+parseInt(tburn)+parseInt(tpneumo)+parseInt(tcritical);
	
	$('#dis_s').val(dis_s);	
	
	//alert("คะแนนความเจ็บป่วย="+dis_s);
	
	score();
	}
$(document).ready(function () {
  $('#alb').change(function alb_s(){
	var alb=$('#alb').val();
	var alb_s=$('#alb_s').val();
		$('#TLC').val(0);
		$('#bw_s').val(0);
	if(alb<=2.5){
		$('#alb_s').val(3);
		}else if(alb>2.5&&alb<3.0){
			$('#alb_s').val(2);
			}else if(alb>=3.0&&alb<=3.5){
			$('#alb_s').val(1);
			}else if(alb>3.5){
			$('#alb_s').val(0);
			}
	$('#wbc_s').val(0);
	var alb_s=$('#alb_s').val();
	//alert("Albumin score="+alb_s);
	$('#bmi_s').val(alb_s);
	//alert(alb_s);
	score();
	});
$('#wbc,#lymp').change(function wbc_s(){
	var wbc=$('#wbc').val();
	var lymp=$('#lymp').val();
	var TLC=parseInt(wbc)*parseInt(lymp)/100;
		
		$('#alb_s').val(0);
		$('#bw_s').val(0);
	if(TLC<1000&&TLC>0){
			$('#wbc_s').val(3);
		}if(TLC>1000&&TLC<=1200){
			$('#wbc_s').val(2);
		}if(TLC>1200&&TLC<=1500){
			$('#wbc_s').val(1);
		}if(TLC>1500){
			$('#wbc_s').val(0);
		}  var wbc_s=$('#wbc_s').val();
			$('#TLC').val(TLC);
			$('#alb_s').val(0);
			$('#bw_s').val(0);
			$('#wbc_s').val(wbc_s);
		//alert("WBC score="+TLC);
			$('#bmi_s').val(wbc_s);
		score();
	});
	
	
$('#ht_tell').change(function ht2(){
   
		//var ht_tell=document.getElementById('ht_tell').value;
		//var ht=document.getElementById('ht').value;
		//alert(ht_tell);
		//document.getElementById('ht').value=ht_tell;
                
                
	var bw=parseFloat($('#bw').val());
	var ht=parseFloat($('#ht_tell').val());
	var sex=$('#sex').val().toLowerCase();
	var bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);
	$('#bmi').val(bmi);
	if(sex=="male"){
		var ibw=parseFloat(50+(0.91*(ht-152.4)));
		//alert("sex is MALE and IBW ="+ibw);
		$('#IBW').val(parseFloat(ibw).toFixed(2));
		}else if(sex=="female"){
		var ibw=parseFloat(45.5+(0.91*(ht-152.4)));
		//alert("sex is FEMALE and IBW ="+ibw);
		$('#IBW').val(parseFloat(ibw).toFixed(2));
		}else{alert("โปรดระบุเพศให้ถูกต้อง (male หรือ female เท่านั้น)");$('#sex').val("");$('#sex').focus();}
	if((bw-ibw)/ibw>=0.2){
		//var bw=parseFloat(ibw);
		alert(" actual BW สูงกว่า ideal BW เกิน 20% : ดังนั้นจะใช้ IBW เพื่อคำนวนค่าต่างๆ");
		//var bmi=parseFloat(10000*ibw/(ht*ht)).toFixed(2);
			
		}
	//alert(bw);		
	//var bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);
	//$('#bmi').val(bmi);	
	//req();
		
	
	});
	
$('#shape').change(function shape(){
    
		var shape=$('#shape').val();
		var shape_s=$('#shape_s').val();
                
		if(shape==3){
			$('#shape_s').val(2);
			shape_s=2;
			}else if(shape==2||shape==1){
				$('#shape_s').val(1);
					shape_s=1;
			}else{$('#shape_s').val(0);
					shape_s=0;
			 }
			//alert(shape_s);
		score();
		});

$('#wt_change').change(function wt_s(){
		var wt_change=$('#wt_change').val();
		var wt_s=$('#wt_s').val();
		if(wt_change==3){
			$('#wt_s').val(2);
			wt_s=2;
			}  else if(wt_change==2){
			$('#wt_s').val(1);
			wt_s=1;
			} else if(wt_change==1||wt_change==0){
			$('#wt_s').val(0);
			wt_s=0;
			} 
			 
		//alert(wt_s);
		score();
		});

$('#status').change(function(){
	var status=$('#status').val();
	var status_s=$('#status_s').val();
	if(status==3){
		$('#status_s').val(2);
		status_s=2;
		}else if(status==2){
		$('#status_s').val(1);
		status_s=1;
		}else if(status==0||status==1){
		$('#status_s').val(0);
		status_s=0;
		}
	//alert(status_s);
	score();
	});
$('#diet_type,#diet_qnt').change(function(){
	var diet_type=$('#diet_type').val();
	var tdiet_type=$('#tdiet_type').val();
	var diet_qnt=$('#diet_qnt').val();
	var tdiet_qnt=$('#tdiet_qnt').val();
	var diet_s=$('#diet_s').val();
	if(diet_type==3||diet_type==2){
		$('#tdiet_type').val(2);
		tdiet_type=2;
		}else if(diet_type==1){
		$('#tdiet_type').val(1);
		tdiet_type=1;
		}else if(diet_type==0){
		$('#tdiet_type').val(0);
		tdiet_type=0;
		}else{tdiet_type=0;}
	//alert(tdiet_type);
	if(diet_qnt==3){
		$('#tdiet_qnt').val(2);
		tdiet_qnt=2;
		}else if(diet_qnt==2){
		$('#tdiet_qnt').val(1);
		tdiet_qnt=1;
		}else if(diet_qnt==1||diet_qnt==0){
		$('#tdiet_qnt').val(0);
		tdiet_qnt=0;
		}else{tdiet_qnt=0;}
	//alert(tdiet_qnt);
	diet_s=parseInt(tdiet_type)+parseInt(tdiet_qnt);
	$('#diet_s').val(diet_s);
	//alert(diet_s);
	score();
	});
    $('#bw,#ht,#sex').change(function(){
   
	//M: IBW(kg) =50 +(0.91x(ht.incm.-152.4)
	//F: IBW(kg) =45.5+(0.91x(ht.incm.-152.4) (from : ARDS Network. NEJM. May 2000, 342 (18) : 1301- 08)
	var bw=parseFloat($('#bw').val());
	var ht=parseFloat($('#ht').val());
	var sex=$('#sex').val().toLowerCase();
	var bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);
	
	if(sex=="male"){
		var ibw=parseFloat(50+(0.91*(ht-152.4)));
		//alert("sex is MALE and IBW ="+ibw);
		$('#IBW').val(parseFloat(ibw).toFixed(2));
		}else if(sex=="female"){
		var ibw=parseFloat(45.5+(0.91*(ht-152.4)));
		//alert("sex is FEMALE and IBW ="+ibw);
		$('#IBW').val(parseFloat(ibw).toFixed(2));
		}else{alert("โปรดระบุเพศให้ถูกต้อง (male หรือ female เท่านั้น)");$('#sex').val("");$('#sex').focus();}
	if((bw-ibw)/ibw>=0.2){
		//var bw=parseFloat(ibw);
		alert(" actual BW สูงกว่า ideal BW เกิน 20% : ดังนั้นจะใช้ IBW เพื่อคำนวนค่าต่างๆ");
		//var bmi=parseFloat(10000*ibw/(ht*ht)).toFixed(2);
			
		}
	//alert(bw);		
	//var bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);
	//$('#bmi').val(bmi);	
	//req();
	
	
	});

    start();

       
    $("form").submit(function (event) {
    event.preventDefault();

var sel_sw = "";
var sel_gi = "";
var sel_vom = "";

var arr_sw = [];
var arr_gi = [];
var arr_vom = [];

 if($('#sw1').is(':checked')) { 
         arr_sw.push( $('#sw1').val());
 }

 if($('#sw2').is(':checked')) {     
     
         arr_sw.push( $('#sw2').val());
 }

 if($('#sw3').is(':checked')) {          arr_sw.push( $('#sw3').val());
 }

sel_sw = arr_sw.join("_");

 if($('#GI1').is(':checked')) {    arr_gi.push( $('#GI1').val()); }

 if($('#GI2').is(':checked')) {     arr_gi.push( $('#GI2').val()); }

 if($('#GI3').is(':checked')) {    arr_gi.push( $('#GI3').val()); }
sel_gi = arr_gi.join("_");

 if($('#vom1').is(':checked')) {  arr_vom.push( $('#vom1').val()); }

 if($('#vom2').is(':checked')) {  arr_vom.push( $('#vom2').val());}

 if($('#vom3').is(':checked')) {  arr_vom.push( $('#vom3').val());}

sel_vom = arr_vom.join("_");

         var screendate = $('#screenDate').val();
        var ward = $('#ward').val();
        var screenNo = $('#screenNo').val();
        var hosp = $('#hosp2').val();
        var HN = $('#HN').val();
        var AN = $('#AN').val();
        var Fname = $('#fname').val();
        var Lname = $('#lname').val();
        var age = $('#age').val();
        var sex = $('#sex').val();
        var bw = $('#bw').val();
        var ht = $('#ht').val();
        var ht_tell = $('#ht_tell').val();
        var length = $('#length').val();
        var arm = $('#arm').val();
        var IBW = $('#IBW').val();
        var bmi1 = $('#bmi_s').val();
       var diag = $('#diag').val();
        var ecog = $('#ecog').val();
       var alb = $('#alb').val();
       var TLC = $('#TLC').val();
        var shape = $('#shape').val();
        var wt_change = $('#wt_change').val();
        var diet_type = $('#diet_type').val();
        var diet_qnt = $('#diet_qnt').val();
        var swallow = $('#sw_s').val();
        var GI = $('#tgi_s').val();
        var vomit = $('#tvom_s').val();
        var status = $('#status').val();
        
        var dm = $("#dm").prop("checked")?$('#dm').val():"";
        var cancer = $("#ca").prop("checked")?$('#ca').val():"";
        var hip = $("#hip").prop("checked")?$('#hip').val():"";
        var cva = $("#cva").prop("checked")?$('#cva').val():"";
        var mulfx = $("#mulfx").prop("checked")?$('#mulfx').val():"";
        var ckd = $("#ckd").prop("checked")?$('#ckd').val():"";
        var chf = $("#chf").prop("checked")?$('#chf').val():"";
        var sepsis = $("#sepsis").prop("checked")?$('#sepsis').val():"";
        var copd = $("#copd").prop("checked")?$('#copd').val():"";
        var hemato = $("#hemato").prop("checked")?$('#hemato').val():"";
        var liver = $("#liver").prop("checked")?$('#liver').val():"";
        var hi = $("#hi").prop("checked")?$('#hi').val():"";
        var burn = $("#burn").prop("checked")?$('#burn').val():"";
        var pneumo = $("#pneumo").prop("checked")?$('#pneumo').val():"";
        var critical = $("#critical").prop("checked")?$('#critical').val():"";
        var bw_s = $('#bw_s').val();
        var lab_s = $('#alb_s').val();
        var shape_s = $('#shape_s').val();
        var wt_s = $('#wt_s').val();
        var diet_s = $('#diet_s').val();
        var gi_s = $('#gi_s').val();
        var status_s = $('#status_s').val();
        var dis_s = $('#dis_s').val();
        var score_ = $('#score').val();
        var level = $('#level').val();
        var cal_req = $('#cal_req').val();
        var fat_req = $('#fat_req').val();
        var prot_req = $('#prot_req').val();
        var vol_req = $('#vol_req').val();
        var npc = $('#npc').val();
        var doctor = $('#doctor').val();
        var reporter = $('#reporter').val();
     if(alb == "")
     alb = "NULL";
    var data = {  
       sel_sw:sel_sw,
       sel_gi:sel_gi,
       sel_vom:sel_vom,
        screenDate:screendate,
        ward:ward,
        screenNo:screenNo,
        hosp:hosp,
        HN:HN,
        AN:AN,
        fname:Fname,
        lname:Lname,
        age:age,
        sex:sex,
        bw:bw,
        ht:ht,
        ht_tell:ht_tell,
        length:length,
        arm:arm,
        IBW:IBW,
        bmi:bmi1,
        diag:diag,
        ecog:ecog,
         alb:alb,
        TLC:TLC,
        shape:shape,
        wt_change:wt_change,
        diet_type:diet_type,
        diet_qnt:diet_qnt,
        sw_s:swallow,
        tgi_s:GI,
        tvom_s:vomit,
        status:status,
        dm:dm,
        cancer:cancer,
        hip:hip,
        cva:cva,
        mulfx:mulfx,
        ckd:ckd,
        chf:chf,
        sepsis:sepsis,
        copd:copd,
        hemato:hemato,
        liver:liver,
        hi:hi,
        burn:burn,
        pneumo:pneumo,
        critical:critical,
        bw_s:bw_s,
        lab_s:lab_s,
        shape_s:shape_s,
        wt_s:wt_s,
        diet_s:diet_s,
        gi_s:gi_s,
        status_s:status_s,
        dis_s:dis_s,
        score:score_,
        level:level,  
        cal_req:cal_req, 
        fat_req:fat_req,
        prot_req:prot_req, 
        vol_req:vol_req,
        npc:npc,
        doctor:doctor,
        reporter:reporter,
               
  };
  $.post("service/NAF.php",data, function (result) {
     console.log(result);
      if(result == 1)
        {
                if(confirm('บันทึกข้อมูลเรียบร้อยแล้ว ต้องการพิมพ์การคัดกรองนี้หรือไม่ ?')==true)
                {	//alert('yes');
                            alert('success and ID='+HN);								
                            window.location='/hospital/reportNAF.php?id='+HN;

                            //window.location.href='ask.php';
                }
                else
                { //alert('No');
                            window.location='screening.php';
                }
            
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