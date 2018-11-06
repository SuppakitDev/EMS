<!-- For Chart Power Overview -->
<!-- For Chart Power Overview -->
<div class="row" style="margin-top:2%;margin-left:4%;margin-right:4%">
            <div class="col-md-8">
              <div class="float-left">
                <i class="icon-sli-graph text-primary text-size-30 text-line-height-1"></i>
              </div>
              <div  >
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Power of Thai-Tabuchi Electric</h3>
<input type="number" id="Yearselect" style="margin-left:80%;width:20%;" placeholder="YYYY" min="2017" max="2100">
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
                <div id="container2" style="width:100%;height:55%;"></div>
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
                        <p style="text-align:center;color:#3DF085;font-weight: bold;">136 Unit</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">TOTAL ENERGY DAILY</h2>
                    </div>
                    <div class="col-md-3">
                        <p style="text-align:center;color:#3DF085;font-weight: bold;">930.215 kW</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">POWER DAILY</h2>
                    </div>
                    <div class="col-md-3">
                        <p style="text-align:center;color:#3DF085;font-weight: bold;">558.96 THB</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">ELECTRICITY CHARGE TODAY</h2>
                    </div>
                    <div class="col-md-3">
                        <p style="text-align:center;color:#3DF085;font-weight: bold;">2018-10-26 08:30:00</p>
                        <h2 class="text-dark text-size-15" style="text-align:center;">DATA LAST UPDATE</h2>
                    </div>
                </div>
              </div>
            </div>
<script>
  document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>
<script>           
              Highcharts.chart('container', {
                chart: {
                  type: 'area',
                
                },
                title: {
                  text: 'US and USSR nuclear stockpiles'
                },
                subtitle: {
                  text: null
                },
                xAxis: {
                  allowDecimals: false,
                  labels: {
                    formatter: function () {
                      return this.value; // clean, unformatted number for year
                    }
                  }
                },
                yAxis: {
                  title: {
                    text: 'Nuclear weapon states'
                  },
                  labels: {
                    formatter: function () {
                      return this.value / 1000 + 'k';
                    }
                  }
                },
                tooltip: {
                  pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
                },
                plotOptions: {
                  
                  area: {
                    color: '#D73C66',
                    pointStart: 1940,
                    marker: {
                      enabled: false,
                      symbol: 'circle',
                      radius: 2,
                      states: {
                        hover: {
                          enabled: true
                        }
                      }
                    }
                  }
                },
                series: [{
                  name: 'USA',
                  data: [
                    null, null, null, null, null, 6, 11, 32, 110, 235,
                    369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
                    20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
                    26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
                    24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
                    21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
                    10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
                    5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
                  ]
                }]
              });
        </script>
      <!-- For Chart Power Overview -->
      <!-- Script when Change Input date -->
        <script>
            $('#Yearselect').on('change',function(e){
                Highcharts.chart('container', {
                chart: {
                  type: 'area',
                
                },
                title: {
                  text: 'US and USSR nuclear stockpiles'
                },
                subtitle: {
                  text: null
                },
                xAxis: {
                  allowDecimals: false,
                  labels: {
                    formatter: function () {
                      return this.value; // clean, unformatted number for year
                    }
                  }
                },
                yAxis: {
                  title: {
                    text: 'Nuclear weapon states'
                  },
                  labels: {
                    formatter: function () {
                      return this.value / 1000 + 'k';
                    }
                  }
                },
                tooltip: {
                  pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
                },
                plotOptions: {
                  
                  area: {
                    color: '#FFF300',
                    pointStart: 1940,
                    marker: {
                      enabled: false,
                      symbol: 'circle',
                      radius: 2,
                      states: {
                        hover: {
                          enabled: true
                        }
                      }
                    }
                  }
                },
                series: [{
                  name: 'USA',
                  data: [
                    null, null, null, null, null, 6, 11, 32, 110, 235,
                    369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
                    20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
                    26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
                    24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
                    21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
                    10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
                    5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
                  ]
                }]
              });
              Highcharts.chart('container2', {
              chart: {
                    // width: 250
                },
            title: {
                text: null
            },
            plotOptions: {
                    pie: {
                        size: 200
                    }
                },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    ['Apples', 29.9, false],
                    ['Pears', 71.5, false],
                    ['Oranges', 106.4, false],
                    ['Plums', 129.2, false],
                    ['Bananas', 144.0, false],
                    ['Peaches', 176.0, false],
                    ['Prunes', 135.6, true, true],
                    ['Avocados', 148.5, false]
                ],
                showInLegend: true
            }]
            });

            });
        </script>
      <!-- Script when Change Input date -->
      <!-- For Donunt Chart -->
      <script>
            
            Highcharts.chart('container2', {
              chart: {
                    // width: 250
                },
            title: {
                text: null
            },
            plotOptions: {
                    pie: {
                        size: 200
                    }
                },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    ['Apples', 29.9, false],
                    ['Pears', 71.5, false],
                    ['Oranges', 106.4, false],
                    ['Plums', 129.2, false],
                    ['Bananas', 144.0, false],
                    ['Peaches', 176.0, false],
                    ['Prunes', 135.6, true, true],
                    ['Avocados', 148.5, false]
                ],
                showInLegend: true
            }]
            });
                    </script>
        <!-- For Donunt Chart -->
      <!-- Script when Change Input date -->