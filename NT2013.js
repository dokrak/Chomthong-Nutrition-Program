/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
    function score(){
         	var bw=parseFloat($('#bw').val());
	var  diet=parseFloat($('#diet_s').val());
	var  wt=parseFloat($('#wtloss_s').val());
	var  edema=parseFloat($('#edema').val());
	var  fat=parseFloat($('#fatloss1').val());
	var  mloss=parseFloat($('#mloss2').val());
	var  mpower=parseFloat($('#mpower2').val());
	var  chronic=parseFloat($('#chronic').val());
	var  acute=parseFloat($('#acute').val());
	
	var score=parseInt(diet+wt+edema+fat+mloss+mpower+chronic+acute);
	//alert("TN-2013 score = "+score);
	$('#score').val(score);
	
	if(score>=0&&score<=4){
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
		//alert("score:NT-1");
		//alert("score"+cal);alert("score"+prot);alert("score"+vol);
		$('#cal_req').val(cal);$('#cal_req2').val(cal2);
		$('#prot_req').val(prot);$('#prot_req2').val(prot2);
		$('#fat_req').val(fat1);$('#fat_req2').val(fat2);
		$('#vol_req').val(vol);$('#vol_req2').val(vol2);
		$('#npc').val(npcn+":"+1);$('#npc2').val("ได้โปรตีน="+parseInt(400*prot/cal)+"% ของ cal");
		$('#level').val("NT-1 :ไม่มีภาวะทุพโภชนาการ");
		$('#result1').val("ติดตามประเมินทุก 6-8 wk");
		$('#icd').val("-");
		
		}else if(score>=5&&score<=7){
		//alert("NT-2");//alert("score"+cal);alert("score"+prot);alert("score"+vol);
		var score=$('#score').val();
		var bw=$('#bw').val();
		var cal=25*bw;
		var cal2="("+22.5*bw+"-"+27.5*bw+") Kcal/d";  //22.5-27.5kcal/kg/d
		var prot=1.2*bw;
		var prot2="("+parseInt(1*bw)+"-"+parseInt(1.5*bw)+") gm/d"; //1-1.5 gm/kg/d
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
		$('#level').val("NT-2 :ทุพโภชนาการเล็กน้อย");
		$('#result1').val("ติดตามประเมินทุก 4-6 wk");
		$('#icd10').val("E44.1");
		}else if(score>=8&&score<=10){
		//alert("NT-3");// alert("score"+cal);alert("score"+prot);alert("score"+vol);
		var score=$('#score').val();
		var bw=$('#bw').val();
		var cal=27.5*bw;
		var cal2="("+25*bw+"-"+30*bw+") Kcal/d";  //25-30kcal/kg/d
		var prot=1.5*bw;
		var prot2="("+parseInt(1.2*bw)+"-"+parseInt(1.8*bw)+") gm/d"; //1.2-1.8 gm/kg/d
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
		$('#level').val("NT-3 :ทุพโภชนาการปานกลาง");
		$('#result1').val("ควรเริ่มให้โภชนบำบัด ประเมินทุก 3-7 วัน");
		$('#icd10').val("E44.0");
		}else if(score>10){
		//alert("NT-4");//alert("score"+cal);alert("score"+prot);alert("score"+vol);
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
		$('#level').val("NT-4 :ทุพโภชนาการรุนแรง");
		$('#result1').val("ควรปรึกษาทีมโภชนบำบัด");
		$('#icd10').val("E43");
		}
    }

    function next1(){
            $('#ward2').focus();
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

  
$(document).ready(function () {
    
    $('#diet_type,#diet_period,#intake').change(function diet(){
            //alert("diet");
            var dtype=$('#diet_type').val();
            var dperiod=$('#diet_period').val();
            var dintake=$('#intake').val();
            
            if( (dperiod==1&&dintake!=4)||(dperiod==2&&dintake<=2)||(dperiod==3&&dintake<=2)||(dperiod==4&&dintake<=1) ||(dperiod>=5&&dintake==0) ){
        //    alert("คะแนน = 0");
            $('#diet_s').val(0);
            }else if( (dperiod==1&&dintake==4)||(dperiod==2&&dintake==3)||(dperiod==3&&dintake==3)||(dperiod==4&&dintake==2) ||(dperiod>=5&&dintake==1)||(dperiod>=5&&dintake==2)||(dperiod>=6&&dintake==1)   ){
         //   alert("คะแนน = 1");
            $('#diet_s').val(1);
            }else if( (dperiod==2&&dintake==4)||(dperiod==3&&dintake==4)||(dperiod==4&&dintake==3)||(dperiod==5&&dintake==3) ||(dperiod>=6&&dintake==2)  ){
         //   alert("คะแนน = 2");
            $('#diet_s').val(2);
            }else if( (dperiod==4&&dintake==4)||(dperiod==5&&dintake==4)||(dperiod==6&&dintake==3) ){
          //  alert("คะแนน = 3");
            $('#diet_s').val(3);
            }else if( (dperiod==6&&dintake==4) ){
          //  alert("คะแนน = 4");
            $('#diet_s').val(4);
            }
            score();	
    });

    $('#bw,#wt_change,#wt_period,#wt_type').change(function wtloss(){
            var bw=parseFloat($('#bw').val()).toFixed(2);
            var type=$('#wt_type').val();
            var period=$('#wt_period').val();
            var change=parseFloat($('#wt_change').val()).toFixed(2);
            var percent=$('#wt_percent').val();

            if(type=="same")
            {
                $('#wt_change').val(0);
                $('#wt_percent').val(0);
                //alert("Wt loss score= 0");
                $('#wtloss_s').val(0);
            }
            else if(type=="gain"&&change!=0)
            {
                var Gpercent=parseFloat(100*change/(parseFloat(bw)-parseFloat(change))).toFixed(2);
                $('#wt_percent').val(Gpercent);
                //alert("Wt loss score = 0 ");
                $('#wtloss_s').val(0);
            }
            else if(type=="loss")
            {
                var Lpercent=parseFloat(100*change/(parseFloat(bw)+parseFloat(change))).toFixed(2);
                
                $('#wt_percent').val(Lpercent);

                if( ((period==1)&&(percent<1))||((period==2)&&(percent<2))||((period==3)&&(percent<4))||((period==4)&&(percent<7))||((period==5)&&(percent<10)))
                {					    //alert("Wt loss score= 1");	 
                            $('#wtloss_s').val(1);
                } 
                else if( ( (period==1)&&(1<=percent)&&(percent<=2) )||((period==2)&&(2<=percent)&&(percent<=3))||((period==3)&&(4<=percent)&&(percent<=5))||((period==4)&&(7<=percent)&&(percent<=8))||((period==5)&&(percent==10)) )
                {
                                                //alert("Wt loss score= 2");
                    $('#wtloss_s').val(2);

                } 
                else if( ((period==1)&&(percent>2))||((period==2)&&(percent>3))||((period==3)&&(percent>5))||((period==4)&&(percent>8))||((period==5)&&(percent>10)) )
                {
                                                                //alert("Wt loss score= 3");
                    $('#wtloss_s').val(3);
                }

            }
            score();
            });

    $('#edema2').change(function edema(){
            var edema_s=$('#edema2').val();
            //alert("edema score="+edema_s);
            $('#edema').val(edema_s);
            score();

            });

    $('#fatloss').change(function fat(){
            var fat_s=$('#fatloss').val();
            //alert("Fat loss score="+fat_s);
            $('#fatloss1').val(fat_s);
            score();
            });

    $('#mloss1').change(function mloss(){
            var mloss=$('#mloss1').val();
            //alert("Muscle loss score="+mloss);
            $('#mloss2').val(mloss);
            score();
            });

    $('#mpower1').change(function mpower(){
            var mpower=$('#mpower1').val();
            //alert("Muscle strengrh score="+mpower);
            $('#mpower2').val(mpower);
            score();
            });

    $('#cancer,#lung,#ckd,#liver,#aids,#ascites,#bedsore,#dm,#neuro,#heart,#ostomy').change(function chronic(){
            var ca=parseInt($('#cancer').val());
            var lung=parseInt($('#lung').val());
            var ckd=parseInt($('#ckd').val());
            var liver=parseInt($('#liver').val());
            var aids=parseInt($('#aids').val());
            var ascites=parseInt($('#ascites').val());
            var bedsore=parseInt($('#bedsore').val());
            var dm=parseInt($('#dm').val());
            var neuro=parseInt($('#neuro').val());
            var heart=parseInt($('#heart').val());
            var ostomy=parseInt($('#ostomy').val());
            var chronic=parseInt($('#chronic').val());
            chronic_s=ca+lung+ckd+liver+aids+ascites+bedsore+dm+neuro+heart+ostomy;
            if(chronic_s>=3){
                    alert("รวมคะแนน Chronic illness score = "+ chronic_s+"  แต่กรอกได้สูงสุด = 3 คะแนน");chronic_s=3;
                    }else{//alert("Chronic illness score="+" "+chronic_s);
            }
            $('#chronic').val(chronic_s);
            score();
            });	

    $('#injury,#HI,#spinal,#burn,#infection,#surgery,#peritonitis,#pancreas,#hepatitis,#NF,#other2').change(function acute(){
            var inj=parseInt($(' #injury').val());
            var hi=parseInt($(' #HI').val());
            var spinal=parseInt($(' #spinal').val());
            var burn=parseInt($('#burn ').val());
            var infec=parseInt($('#infection ').val());
            var surg=parseInt($(' #surgery').val());
            var perito=parseInt($(' #peritonitis').val());
            var pan=parseInt($(' #pancreas').val());
            var hep=parseInt($('#hepatitis ').val());
            var nf=parseInt($(' #NF').val());
            var other2=parseInt($(' #other2').val());
            var acute=parseInt($('acute').val());
            var acute_s=inj+hi+spinal+burn+infec+surg+perito+pan+hep+nf+other2;
            if(acute_s>=3){
                    alert("รวมคะแนน Acute illness score="+acute_s+" แต่กรอกได้สูงสุด = 3 คะแนน");
                    acute_s=3;
                    } else {
                            //alert("รวมคะแนน Acute illness score="+acute_s);
                            }
                    $('#acute').val(acute_s);
                    score();
    });	

    $('#bw,#ht').change(function ibw(){
        
            //M: IBW(kg) =50 +(0.91x(ht.incm.-152.4)
            //F: IBW(kg) =45.5+(0.91x(ht.incm.-152.4) (from : ARDS Network. NEJM. May 2000, 342 (18) : 1301- 08)
            var bw=$('#bw').val();
            
            if(bw.length > 0 && !$.isNumeric(bw))
            {
                alert("please numeric");
                
                $('#bw').val("");                
                
                return;
            }
            
            var ht=$('#ht').val();
            
            if(ht.length > 0 && !$.isNumeric(ht))
            {
                alert("please numeric");
                
                $('#ht').val("");                
                
                return;
            }
            if($.isNumeric(bw) && $.isNumeric(ht))
            {
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
                    var bw=parseFloat(ibw);
                    var bmi=parseFloat(10000*ibw/(ht*ht)).toFixed(2);
                    }else{
                    var bw=parseFloat(bw);	
                    var bmi=parseFloat(10000*bw/(ht*ht)).toFixed(2);	
                            }


                $('#bmi').val(parseFloat(bmi));	
            }
          //  req();
    });


    $('#wt_type').change(function(){
            $('wt_change').focus();
    });
    $('#AN').focus();
  
    
    
$("form").submit(function (event) {
    
    var screendate = $("[name='screenDate']").val();
    var ht =  $('#ht').val();
    var score_ =  $('#result').val();
    var HN = $('[name="HN"]').val();
    var reporter = $('#reporter').val();
    var ward =   $('#ward2').val();
     var screenNo = $('#screenNo').val();
    var  hosp = $('#hosp').val();
	var  hid = $("[name='hid']").val();
     var AN = $('#AN').val();
     var fname = $('#fname').val();
     var lname = $('#lname').val();
     var age = $('#age').val();
     var sex = $('#sex').val();
     var bw = $('#bw').val();
     var ht = $('#ht').val();
     var UBW = $('#UBW').val();
     var IBW = $('#IBW').val();
     var bmi = $('#bmi').val();
     var diag = $('#diag').val();
     var ecog = $('#ecog').val();
     var diet_type = $('#diet_type').val();
     var diet_period = $('#diet_period').val();
     var intake = $('#intake').val();
     var diet_s = $('#diet_s').val();
     var wt_type = $('#wt_type').val();
     var wt_change = $('#wt_change').val();
     var wt_percent = $('#wt_percent').val(); 
     var wt_period = $('#wt_period').val(); 
     var wtloss_s = $('#wtloss_s').val(); 
     var edema2 = $('#edema2').val(); 
    var edema = $('#edema').val(); 
    var fatloss = $('#fatloss').val(); 
    var fatloss2=$('#fatloss1').val();
    var mloss1=$('#mloss1').val();
    var mloss2=$('#mloss2').val();
    var mpower1=$('#mpower1').val();
    var mpower2=$('#mpower2').val(); 
    var cancer=$('#cancer').val();
    var lung=$('#lung').val();
    var ckd=$('#ckd').val();
    var liver=$('#liver').val();
    var aids=$('#aids').val(); 
    var ascites=$('#ascites').val();
    var bedsore=$('#bedsore').val();
    var dm=$('#dm').val(); 
    var neuro=$('#neuro').val();
    var chronic=$('#chronic').val();
    var heart=$('#heart').val();
    var ostomy=$('#ostomy').val();
    var injury=$('#injury').val(); 
    var HI=$('#HI').val();
    var spinal=$('#spinal').val();
    var burn=$('#burn').val();
    var infection=$('#infection').val();
    var surgery=$('#surgery').val();
    var pancreas=$('#pancreas').val();
    var peritonitis=$('#peritonitis').val();
    var hepatitis=$('#hepatitis').val();
    var NF=$('#NF').val();
    var acute = $('#acute').val(); 
    var score_ = $('#score').val(); 
    var level= $('#level').val(); 
    var other1=$('#other1').val();
    var other2= $('#other2').val(); 
    var result1 = $('#result1').val(); 
    var cal_req = $('#cal_req').val(); 
    var fat_req = $('#fat_req').val(); 
    var prot_req = $('#prot_req').val(); 
     var vol_req = $('#vol_req').val(); 
     var npc = $('#npc').val(); 
     var doctor = $('#doctor').val();
   
    event.preventDefault();
    
    var data = {
                screenDate:screendate,
                ward:ward,
                screenNo:screenNo, 
                hosp:hosp,
				hid:hid,
                HN:HN,
                AN:AN,
                fname:fname,
                lname:lname,
                age:age,
                sex:sex,
                bw:bw,
                ht:ht,
                UBW:UBW,
                IBW:IBW,
                bmi:bmi,
                diag:diag,
                ecog:ecog,
                diet_type:diet_type,
                diet_period:diet_period,
                intake:intake,
                diet_s:diet_s,
                wt_type:wt_type,
                wt_change:wt_change, 
                wt_percent:wt_percent,
                wt_period:wt_period,
                wtloss_s:wtloss_s,
                edema2:edema2,
                edema:edema, 
                fatloss:fatloss, 
                fatloss2:fatloss2,
                mloss1:mloss1,
                mloss2:mloss2,
                mpower1:mpower1,
                mpower2:mpower2, 
                cancer:cancer,
                lung:lung,
                ckd:ckd,
                liver:liver,
                aids:aids, 
                ascites:ascites,
                bedsore:bedsore,
                dm:dm, 
                neuro:neuro,
                chronic:chronic,
                heart:heart,
                ostomy:ostomy,
                injury:injury, 
                HI:HI,
                spinal:spinal,
                burn:burn,
                infection:infection,
                surgery:surgery,
                pancreas:pancreas,
                peritonitis:peritonitis,
                hepatitis:hepatitis,
                NF:NF,
                acute:acute, 
                score:score_,
                level:level,
                other1:other1,
                other2:other2,
                result1:result1,
                cal_req:cal_req,
                fat_req:fat_req,
                prot_req:prot_req,
                vol_req:vol_req,
                npc:npc,
                doctor:doctor,
                reporter:reporter
  };
  $.post("service/NT2013.php",data, function (result) {
    //  console.log(result);
          if(result == 1)
        {
                if(confirm('บันทึกข้อมูลเรียบร้อยแล้ว ต้องการพิมพ์การคัดกรองนี้หรือไม่ ?')==true)
                {	//alert('yes');
                            alert('success and ID='+HN);								
                            window.location='/hospital/reportNT2013.php?id='+HN;

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