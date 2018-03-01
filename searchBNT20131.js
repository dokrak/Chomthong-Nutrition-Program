// JavaScript Document<script>

function BntSearch(hosp1,Sdate,Edate){
	//alert(hosp1+"-"+Sdate+"-"+Edate);
	$.get("BNT2013_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		$('#showBnt').show();
		$('#showBnt').html(data);

		});
	}

function ShowGraph(hosp1,Sdate,Edate){
	
	$.get("BNT_graph.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		var nt=data.split("#");
		var nt1=nt[0];
		var nt2=nt[1];
		var nt3=nt[2];
		var nt4=nt[3];
		alert(nt[0]+nt[1]+nt[2]+nt[3]);
		

		
		//$('#ShowGraph').show();
		//$('#ShowGraph').html(data);
	ShowGraph1(hosp1,Sdate,Edate,nt1,nt2,nt3,nt4);
		});
	
		
	}

function ShowGraph1(hosp,Sdate,Edate,nt1,nt2,nt3,nt4){
	var nt1=parseInt(nt1);
	var nt2=parseInt(nt2);
	var nt3=parseInt(nt3);
	var nt4=parseInt(nt4);
	alert("Hosp="+hosp+",Sdate="+Sdate+",Edate="+Edate);
	alert("nt1="+nt1+"nt2="+nt2+"nt3="+nt3+"nt4="+nt4);
		$("#ShowGraph").highcharts({
		 chart: {
        plotBackgroundColor: '#D8E5FC',
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'ภาวะทุพโภชนาการจากการประเมินด้วย BNT-2013<br>โรงพยาบาล '+hosp+'<br>ตั้งแต่ '+Sdate+' ถึง '+Edate
		
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        
		data: [{
            name: 'Normal nutrition',
            y:parseInt(nt1),
			color:'GREEN'
        }, {
            name: 'Mild malnutrition',
            y: nt2,
			color:'#A9FCA9'

        },{
            name: 'Moderate malnutrition',
            y: nt3,
			color:'#FFFF99'

        }, {
            name: 'Severe malnutrition',
            y:nt4,
			 sliced: true,
            selected: true,
			color:'#FC7873'
        }]
    }]
		
		});	
	}

	

	
function TriageSearch(hosp1,Sdate,Edate){
	//alert(hosp1+"-"+Sdate+"-"+Edate);
	$.get("Triage_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		$('#showBnt').show();
		$('#showBnt').html(data);
		
		});
	}
function NafSearch(hosp1,Sdate,Edate){
	//alert(hosp1+"-"+Sdate+"-"+Edate);
	$.get("Naf_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		$('#showBnt').show();
		$('#showBnt').html(data);
		
		});
	}
	
