<!-- For Chart Power Overview -->
<input type="number" id="Yearselect" style="margin-left:80%;width:20%;" placeholder="YYYY" min="2017" max="2100">
<div id="container" style="width:100%;height:55%;"></div>
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
                    color: '#B2FF51',
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
            });
        </script>
      <!-- Script when Change Input date -->