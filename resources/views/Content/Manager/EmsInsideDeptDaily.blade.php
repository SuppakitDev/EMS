<div class="line">
        <div class="row" style="margin-top:0%;margin-left:4%;margin-right:4%">
            <div class="col-md-12">
              <div class="float-left">
                <i class="icon-sli-graph text-primary text-size-30 text-line-height-1"></i>
              </div>
              <div style="width:100%;">
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Power of Thai-Tabuchi Electric</h3>
                <!-- Graph Power -->
                <!-- <div id="container" style="width:100%;height:55%;"></div> -->
<!-- For Chart Power Overview -->
<input type="date" style="margin-left:80%;width:20%;" name="Dailyselect" id="DailyInsideselect">
<div id="EmsInsideDaily" style="width:100%;height:55%;"></div>
<!-- <input data-provide="datepicker"> -->
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
                        <p id="TotalEnergyInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$TotalInsideenergythisday}} Unit</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">TOTAL ENERGY DAILY</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="RealtimePowerInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$RealtimeInsidepower/1000}} kW</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">POWER REAL-TIME</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="ElectricityChargeInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$TotalInsideenergythisday * $Money_rate}} THB</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">ELECTRICITY CHARGE TODAY</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="LastupdatetimeInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$DisdateMaxInside}}</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">DATA LAST UPDATE</h2>
                    </div>
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
    // ajax
    $.getJSON('/EMSGetInsideRealtimepowerDaily?date='+today+'&DeptID='+{{$DeptdetailID}}, function(data){
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
            var Dailydetailchart = new Highcharts.chart('EmsInsideDaily', {
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
                url: '/EMSGetInsideRealtimepowerDaily?date='+today+'&DeptID='+{{$DeptdetailID}},
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
        </script>


        <script>
    $('#DailyInsideselect').on('change',function(e){
    var Daily = e.target.value;          
    $.getJSON('/EMSGetInsideRealtimepowerDaily?date='+Daily+'&DeptID='+{{$DeptdetailID}}, function(data){
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
            var Dailydetailchartonchange = new Highcharts.chart('EmsInsideDaily', {
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
                url: '/EMSGetInsideRealtimepowerDaily?date='+Daily+'&DeptID='+{{$DeptdetailID}},
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                      Dailydetailchartonchange.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                      Dailydetailchartonchange.series[1].setData(newdata);   
                    console.log("new last data "+newdata);
                    });
    }, 300000);  
    });
    });
    </script> 
      <!-- Script when Change Input date -->
    <script>
     // Get EMS Inside Information
     // Interval Time Total Energy 
     setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGettotalInsideenergy?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(TotalEnergy) 
                          {
                              console.log("Total EnergyInside: "+TotalEnergy); 
                              document.getElementById("TotalEnergyInside").innerHTML = TotalEnergy.toFixed(0)+" Unit";      
                          }
                      );
        //   }, 300000);         
          // Interval Time REAL-TIME Power 
        //   setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetrealtimeInsidepower?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(RealtimePower) 
                          {
                              
                              console.log("RealtimePowerInside: "+RealtimePower/1000); 

                              document.getElementById("RealtimePowerInside").innerHTML = (RealtimePower/1000).toFixed(3)+" kW";      
                          }
                      );
        //   }, 300000);
           // Interval Time Electricity Charge 
        //    setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGettotalInsideenergy?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(ElectricityCharge) 
                          {
                              
                              console.log("ElectricityChargeInside: "+ElectricityCharge*{{$Money_rate}}); 

                              document.getElementById("ElectricityChargeInside").innerHTML = "$ "+(ElectricityCharge*{{$Money_rate}}).toFixed(2)+" Bath";      
                          }
                      );

                   $.ajax(
                      {
                      url: "/EMSGetlastupdatetimeInside?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(Lastupdatetime) 
                          {
                              
                              console.log("LastupdatetimeInside: "+Lastupdatetime); 

                              document.getElementById("LastupdatetimeInside").innerHTML = Lastupdatetime;      
                          }
                      );
          }, 300000);
    </script>
 