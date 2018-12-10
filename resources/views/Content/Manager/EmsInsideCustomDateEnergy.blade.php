<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<style>
#container
{
	width: 98%;
	height: 100%;
	margin: 0 auto;
}
.Content
{
    padding:5% 5% 5% 5% ;
}
</style>
<body>
<div class="Content">
<h1 style="text-align:center;margin-bottom:4%;">{{$Dept_Name}} ENERGY DETAIL FROM {{$Startdate}} TO {{$Stopdate}}</h1>
<input id="hiddenstartdate" type="hidden" value="{{$Startdate}}">
<input id="hiddenstopdate" type="hidden" value="{{$Stopdate}}">
<div id="container"></div>
<button type="button" id="gotohome" class="btn btn-danger" style="width:170px;margin-top:4%;" ><i class="far fa-arrow-alt-circle-left"></i> Back to Homepage</button>
<script>
$('#gotohome').click(function() {
    window.location.replace('/filtermember');
});
</script>
</div>
</body>
<script>

  $.getJSON('/EmsgetInsideEnergyCustomDate?Startdate={{$Startdate}}&Stopdate={{$Stopdate}}&Dept_ID={{$Dept_ID}}', function(data){
    console.log("MonthlrEnergy:"+ data);
    var xstart = document.getElementById("hiddenstartdate").value;
     var xstop = document.getElementById("hiddenstopdate").value;
     var Startpor = new Date(xstart);
     var Stoppor = new Date(xstop);
     console.log("this is start date:"+Startpor);
     console.log("this is stop date:"+Stoppor);

     var datestart = new Date(Startpor);
        datestart.setHours(00);
        datestart.setMinutes(00);
        datestart.setSeconds(00);
    var start = datestart;
      console.log(start);
    var datestop = new Date(Stoppor);
        datestop.setHours(23);
        datestop.setMinutes(59);
        datestop.setSeconds(00);
    var stop = datestop;
  var MonthlyEnergychart = new Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        type: 'category',
       
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        },
        
        
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Power(Wh)'
        },
       
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>{point.y:.1f} Wh</b>'
    },
    series: [{
        data: data.resultplot,
    },{
        name: 'Population',
        color:"#F67280",
        data: data.result,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
});
</script>
</html>