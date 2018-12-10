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
<input type="number" id="Yearselect" style="margin-left:80%;width:20%;" placeholder="YYYY" min="2017" max="2100">
<div id="container" style="width:100%;height:55%;"></div>
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
                        <p id="EMSGetThisMonthenergyInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$TotalInsideenergythismonth}} Unit</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">TOTAL ENERGY DAILY</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="EMSGetrealtimepowerMonthInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$RealtimeInsidepower/1000}} kW</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">POWER REAL-TIME</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="ElectricityChargethisyearInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$TotalInsideenergythismonth * $Money_rate}} THB</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">ELECTRICITY CHARGE TODAY</h2>
                    </div>
                    <div class="col-md-3">
                        <p id="EMSGetYearlastupdatetimeInside" style="text-align:center;color:#3DF085;font-weight: bold;">{{$DisdateMaxInside}}</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">DATA LAST UPDATE</h2>
                    </div>
                </div>
              </div>
            </div>
            
        </div>
      </section>
<script>
  document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>
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
  $.getJSON('/YearlyEnergychartInside?Date='+today+'&DeptID='+{{$DeptdetailID}}, function(data){
    console.log("MonthlrEnergy:"+ data);
    
  var YearlyEnergychart = new Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Energy Trends of '+'{{$Deptdetailname }}'
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
        color:"#02BEC4",
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
      data: [[1,null],[12,null]],
                       
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/YearlyEnergychartInside?Date='+today+'&DeptID='+{{$DeptdetailID}},
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        YearlyEnergychart.series[0].setData(newdata);   
                    console.log("New Monthly Energy data :"+newdata);
                    });
    }, 300000);  
    });    
        </script>
      <!-- For Chart Power Overview -->
      <!-- Script when Change Input date -->
      <script>
            $('#Yearselect').on('change',function(e){
                var Year = e.target.value; 
                console.log("On Cheange: "+Year);
                $.getJSON('/YearlyEnergychartInside?Date='+Year+'&DeptID='+{{$DeptdetailID}}, function(data){
                console.log("MonthlrEnergy:"+ data);
                // Highcharts.chart('container', {
                  var YearlyEnergychartonchange = new Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Energy Trends of '+'{{$Deptdetailname }}'
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
        color:"#02BEC4",
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
      data: [[1,null],[12,null]],
                       
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/YearlyEnergychartInside?Date='+Year+'&DeptID='+{{$DeptdetailID}},
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        YearlyEnergychartonchange.series[0].setData(newdata);   
                    console.log("New Monthly Energy data :"+newdata);
                    });
    }, 300000);  
    });  
  });
    </script>
    <script>
    // Interval Time Total Energy this day
    setInterval(function () 
            {
                  $.ajax(
                      {
                      url: "/EMSGetThisYearenergyInside?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(TotalEnergythismonth) 
                          {
                              console.log("Total Energy this year inside: "+TotalEnergythismonth); 
                              document.getElementById("EMSGetThisMonthenergyInside").innerHTML = TotalEnergythismonth.toFixed(0)+" Unit";      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetlastupdatetimeInside?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(Lastupdatetime) 
                          { 
                              console.log("Lastupdatetimeinside: "+Lastupdatetime);
                              document.getElementById("EMSGetYearlastupdatetimeInside").innerHTML = Lastupdatetime;      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetrealtimeInsidepower?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(RealtimePowerthisday) 
                          {
                              console.log("RealtimePowerthisyearInside: "+RealtimePowerthisday/1000); 
                              document.getElementById("EMSGetrealtimepowerMonthInside").innerHTML = (RealtimePowerthisday/1000).toFixed(3)+" kW";      
                          }
                      );
                  $.ajax(
                      {
                      url: "/EMSGetThisYearenergyInside?DeptID="+{{$DeptdetailID}},
                      type: 'GET',   
                      }).done( 
                      function(ElectricityChargethisyear) 
                          {
                              
                              console.log("RealtimePowerthisyear: "+ElectricityChargethisyear*{{$Money_rate}}); 

                              document.getElementById("ElectricityChargethisyearInside").innerHTML = "$ "+(ElectricityChargethisyear*{{$Money_rate}}).toFixed(2)+" Bath";      
                          }
                      );
            }, 300000);
            
                    </script> 
        
      <!-- Script when Change Input date -->