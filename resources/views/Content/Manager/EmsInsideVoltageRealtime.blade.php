<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REAL-TIME VOLTAGE</title>
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
<h1 style="text-align:center;margin-bottom:4%;">REAL-TIME VOLTAGE OF {{$Dept_Name}}</h1>

<div id="container"></div>
<button type="button" id="gotohome" class="btn btn-danger" style="width:170px;margin-top:4%;" ><i class="far fa-arrow-alt-circle-left"></i> Back to Homepage</button>
<script>
$('#gotohome').click(function() {
    window.location.replace('/filtermember');
});
</script>
</div>
</body>

</html>
<script>

 Highcharts.setOptions({
            global: {
                useUTC: false,
            },
            });
// Highcharts.chart('container', {
$.getJSON('/EmsgetVoltageRealtime?Dept_ID={{$Dept_ID}}', function(data){
    var RealtimeVoltage = new Highcharts.chart('container', {
    chart: {
        type: 'line',
        zoomType: 'x',
        
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        type: 'datetime',
      
        
    },
    yAxis: {
        title: {
            text: 'Real-Time Voltage'
        },
        
    },
    series: [{
        name: 'String1',
        data: data[0]
    },{
        name: 'String2',
        data: data[1]
    },{
        name: 'String3',
        data: data[2]
    },{
        name: 'String4',
        data: data[3]
    },{
        name: 'String5',
        data: data[4]
    }]
    });
    setInterval(function () {
    $.ajax(
            {
                url: '/EmsgetVoltageRealtime?Dept_ID={{$Dept_ID}}',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        RealtimeVoltage.series[0].setData(newdata[0]);   
                        RealtimeVoltage.series[1].setData(newdata[1]);   
                        RealtimeVoltage.series[2].setData(newdata[2]);   
                        RealtimeVoltage.series[3].setData(newdata[3]);   
                        RealtimeVoltage.series[4].setData(newdata[4]);
                        console.log("Request new Voltage");

                    });
    }, 10000);  
});

</script>