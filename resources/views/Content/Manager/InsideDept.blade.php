@extends('Basetemplate.ManagerLayout')
<link href="Card/material-dashboard.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- For Chart Power Overview  -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('content')
<header class="section background-image text-center" style="background-image:url(Main-layout/img/BG02-edit.jpg)">
          <!-- <h1 style="margin-bottom:5%;" class="animated-element slow text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1  margin-top-130">
            Site Instalation Name
          </h1>
          <p class="animated-element text-white">Duis autem vel eum iriure dolor in hendrerit in</p> -->
          
          <!-- white full width arrow object -->
          <img class="arrow-object" src="Main-layout/img/arrow-object-white.svg" alt="">
        </header>
         <!-- Section 2 -->
    <section style="width:100%;margin-top:0%;">
        <div class="line text-center">
          <!-- <i class="icon-sli-screen-desktop text-primary text-size-30"></i> -->
          <h2 class="text-dark text-size-30 text-m-size-40">Company Name <b>Overview</b></h2>
          <!-- <hr class="break background-primary break-small break-center margin-bottom-10"> -->
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
               
               <button onclick="InsiteDeptDaily()" type="button" class="btn btn-info active" style="margin-right:2px;" >Daily</button>

               <button onclick="InsiteDeptMonthly()" type="button" class="btn btn-danger" style="margin-right:2px;" >Monthly</button>
           
               <button onclick="InsiteDeptYearly()" type="button" class="btn btn-primary" style="margin-right:2px;">Yearly</button>
           
               <button data-toggle="modal" data-target="#CustomdateInsiteDept" type="button" class="btn btn-success">Custom</button>

       </div>
        </div>
        
        
         <!-- Modal Costom date -->
         <div class="modal fade" id="CustomdateInsiteDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CustomdateInsiteDept</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                  <!-- <span aria-hidden="true">&times;</span> -->
                <!-- </button> -->
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
              </div>
            </div>
          </div>
        </div>


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
                <div class="ChartInsideDept">
                
                </div>
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
            
        </div>
      </section>

       <!-- Section 3 -->
    <section style="width:100%;margin-top:2%;">
        <div class="line text-center">
          <i class="icon-sli-screen-desktop text-primary text-size-30"></i>
          <h2 class="text-dark text-size-30 text-m-size-40"><b>1-RND/ENG1 Detail</b></h2>
          <div class="row" style="width:20%;margin:auto;">
            <div class="col-6">
                <button type="button" class="btn btn-info btn-sm">Small button</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-danger btn-sm">Small button</button>
            </div>
          </div>
        </div>
        <hr class="break background-primary break-small break-center margin-bottom-10">

        <div class="line">
        <!-- <h3 class="text-strong text-size-20 text-line-height-1 " style="margin-left:5%;">Power of Thai-Tabuchi Electric</h3> -->
        <div class="row" style="margin-left:4%;margin-right:4%">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
        </div>
      </section>
      <!-- For Chart Power Overview -->
      <script>           
              Highcharts.chart('container', {
                chart: {
                  type: 'area',
                  margin: [0, 0],
                  zoomType: 'x',
                  
                
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
                    color: '#2BFF93',
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
      <script>
          //  <!-- Ajax change Content Zone -->

              $( document ).ready(function() {
                $.ajax(
                    {
                        url: "/getEmsInsideDeptDaily",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.ChartInsideDept').html(data.html);
                        }
                    );
                    
              });
              function InsiteDeptDaily(){
                    $.ajax(
                    {
                        url: "/getEmsInsideDeptDaily",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.ChartInsideDept').html(data.html);
                        }
                    );
                    }

              
              function InsiteDeptMonthly(){
                    $.ajax(
                    {
                        url: "/getEmsInsideDeptMonthly",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.ChartInsideDept').html(data.html);
                        }
                    );
                    }

              function InsiteDeptYearly(){
                    $.ajax(
                    {
                        url: "/getEmsInsideDeptYearly",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.ChartInsideDept').html(data.html);
                        }
                    );
                    }
          // <!-- Ajax change Content Zone -->
          </script>
@endsection