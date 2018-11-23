<div class="line">
<div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
  <div class="col-md-8">
    <div class="float-left">
      <i class="icon-sli-graph text-primary text-size-30 text-line-height-1"></i>
    </div>
    <div>
      <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Power of Thai-Tabuchi Electric</h3>
      <input type="date" style="margin-left:80%;width:20%;" name="Dailyselect" id="Dailyselect">
      <div id="EmsOverviewDaily" style="width:100%;height:50%;"></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="float-left">
      <i class="icon-sli-pie-chart text-primary text-size-30 text-line-height-1"></i>
    </div>
    <div>
      <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Energy Department Comparison</h3>
      <!-- Donut graph -->
      <div id="EmsOverviewDailyDonut" style="width:100%;height:55%;"></div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="float-left">
      <i class="icon-sli-book-open text-primary text-size-30 text-line-height-1"></i>
    </div>
    <div>
      <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Information to day.</h3>
      <div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
        <div class="col-md-3">
          <p id="Energythisdayoverview" style="text-align:center;color:#3DF085;font-weight: bold;">{{$Totalenergythisday}} Unit</p>
          <h2  class="text-dark text-size-15" style="text-align:center;">TOTAL ENERGY DAILY</h2>
        </div>
        <div class="col-md-3">
          <p id="Realtimepowerthisday" style="text-align:center;color:#3DF085;font-weight: bold;">{{$Realtimepower/1000}} kW</p>
          <h2 class="text-dark text-size-15" style="text-align:center;">POWER REAL-TIME</h2>
        </div>
        <div class="col-md-3">
          <p id="ElectricityChargethisday" style="text-align:center;color:#3DF085;font-weight: bold;">{{$Totalenergythisday * $Money_rate}} THB</p>
          <h2 class="text-dark text-size-15" style="text-align:center;">ELECTRICITY CHARGE TODAY</h2>
        </div>
        <div class="col-md-3">
          <p id="Lastupdatetime" style="text-align:center;color:#3DF085;font-weight: bold;">{{$DisdateMax}}</p>
          <h2 class="text-dark text-size-15" style="text-align:center;">DATA LAST UPDATE</h2>
        </div>
      </div>
    </div>
</div>
</div>
        </section>
        <!-- Section 3 -->
        <section style="width:100%;padding-top:45px;">
            <div class="line text-center">
                <i class="icon-sli-chart text-primary text-size-40"></i>
                <h2 class="text-dark text-size-30 text-m-size-40"><b>Energy This day VS Energy Yesterday </b></h2>
                <!-- <hr class="break background-primary break-small break-center margin-bottom-45"> -->
            </div>
        <div class="line">
            <div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
                <div class="col-md-12">
                    <div class="float-left">
                        <i class="icon-sli-graph text-primary text-size-30 text-line-height-1"></i>
                    </div>
                <div>
                    <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Power of {{$companyname}}</h3>
                    <!-- Graph Power -->
                    <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- <input data-provide="datepicker"> -->
<script type="text/javascript">  

        // $('#container3').highcharts({
            $.getJSON('/EMSGetComparewithyesterday', function(data){
        var Dailydetailchart = new Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: '{{$companyname }}'+' Department'
        },
        subtitle: {
            text: 'Energy This day VS Energy yesterday.'
        },
        xAxis: {
            categories:data.Name
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Energy (Wh)'
            }
        },
        legend: {
            // layout: 'horizontal',
            backgroundColor: '#FFFFFF',
            // floating: true,
            // align: 'left',
            // verticalAlign: 'top',
            title: "TEST"
        },
        tooltip: {
            shared: true,
            valueSuffix: ' Wh'
        },
        plotOptions: {
            column: {
                grouping: true,
                shadow: false,
                // pointWidth: 10,
                borderWidth: 0
            }
        },
          
        series: [
        {
            name: 'Yesterday',
            data: data.Totalenergyyesterday,
            // pointPlacement: -0.1,
            color: '#3D3C40'

        }, {
            name: 'This day',
            data: data.Totalenergythisday,
            // pointPlacement: 0.1,
            color: '#47FFAF'

        },
        ]
    });
    setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetComparewithyesterday',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Dailydetailchart.series[0].setData(newdata.Totalenergyyesterday);   
                        Dailydetailchart.series[1].setData(newdata.Totalenergythisday);   
                    console.log("New Data Added");
                    });
    }, 300000);  
    });


    var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd;
                } 
            if(mm<10){
                mm='0'+mm;
                } 
            var Daily = yyyy+'-'+mm+'-'+dd;
        // document.getElementById("daily").value = Daily;
    console.log(Daily);
    var today = new Date();
    var ddT = today.getDate();
    var mmT = today.getMonth()+1; //January is 0!
    var yyyyT = today.getFullYear();
    if(ddT<10) {
        ddT = '0'+ddT
    } 
    if(mmT<10) {
        mmT = '0'+mmT
    } 
    today = yyyyT + '-' + mmT+ '-' + ddT  ;
    // ajax
    $.getJSON('/EMSGetlastPowerrealtimeDaily?date='+today, function(data){
    console.log("last data"+data);
    //display all time label 
    var datestart = new Date(today);
        datestart.setHours(00);
        datestart.setMinutes(00);
        datestart.setSeconds(00);
    var start = datestart;
      console.log(start);
    var datestop = new Date(today);
        datestop.setHours(23);
        datestop.setMinutes(59);
        datestop.setSeconds(00);
    var stop = datestop;
      console.log(stop);
    Highcharts.setOptions({
            colors: ['#2FFFA4'],
            global: {
                useUTC: false,
            },
            });
            var Dailydetailchart = new Highcharts.chart('EmsOverviewDaily', {
    chart: {

    zoomType: 'x',
    // margin:[50, 0, 40, 10],
    backgroundColor:'transparent',
    // height:'330px',
    },
    title: {
    text: null
    },

    xAxis: {
    title: {
        text: 'Hours'
    },
    type: 'datetime',
    // ordinal: false,
    // startOnTick: false,
    // endOnTick: false,
    // minPadding: 0,
    // maxPadding: 0,
    tickInterval: 60 * 10000,
    // minTickInterval: 60 * 1000 
    },

    yAxis: {
    min:0, 
    title: {
        text: "Power (W)"
    }
    },
    legend: {
    enabled: false
    },
    title: {
        text: null
          },
    credits: {
        enabled: false
          },
    exporting: {
        enabled: false
          },
    plotOptions: {
        series: {
        borderColor: 'transparent'
            },
    area: {
        fillColor: {
            linearGradient: {
                x1: 0,
                y1: 0,
                x2: 0,
                y2: 1
            },
            stops: [
                [0, Highcharts.getOptions().colors[0]],
                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
            ]
        },
        marker: {
            radius: 2
        },
        lineWidth: 1,
        states: {
            hover: {
                lineWidth: 1
            }
        },
        threshold: null
    }
    },
    series: [{
    type: 'area',
    name: 'Power',
    data: [{"x":start,"y":null},{"x":stop,"y":null}]
    },{
    type: 'area',
    name: 'Power',
    data: data 
    }]
    });
    setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetlastPowerrealtimeDaily?date='+today,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        Dailydetailchart.series[1].setData(newdata);   
                    console.log("new last data "+newdata);
                    });
    }, 300000);  
    });

  $.getJSON('/EMSGetDepartmentConpare?date='+today, function(data){
    console.log("DepartmentConpare data: "+data);
    var DailydetailchartPie = new Highcharts.chart('EmsOverviewDailyDonut', {
    // Highcharts.chart('EmsOverviewDailyDonut', {
              chart: {
                    // width: 250
                },
            title: {
                text: null
            },
            plotOptions: {
        pie: {
          size:210,
          colors: ['#85FF92', '#36E8BE', '#73FFF1', '#8AE8AF', '#348A5D', '#004E5A', '#00716C', '#7BD632'
                  , '#43BF36', '#32D654', '#07C9AC', '#0CE8CF', '#00D7FF', '#0C8CE8', '#7FB0FF', '#445B42'],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },    
            series: [{
                type: 'pie',
                allowPointSelect: true,
                colorByPoint: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: data,
                showInLegend: true
            }]
            });
            setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetDepartmentConpare?date='+today,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {  
                        DailydetailchartPie.series[0].setData(newdata);   
                    console.log("new last data Pie "+newdata);
                    });
    }, 300000);  
    });

    </script>
     <!-- Script when Change Input date -->
     <script>
    $('#Dailyselect').on('change',function(e){
    var Daily = e.target.value;          
    $.getJSON('/EMSGetlastPowerrealtimeDaily?date='+Daily, function(data){
    console.log("last data"+data);

    //display all time label 
    var datestart = new Date(Daily);
        datestart.setHours(00);
        datestart.setMinutes(00);
        datestart.setSeconds(00);
    var start = datestart;
      console.log(start);
    var datestop = new Date(Daily);
        datestop.setHours(23);
        datestop.setMinutes(59);
        datestop.setSeconds(00);
    var stop = datestop;
      console.log(stop);

    Highcharts.setOptions({
            colors: ['#D94356'],
            global: {
                useUTC: false,
            },
            });
            var Dailydetailchart = new Highcharts.chart('EmsOverviewDaily', {
    chart: {

    zoomType: 'x',
    // margin:[50, 0, 40, 10],
    backgroundColor:'transparent',
    // height:'330px',
    },
    title: {
    text: null
    },

    xAxis: {
    title: {
        text: 'Hours'
    },
    type: 'datetime',
    // ordinal: false,
    // startOnTick: false,
    // endOnTick: false,
    // minPadding: 0,
    // maxPadding: 0,
    tickInterval: 60 * 10000,
    // minTickInterval: 60 * 1000 
    },

    yAxis: {
    min:0, 
    title: {
        text: "Power (W)"
    }
    },
    legend: {
    enabled: false
    },
    title: {
        text: null
          },
    credits: {
        enabled: false
          },
    exporting: {
        enabled: false
          },
    plotOptions: {
        series: {
        borderColor: 'transparent'
            },
        area: {
        fillColor: {
            linearGradient: {
                x1: 0,
                y1: 0,
                x2: 0,
                y2: 1
            },
            stops: [
                [0, Highcharts.getOptions().colors[0]],
                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
            ]
        },
        marker: {
            radius: 2
        },
        lineWidth: 1,
        states: {
            hover: {
                lineWidth: 1
            }
        },
        threshold: null
    }
    },
    series: [{
    type: 'area',
    name: 'Power',
    data: [{"x":start,"y":null},{"x":stop,"y":null}]
    },{
    type: 'area',
    name: 'Power',
    data: data 
    }]
    });
    setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetlastPowerrealtimeDaily?date='+Daily,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        Dailydetailchart.series[1].setData(newdata);   
                    console.log("new last data "+newdata);
                    });
    }, 300000);  
    });

 $.getJSON('/EMSGetDepartmentConpare?date='+Daily, function(data){
    console.log("DepartmentConpare data: "+data);
    var DailydetailchartPieonchange = new Highcharts.chart('EmsOverviewDailyDonut', {
    // Highcharts.chart('EmsOverviewDailyDonut', {
              chart: {
                    // width: 250
                },
            title: {
                text: null
            },
            plotOptions: {
        pie: {
          size:210,
          colors: ['#85FF92', '#36E8BE', '#73FFF1', '#8AE8AF', '#348A5D', '#004E5A', '#00716C', '#7BD632'
                  , '#43BF36', '#32D654', '#07C9AC', '#0CE8CF', '#00D7FF', '#0C8CE8', '#7FB0FF', '#445B42'],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                colorByPoint: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: data,
                showInLegend: true
            }]
            });
            setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetDepartmentConpare?date='+Daily,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {  
                      DailydetailchartPieonchange.series[0].setData(newdata);   
                    console.log("new last data Pie onchange "+newdata);
                    });
    }, 300000);  
    });

});
    // Script when Change Input date

    // Interval Time Total Energy this day
    setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetThisdayenergyOverview",
                      type: 'GET',   
                      }).done( 
                      function(TotalEnergythisday) 
                          {
                              console.log("Total Energy this day: "+TotalEnergythisday); 
                              document.getElementById("Energythisdayoverview").innerHTML = TotalEnergythisday.toFixed(0)+" Unit";      
                          }
                      );
        //   }, 300000);
    
     // Interval Time REAL-TIME Power 
    //  setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetrealtimepower",
                      type: 'GET',   
                      }).done( 
                      function(RealtimePowerthisday) 
                          { 
                              console.log("RealtimePowerthisday: "+RealtimePowerthisday/1000); 

                              document.getElementById("Realtimepowerthisday").innerHTML = (RealtimePowerthisday/1000).toFixed(3)+" kW";      
                          }
                      );
        //   }, 300000);

    // Interval Time Electricity Charge 
    // setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetThisdayenergyOverview",
                      type: 'GET',   
                      }).done( 
                      function(ElectricityChargethisday) 
                          {
                              
                              console.log("ElectricityChargethisday: "+ElectricityChargethisday*{{$Money_rate}}); 

                              document.getElementById("ElectricityChargethisday").innerHTML = "$ "+(ElectricityChargethisday*{{$Money_rate}}).toFixed(2)+" Bath";      
                          }
                      );
        //   }, 300000);

    // Interval Time REAL-TIME Power 
    // setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetlastupdatetime",
                      type: 'GET',   
                      }).done( 
                      function(Lastupdatetime) 
                          {
                              
                              console.log("Lastupdatetime: "+Lastupdatetime); 

                              document.getElementById("Lastupdatetime").innerHTML = Lastupdatetime;      
                          }
                      );
          }, 300000);
</script>

