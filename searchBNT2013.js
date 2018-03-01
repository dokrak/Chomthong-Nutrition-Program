// JavaScript Document<script>

function BntSearch(hosp1,Sdate,Edate){
	//alert(hosp1+"-"+Sdate+"-"+Edate);
	$.get("BNT2013_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		$('#showBnt').show(1000);
		$('#showBnt').html(data);

		});
	BNTGraph(hosp1,Sdate,Edate);
	}

function BNTGraph(hosp1,Sdate,Edate){
	var hosp1=hosp1;
	$.get("BNT_graph.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		var nt=data.split("#");
		var nt1=parseInt(nt[0]);
		var nt2=parseInt(nt[1]);
		var nt3=parseInt(nt[2]);
		var nt4=parseInt(nt[3]);
		var hosp1=hosp1;
		$("#ShowGraph").highcharts({
		 chart: {
        plotBackgroundColor: '#D8E5FC',
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'ภาวะทุพโภชนาการจากการประเมินด้วย BNT-2013<br>ตั้งแต่ '+Sdate+' ถึง '+Edate
		
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
		
	//BNTGraph1(hosp1,Sdate,Edate,nt1,nt2,nt3,nt4);
		});
	
		
	}
/*
function BNTGraph1(hosp,Sdate,Edate,nt1,nt2,nt3,nt4){
	var nt1=parseInt(nt1);
	var nt2=parseInt(nt2);
	var nt3=parseInt(nt3);
	var nt4=parseInt(nt4);
	//alert("Hosp="+hosp+",Sdate="+Sdate+",Edate="+Edate);
	//alert("nt1="+nt1+"nt2="+nt2+"nt3="+nt3+"nt4="+nt4);
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

*/	

	


function TriageSearch(hosp1,Sdate,Edate){
	//alert("1.)function TriageSearch");
	$.get("Triage_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		$('#showBnt').show(10000);
		$('#showBnt').html(data);

		});
	TriageGraph(hosp1,Sdate,Edate);
	}

function TriageGraph(hosp1,Sdate,Edate){
	//alert ("2.)function TriageGraph(hosp1,Sdate,Edate)");
	$.get("Triage_graph.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert("2.)function $GET");
		var risk=data.split("#");
		var HR=parseInt(risk[0]);
		var LR=parseInt(risk[1]);
		var hosp1=hosp1;
		
		$("#ShowGraph").highcharts({
		 chart: {
        plotBackgroundColor: '#D8E5FC',
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'ภาวะความเสี่ยงต่อภาวะทุพโภชนาการจากการคัดกรองเบื้องต้น<br>ตั้งแต่ '+Sdate+' ถึง '+Edate
		
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
            name: 'Low Risk',
            y:parseInt(LR),
			color:'GREEN'
        }, {
            name: 'High Risk',
            y:parseInt(HR),
			 sliced: true,
            selected: true,
			color:'#FC7873'
        }]
    }]
		
		});	
		
	//BNTGraph1(hosp1,Sdate,Edate,nt1,nt2,nt3,nt4);
		});
	
		
	}
	
function NafSearch(hosp1,Sdate,Edate){
	//alert("1.)NafSearch ");
	$.get("Naf_view.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
			//alert(data);
		$('#showBnt').show(1000);
		$('#showBnt').html(data);
		
		});
	NafGraph(hosp1,Sdate,Edate);
	}
	
 


function NafGraph(hosp1,Sdate,Edate){
	var hosp1=hosp1;
	//alert("2.)NafGraph ");
	$.get("NAF_graph.php",{hosp1:hosp1, Sdate:Sdate, Edate:Edate},function(data){
		//alert(data);
		var naf=data.split("#");
		var nafA=parseInt(naf[0]);
		var nafB=parseInt(naf[1]);
		var nafC=parseInt(naf[2]);
	
		$("#ShowGraph").highcharts({
		 chart: {
        plotBackgroundColor: '#D8E5FC',
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'ภาวะทุพโภชนาการจากการประเมินด้วย NAF <br>ตั้งแต่ '+Sdate+' ถึง '+Edate
		
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
            y:nafA,
			color:'GREEN'
        }, {
            name: 'Moderate malnutrition',
            y: nafB,
			color:'#FFFF99'

        }, {
            name: 'Severe malnutrition',
            y:nafC,
			 sliced: true,
            selected: true,
			color:'#FC7873'
        }]
    }]
		
		});	
		
	//BNTGraph1(hosp1,Sdate,Edate,nt1,nt2,nt3,nt4);
		});
	
		
	}

function Tward(hosp1,Sdate,Edate){
	$.POST("searchWard.php",{hosp1:hosp1,Sdate:Sdate,Edate:Edate});
	} 