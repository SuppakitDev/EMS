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

<!-- Contact Form V5 -->
<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/vendor/noui/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/css/util.css">
	<link rel="stylesheet" type="text/css" href="ContactFrom_v5/css/main.css">
<!-- Contact Form V5 -->
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
          <h2 class="text-dark text-size-30 text-m-size-40"><b>Detail of {{$Deptdetailname}}</b></h2>
          <!-- <hr class="break background-primary break-small break-center margin-bottom-10"> -->
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
               
               <button onclick="InsiteDeptDaily()" type="button" class="btn btn-info" style="margin-right:2px;" >Daily</button>

               <button onclick="InsiteDeptMonthly()" type="button" class="btn btn-danger" style="margin-right:2px;" >Monthly</button>
           
               <button onclick="InsiteDeptYearly()" type="button" class="btn btn-primary" style="margin-right:2px;">Yearly</button>
           
               <button data-toggle="modal" data-target="#CustomdateInsiteDept" type="button" class="btn btn-success">Custom</button>

       </div>
        </div>
        
        
         <!-- Modal Costom date -->
          <!-- Modal Costom date -->
          <div class="modal fade" id="CustomdateInsiteDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title input100" id="exampleModalLabel" style="color:#16915B;font-size:170%;"><i style="color:#0BFF73;" class="icon-sli-calendar"></i>  Custom Date InsideDept</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                            <!-- <span aria-hidden="true">&times;</span> -->
                            <!-- </button> -->
                        </div>
                        <div class="modal-body">
                        <div class="container-contact100">
		<div class="wrap-contact100">
			<!-- <form class="contact100-form validate-form"> -->
            <?= Form::open(array('url' => 'EmsInsideCustomDate','method'=>'get','class'=>'contact100-form validate-form','target' => '_blank')) ?>
                                    
                                            {{ csrf_field() }}
                
                        <div class="row" Style="margin-left:2%;" >
						<div class="contact100-form-radio" style="margin-right:2%;">
							<input class="input-radio100" id="radio2" type="radio" name="type-select" value="Power">
							<label class="label-radio100" for="radio2">
								Power
							</label>
						</div>
                        <br>
						<div class="contact100-form-radio">
							<input class="input-radio100" id="radio3" type="radio" name="type-select" value="Energy">
							<label class="label-radio100" for="radio3">
								Energy
							</label>
                        </div>
                        </div>
				<div class="wrap-input100 validate-input bg1" data-validate="Please Select Start Date">
					<span class="label-input100">FROM</span>
					<input class="input100" type="date" name="Startdate" >
				</div>

				<div class="wrap-input100 validate-input bg1" data-validate="Please Select Stop Date">
					<span class="label-input100">FROM</span>
					<input class="input100" type="date" name="Stopdate" >
				</div>

				<input type="hidden" name="Dept_ID" value="{{$DeptdetailID}}">
				<input type="hidden" name="Dept_Name" value="{{$Deptdetailname}}">
            
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							Submit
							<i class="icon-sli-control-forward" aria-hidden="true"></i>
						</span>
					</button>
				</div>
                {!! Form::close() !!}
		</div>
	</div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>


  
                <div class="ChartInsideDept">
                
                </div>
 

       <!-- Section 3 -->
    <section style="width:100%;margin-top:2%;">
        <div class="line text-center">
          <i class="icon-sli-screen-desktop text-primary text-size-30"></i>
          <h2 class="text-dark text-size-30 text-m-size-40"><b>{{$Deptdetailname}} Detail</b></h2>
          <div class="row" style="width:25%;margin:auto;">
            <div class="col-6">
                <button type="button" onclick="window.open('/VoltageRealtime?Dept_ID={{$DeptdetailID}}&Dept_Name={{$Deptdetailname}}')"  class="btn btn-info btn-sm">Voltage real-time</button>
            </div>
            <div class="col-6">
                <button type="button" onclick="window.open('/CurrentRealtime?Dept_ID={{$DeptdetailID}}&Dept_Name={{$Deptdetailname}}')"  class="btn btn-danger btn-sm">Current real-time</button>
            </div>
          </div>
        </div>
        <hr class="break background-primary break-small break-center margin-bottom-10">

        <div class="line">
        <div class="row" style="margin-left:15%;margin-right:10%;margin-top:0%;margin-bottom:2%;">
        
          <div class="s-12 s-6 l-2  card" style="margin-right:3%;">
              <div class="float-left" style="padding: 2% 2% 2% 2%;">
                <i class="icon-sli-energy text-secondary text-size-40 text-line-height-1"></i>
              </div>
              <div class="margin-left-10">
              <h3 id="String1Index0" class="text-strong text-size-20 text-line-height-1 margin-bottom-20">LN Name ......</h3>
                <hr>
                <h4 id="String1Index1" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">Power:  ??</h4>
                <hr>
                <h4 id="String1Index2" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">V:  ??</h4>
                <hr>
                <h4 id="String1Index3" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">I:  ??</h4>
                <hr>
                <h4 id="String1Index4" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">PF:  ??</h4>
              </div>
          </div>
          <div class="s-12 s-6 l-2 card " style="margin-right:3%;">
              <div class="float-left" style="padding: 2% 2% 2% 2%;">
                <i class="icon-sli-energy text-danger text-size-40 text-line-height-1"></i>
              </div>
              <div class="margin-left-10">
              <h3 id="String2Index0" class="text-strong text-size-20 text-line-height-1 margin-bottom-20">LN Name ......</h3>
                <hr>
                <h4 id="String2Index1" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">Power:  ??</h4>
                <hr>
                <h4 id="String2Index2" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">V:  ??</h4>
                <hr>
                <h4 id="String2Index3" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">I:  ??</h4>
                <hr>
                <h4 id="String2Index4" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">PF:  ??</h4>
              </div>
          </div>
          <div class="s-12 s-6 l-2 card " style="margin-right:3%;">
              <div class="float-left" style="padding: 2% 2% 2% 2%;">
                <i class="icon-sli-energy text-info text-size-40 text-line-height-1"></i>
              </div>
              <div class="margin-left-10">
              <h3 id="String3Index0" class="text-strong text-size-20 text-line-height-1 margin-bottom-20">LN Name ......</h3>
                <hr>
                <h4 id="String3Index1" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">Power:  ??</h4>
                <hr>
                <h4 id="String3Index2" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">V:  ??</h4>
                <hr>
                <h4 id="String3Index3" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">I:  ??</h4>
                <hr>
                <h4 id="String3Index4" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">PF:  ??</h4>
              </div>
          </div>
          <div class="s-12 s-6 l-2 card " style="margin-right:3%;">
              <div class="float-left" style="padding: 2% 2% 2% 2%;">
                <i class="icon-sli-energy text-warning text-size-40 text-line-height-1"></i>
              </div>
              <div class="margin-left-10">
              <h3 id="String4Index0" class="text-strong text-size-20 text-line-height-1 margin-bottom-20">LN Name ......</h3>
                <hr>
                <h4 id="String4Index1" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">Power:  ??</h4>
                <hr>
                <h4 id="String4Index2" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">V:  ??</h4>
                <hr>
                <h4 id="String4Index3" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">I:  ??</h4>
                <hr>
                <h4 id="String4Index4" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">PF:  ??</h4>
              </div>
          </div>
          <div class="s-12 s-6 l-2 card " style="margin-right:3%;">
              <div class="float-left" style="padding: 2% 2% 2% 2%;">
                <i class="icon-sli-energy text-primary text-size-40 text-line-height-1"></i>
              </div>
              <div class="margin-left-10">
              <h3 id="String5Index0" class="text-strong text-size-20 text-line-height-1 margin-bottom-20">LN Name ......</h3>
                <hr>
                <h4 id="String5Index1" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">Power:  ??</h4>
                <hr>
                <h4 id="String5Index2" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">V:  ??</h4>
                <hr>
                <h4 id="String5Index3" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">I:  ??</h4>
                <hr>
                <h4 id="String5Index4" class="text-strong text-size-15 text-line-height-1"style="margin-left:5%;">PF:  ??</h4>
              </div>
          </div>
</div>
        </div>
      </section>
      <script>
          //  <!-- Ajax change Content Zone -->
              $( document ).ready(function() {
                $.ajax(
                    {
                        url: "/getEmsInsideDeptDaily?DeptID="+{{$DeptdetailID}},
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
                        url: "/getEmsInsideDeptDaily?DeptID="+{{$DeptdetailID}},
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
                        url: "/getEmsInsideDeptMonthly?DeptID="+{{$DeptdetailID}},
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
                        url: "/getEmsInsideDeptYearly?DeptID="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            $('.ChartInsideDept').html(data.html);
                        }
                    );
                    }
          // <!-- Ajax change Content Zone -->



                    $.ajax(
                    {
                        url: "/EmsInsideString1?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            data.forEach(function(value) {
                                document.getElementById("String1Index0").innerHTML = value.Ln1;
                                document.getElementById("String1Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof1/1000+" kW</h4>";
                                document.getElementById("String1Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms1/100+" V</h4>";
                                document.getElementById("String1Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms1/1000+" I</h4>";
                                document.getElementById("String1Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF1/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString2?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            data.forEach(function(value) {
                                document.getElementById("String2Index0").innerHTML = value.Ln2;
                                document.getElementById("String2Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof2/1000+" kW</h4>";
                                document.getElementById("String2Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms2/100+" V</h4>";
                                document.getElementById("String2Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms2/1000+" I</h4>";
                                document.getElementById("String2Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF2/1000+"</h4>";
                        
                        });
                    }
                    );

                       $.ajax(
                    {
                        url: "/EmsInsideString3?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            data.forEach(function(value) {
                                document.getElementById("String3Index0").innerHTML = value.Ln3;
                                document.getElementById("String3Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof3/1000+" kW</h4>";
                                document.getElementById("String3Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms3/100+" V</h4>";
                                document.getElementById("String3Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms3/1000+" I</h4>";
                                document.getElementById("String3Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF3/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString4?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            data.forEach(function(value) {
                                document.getElementById("String4Index0").innerHTML = value.Ln4;
                                document.getElementById("String4Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof4/1000+" kW</h4>";
                                document.getElementById("String4Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms4/100+" V</h4>";
                                document.getElementById("String4Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms4/1000+" I</h4>";
                                document.getElementById("String4Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF4/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString5?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            data.forEach(function(value) {
                                document.getElementById("String5Index0").innerHTML = value.Ln5;
                                document.getElementById("String5Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof5/1000+" kW</h4>";
                                document.getElementById("String5Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms5/100+" V</h4>";
                                document.getElementById("String5Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms5/1000+" I</h4>";
                                document.getElementById("String5Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF5/1000+"</h4>";
                        
                        });
                    }
                    );

          </script>

          <script>
               setInterval(function () {
                $.ajax(
                    {
                        url: "/EmsInsideString1?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            console.log("String1");
                            data.forEach(function(value) {
                                document.getElementById("String1Index0").innerHTML = value.Ln1;
                                document.getElementById("String1Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof1/1000+" kW</h4>";
                                document.getElementById("String1Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms1/100+" V</h4>";
                                document.getElementById("String1Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms1/1000+" I</h4>";
                                document.getElementById("String1Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF1/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString2?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            console.log("String2");
                            data.forEach(function(value) {
                                document.getElementById("String2Index0").innerHTML = value.Ln2;
                                document.getElementById("String2Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof2/1000+" kW</h4>";
                                document.getElementById("String2Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms2/100+" V</h4>";
                                document.getElementById("String2Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms2/1000+" I</h4>";
                                document.getElementById("String2Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF2/1000+"</h4>";
                        
                        });
                    }
                    );

                       $.ajax(
                    {
                        url: "/EmsInsideString3?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            console.log("String3");
                            data.forEach(function(value) {
                                document.getElementById("String3Index0").innerHTML = value.Ln3;
                                document.getElementById("String3Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof3/1000+" kW</h4>";
                                document.getElementById("String3Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms3/100+" V</h4>";
                                document.getElementById("String3Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms3/1000+" I</h4>";
                                document.getElementById("String3Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF3/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString4?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            console.log("String4");
                            data.forEach(function(value) {
                                document.getElementById("String4Index0").innerHTML = value.Ln4;
                                document.getElementById("String4Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof4/1000+" kW</h4>";
                                document.getElementById("String4Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms4/100+" V</h4>";
                                document.getElementById("String4Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms4/1000+" I</h4>";
                                document.getElementById("String4Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF4/1000+"</h4>";
                        
                        });
                    }
                    );

                     $.ajax(
                    {
                        url: "/EmsInsideString5?Dept_id="+{{$DeptdetailID}},
                        type: 'GET',
                    }).done( 
                        function(data) 
                        {
                            console.log("String5");
                            data.forEach(function(value) {
                                document.getElementById("String5Index0").innerHTML = value.Ln5;
                                document.getElementById("String5Index1").innerHTML =  "<h4><b>Power : </b>"+" "+value.Pof5/1000+" kW</h4>";
                                document.getElementById("String5Index2").innerHTML =  "<h4><b>V : </b>"+" "+value.Vrms5/100+" V</h4>";
                                document.getElementById("String5Index3").innerHTML =  "<h4><b>I : </b>"+" "+value.Irms5/1000+" I</h4>";
                                document.getElementById("String5Index4").innerHTML =  "<h4><b>PF : </b>"+" "+value.PF5/1000+"</h4>";
                        
                        });
                    }
                    );
          }, 10000);
          </script>

<!-- Contact Form V5  -->
<script src="ContactFrom_v5/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="ContactFrom_v5/vendor/animsition/js/animsition.min.js"></script>
	<script src="ContactFrom_v5/vendor/bootstrap/js/popper.js"></script>
	<script src="ContactFrom_v5/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="ContactFrom_v5/vendor/select2/select2.min.js"></script>
	<!-- <script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});


			$(".js-select2").each(function(){
				$(this).on('select2:close', function (e){
					if($(this).val() == "Please chooses") {
						$('.js-show-service').slideUp();
					}
					else {
						$('.js-show-service').slideUp();
						$('.js-show-service').slideDown();
					}
				});
			});
		})
	</script> -->
	<script src="ContactFrom_v5/vendor/daterangepicker/moment.min.js"></script>
	<script src="ContactFrom_v5/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="ContactFrom_v5/vendor/countdowntime/countdowntime.js"></script>
	<!-- <script src="ContactFrom_v5/vendor/noui/nouislider.min.js"></script> -->
	<!-- <script>
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 1500, 3900 ],
	        connect: true,
	        range: {
	            'min': 1500,
	            'max': 7500
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]);
	        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
	        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	    });
	</script> -->
	<script src="ContactFrom_v5/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<!-- Contact Form V5  -->
@endsection