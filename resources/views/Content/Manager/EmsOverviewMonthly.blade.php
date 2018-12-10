<!-- For Chart Power Overview -->
<div class="line">
<div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
            <div class="col-md-8">
              <div class="float-left">
                <i  class="icon-sli-graph text-primary text-size-30 text-line-height-1"></i>
              </div>
              <div  >
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40" >Power of Thai-Tabuchi Electric</h3>
<input type="Month" style="margin-left:80%;width:20%;" name="Monthlyselect" id="Monthlyselect">
<div id="container" style="width:100%;height:55%;"></div>
</div>
            </div>
            <div class="col-md-4">
              <div class="float-left">
                <i class="icon-sli-pie-chart text-primary text-size-30 text-line-height-1"></i>
              </div>
              <div >
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Energy Department Comparison</h3>
                <!-- Donut graph -->
                <div id="EmsOverviewMonthlyDonut" style="width:100%;height:55%;"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="float-left">
                <i class="icon-sli-book-open text-primary text-size-30 text-line-height-1"></i>
              </div>
              <div >
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Information to day.</h3>
                <div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
                    <div class="col-md-3">
                        <p id="EMSGetThisMonthenergyOverview" style="text-align:center;color:#FF4849;font-weight: bold;">{{$TotalenergythisMonth}} Unit</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">TOTAL ENERGY MONTHLY</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="RealtimePowerthismonth" style="text-align:center;color:#FF4849;font-weight: bold;">{{$Realtimepower/1000}} kW</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">POWER REAL-TIME</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="ElectricityChargethismonth" style="text-align:center;color:#FF4849;font-weight: bold;">{{$TotalenergythisMonth*$Money_rate}} THB</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">ELECTRICITY CHARGE IHIS MONTH</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="Lastupdatetime" style="text-align:center;color:#FF4849;font-weight: bold;">{{$DisdateMax}}</p>
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
                <h2 class="text-dark text-size-30 text-m-size-40"><b>Energy This Month VS Energy Last Month </b></h2>
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
      <script>           
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
  $.getJSON('/MonthlyEnergychart?Date='+today, function(data){
    console.log("MonthlrEnergy:"+ data);
    
  var MonthlyEnergychart = new Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Energy Trends of '+'{{$companyname }}'
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
        categories: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
        
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Power(Wh)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>{point.y:.1f} Wh</b>'
    },
    series: [{
        name: 'Population',
        color:"#F67280",
        data: data,
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
    },
    {
      name: 'Power',
      data: [[0,null],[30,null]],
                       
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/MonthlyEnergychart?Date='+today,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        MonthlyEnergychart.series[0].setData(newdata);   
                    console.log("New Monthly Energy data :"+newdata);
                    });
    }, 300000);  
    });    
      </script>
      <!-- For Chart Power Overview -->
      <!-- Script when Change Input date -->
      <script>
            $('#Monthlyselect').on('change',function(e){
                var Month = e.target.value; 
                console.log("On Cheange: "+Month);
                $.getJSON('/MonthlyEnergychart?Date='+Month, function(data){
                console.log("MonthlrEnergy:"+ data);
                // Highcharts.chart('container', {
                  var MonthlyEnergychart = new Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Energy Trends of '+'{{$companyname }}'
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
        categories: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
        
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Energy(Wh)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>{point.y:.1f} Wh</b>'
    },
    series: [{
        name: 'Population',
        data: data,
        color:"#F67280",
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
    },
    {
      name: 'Power',
      data: [[0,null],[30,null]],
                       
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/MonthlyEnergychart?Date='+Month,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        MonthlyEnergychart.series[0].setData(newdata);   
                    console.log("New Monthly Energy data :"+newdata);
                    });
    }, 300000);  
    });   

                var date = new Date($('#Monthlyselect').val());
                monthonchange = date.getMonth() + 1;
                yearonchange = date.getFullYear();
                console.log("monthonchange = "+monthonchange);
                console.log("yearonchange = "+yearonchange);
         
    $.getJSON('/EMSGetDepartmentConparethisMonth?Month='+monthonchange+'&Year='+yearonchange, function(data){
    console.log("DepartmentConpare data: "+data);
    var MonthlydetailchartPieonchange = new Highcharts.chart('EmsOverviewMonthlyDonut', {
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
          colors: ['#A83738', '#D95242', '#F26D40', '#F5B74D', '#F3CB60', '#8B4B62', '#BB6F6B', '#EA9674'
                  , '#E8280C', '#FF4500', '#E8670C', '#FBCEAE', '#F69B9A', '#EF4666', '#F7E29C', '#FCBC80'],
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
                url: '/EMSGetDepartmentConparethisMonth?Month='+monthonchange+'&Year='+yearonchange,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {  
                      MonthlydetailchartPieonchange.series[0].setData(newdata);   
                    console.log("new last data Pie "+newdata);
                    });
    }, 300000);  
    });


            });
      </script>
      <!-- Script when Change Input date -->
      <!-- For Donunt Chart -->
      <script>
             var date = new Date();
                month = date.getMonth() + 1;
                year = date.getFullYear();

            console.log(month);
            console.log(year);

            $.getJSON('/EMSGetDepartmentConparethisMonth?Month='+month+'&Year='+year, function(data){
    console.log("DepartmentConpare data: "+data);
    var MonthlydetailchartPie = new Highcharts.chart('EmsOverviewMonthlyDonut', {
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
          colors: ['#A83738', '#D95242', '#F26D40', '#F5B74D', '#F3CB60', '#8B4B62', '#BB6F6B', '#EA9674'
                  , '#E8280C', '#FF4500', '#E8670C', '#FBCEAE', '#F69B9A', '#EF4666', '#F7E29C', '#FCBC80'],
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
                url: '/EMSGetDepartmentConparethisMonth?Month='+month+'&Year='+year,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {  
                      MonthlydetailchartPie.series[0].setData(newdata);   
                    console.log("new last data Pie "+newdata);
                    });
    }, 300000);  
    });


        // $('#container3').highcharts({
        $.getJSON('/EMSGetComparewithlastymonth', function(data){
        var Dailydetailchart = new Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: '{{$companyname }}'+' Department'
        },
        subtitle: {
            text: 'Energy This Month VS Energy Last Month.'
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
            name: 'LastMonth',
            data: data.Totalenergyyesterday,
            // pointPlacement: -0.1,
            color: '#3D3C40'

        }, {
            name: 'This Month',
            data: data.Totalenergythisday,
            // pointPlacement: 0.1,
            color: '#F67280'

        },
        ]
    });
    setInterval(function () {
    $.ajax(
            {
                url: '/EMSGetComparewithlastymonth',
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


    // Interval Time Total Energy this day
    setInterval(function () 
            {
                
                  $.ajax(
                      {
                      url: "/EMSGetThisMonthenergyOverview",
                      type: 'GET',   
                      }).done( 
                      function(TotalEnergythismonth) 
                          {
                              console.log("Total Energy this month: "+TotalEnergythismonth); 
                              document.getElementById("EMSGetThisMonthenergyOverview").innerHTML = TotalEnergythismonth.toFixed(0)+" Unit";      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetlastupdatetimeInside",
                      type: 'GET',   
                      }).done( 
                      function(Lastupdatetime) 
                          { 
                              console.log("Lastupdatetime: "+Lastupdatetime);
                              document.getElementById("Lastupdatetime").innerHTML = Lastupdatetime;      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetrealtimepower",
                      type: 'GET',   
                      }).done( 
                      function(RealtimePowerthisday) 
                          {
                              console.log("RealtimePowerthismonth: "+RealtimePowerthisday/1000); 
                              document.getElementById("RealtimePowerthismonth").innerHTML = (RealtimePowerthisday/1000).toFixed(3)+" kW";      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetThisMonthenergyOverview",
                      type: 'GET',   
                      }).done( 
                      function(ElectricityChargethismonth) 
                          {
                              
                              console.log("RealtimePowerthismonth: "+ElectricityChargethismonth*{{$Money_rate}}); 

                              document.getElementById("ElectricityChargethismonth").innerHTML = "$ "+(ElectricityChargethismonth*{{$Money_rate}}).toFixed(2)+" Bath";      
                          }
                      );
            }, 300000);
                    </script>
        <!-- For Donunt Chart -->
      <!-- Script when Change Input date -->