@extends('Basetemplate.ManagerLayout')
<link href="Card/material-dashboard.css" rel="stylesheet" />
<!-- For Chart Power Overview  -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<!-- <script
  src="https://code.jquery.com/jquery-1.9.1.js"
  integrity="sha256-e9gNBsAcA0DBuRWbm0oZfbiCyhjLrI6bmqAl5o+ZjUA="
  crossorigin="anonymous"></script>
  <script src="https://rawgit.com/morr/jquery.appear/master/jquery.appear.js"></script> -->
<!-- For Chart Power Overview  -->
@section('content')

<header class="section background-image text-center" style="background-image:url(Main-layout/img/BG02-edit.jpg)">
          <h1 style="margin-bottom:5%;" class="animated-element slow text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1  margin-top-130">
            Site Instalation Name
          </h1>
          <p class="animated-element text-white">Duis autem vel eum iriure dolor in hendrerit in</p>
          
          <!-- white full width arrow object -->
          <img class="arrow-object" src="Main-layout/img/arrow-object-white.svg" alt="">
        </header>
        <div class="row" style="margin-top:4%;margin-left:4%;margin-right:4%;">
  <div class="col-sm-4">
  <div style="border: 2px solid #1a1919a6;" class="card card-stats ">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <img style="width:90%;color:#FFF;" src="Card/img/2.png" alt="">
                  </div>
                  <p class="card-category">TOTAL ENERGY IN THIS MONTH.</p>
                  <h3 class="card-title">$34,245</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
                  </div>
                </div>
              </div>
  </div>
  <div class="col-sm-4">
  <div style="border: 2px solid #1a1919a6;" class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                  <img style="width:90%;color:#FFF;" src="Card/img/3.png" alt="">
                  </div>
                  <p class="card-category">REAL-TIME POWER.</p>
                  <h3 class="card-title">$34,245</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
                  </div>
                </div>
              </div>
  </div>
  <div class="col-sm-4">
  <div style="border: 2px solid #1a1919a6;" class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                  <img style="width:90%;color:#FFF;" src="Card/img/4.png" alt="">
                  </div>
                  <p class="card-category">ELECTRICITY CHARGE IN THIS MONTH</p>
                  <h3 class="card-title">$34,245</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
                  </div>
                </div>
              </div>
  </div>

        
    <!-- Section 2 -->
    <section style="width:100%;margin-top:3%;">
        <div class="line text-center">
          <i class="icon-sli-screen-desktop text-primary text-size-30"></i>
          <h2 class="text-dark text-size-30 text-m-size-40">Company Name <b>Overview</b></h2>
          <!-- <hr class="break background-primary break-small break-center margin-bottom-10"> -->
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
               
                    <button onclick="Daily()" type="button" class="btn btn-info active" style="margin-right:2px;" >Daily</button>

                    <button onclick="Monthly()" type="button" class="btn btn-danger" style="margin-right:2px;" >Monthly</button>
                
                    <button onclick="Yearly()" type="button" class="btn btn-primary" style="margin-right:2px;">Yearly</button>
                
                    <button data-toggle="modal" data-target="#CustomdateOverview" type="button" class="btn btn-success">Custom</button>

            </div>
        </div>

         <!-- Modal Costom date -->
         <div class="modal fade" id="CustomdateOverview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CustomdateOverview</h5>
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
     
                <!-- Graph Power -->
                  <div class="Chart1">
                      
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
              <div >
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-40">Power of Thai-Tabuchi Electric</h3>
                <!-- Graph Power -->
                <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
              </div>
            </div>

            </div>
            
        </div>
      </section>
      
      
      
       
     
      <!-- For Column Chart -->
        <script>
       
Highcharts.chart('container3', {

chart: {
    type: 'column'
},

title: {
    text: 'Energy This day VS Energy yesterday'
},

xAxis: {
    categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
},

yAxis: {
    allowDecimals: false,
    min: 0,
    title: {
        text: 'Number of fruits'
    }
},

tooltip: {
    formatter: function () {
        return '<b>' + this.x + '</b><br/>' +
            this.series.name + ': ' + this.y + '<br/>' +
            'Total: ' + this.point.stackTotal;
    }
},

plotOptions: {
    column: {
        stacking: 'normal'
    }
},

series: [{
    name: 'John',
    data: [5, 3, 4, 7, 2],
    stack: 'male'
}, {
    name: 'Joe',
    data: [3, 4, 4, 2, 5],
    stack: 'male'
}, {
    name: 'Jane',
    data: [2, 5, 6, 2, 1],
    stack: 'female'
}, {
    name: 'Janet',
    data: [3, 0, 4, 4, 3],
    stack: 'female'
}]
});
        </script>
      <!-- For Column Chart -->

        <script>
          //  <!-- Ajax change Content Zone -->

              $( document ).ready(function() {
                $.ajax(
                    {
                        url: "/getEmsOverviewDaily",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.Chart1').html(data.html);
                        }
                    );
                    
              });
              function Daily(){
                    $.ajax(
                    {
                        url: "/getEmsOverviewDaily",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.Chart1').html(data.html);
                        }
                    );
                    }

              
              function Monthly(){
                    $.ajax(
                    {
                        url: "/getEmsOverviewMonthly",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.Chart1').html(data.html);
                        }
                    );
                    }

              function Yearly(){
                    $.ajax(
                    {
                        url: "/getEmsOverviewYearly",
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.Chart1').html(data.html);
                        }
                    );
                    }
          // <!-- Ajax change Content Zone -->
          </script>

          
@endsection
