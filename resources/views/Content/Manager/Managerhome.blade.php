@extends('Basetemplate.ManagerLayout')
<link href="Card/material-dashboard.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
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
        <h1 style="margin-bottom:5%;" class="animated-element slow text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1  margin-top-130">
            {{$companyname}}
        </h1>
        <p class="animated-element text-white"><b> E </b>nergy   <b> M </b>onitoring   <b> S </b>ystem</p>
        <img class="arrow-object" src="Main-layout/img/arrow-object-white.svg" alt="">
</header>
<style>
.breathing 
    {
    -webkit-animation: breathing 1s ease-out infinite normal;
    animation: breathing 1s ease-out infinite normal;
    -webkit-font-smoothing: antialiased;
    }
@-webkit-keyframes breathing {
  0% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
  25% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  60% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
  100% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
}
@keyframes breathing {
  0% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }
  25% {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
  60% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }
  100% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }
}
</style>
    <div class="row" style="margin-top:4%;margin-left:4%;margin-right:4%;">
        <div class="col-sm-4">
            <div style="border: 2px solid #1a1919a6;" class="card card-stats ">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <img class="breathing"  style="width:90%;color:#FFF;" src="Card/img/2.png" alt="">
                    </div>
                    <p class="card-category">TOTAL ENERGY IN THIS MONTH.</p>
                    <h3 id="TotalEnergy" class="card-title">{{$Totalenergy}} Unit</h3>
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
                    <img class="breathing" style="width:90%;color:#FFF;" src="Card/img/3.png" alt="">
                </div>
                    <p class="card-category">REAL-TIME POWER.</p>
                    <h3 id="RealtimePower" class="card-title">{{$Realtimepower/1000}} kW</h3>
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
                        <img class="breathing"  style="width:90%;color:#FFF;" src="Card/img/4.png" alt="">
                    </div>
                    <p class="card-category">ELECTRICITY CHARGE IN THIS MONTH</p>
                    <h3 id="ElectricityCharge" class="card-title">${{$Totalenergy * $Money_rate}} Bath</h3>
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
                <h2 class="text-dark text-size-30 text-m-size-40">{{$companyname}} <b>Overview</b></h2>
                <!-- <hr class="break background-primary break-small break-center margin-bottom-10"> -->
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <button onclick="Daily1()" type="button" class="btn btn-info active" style="margin-right:2px;" >Daily</button>
                    <button onclick="Monthly()" type="button" class="btn btn-danger" style="margin-right:2px;" >Monthly</button>
                    <button onclick="Yearly()" type="button" class="btn btn-primary" style="margin-right:2px;">Yearly</button>
                    <button data-toggle="modal" data-target="#CustomdateOverview" type="button" class="btn btn-success">Custom</button>
                </div>
            </div>
            <!-- Modal Costom date -->
            <div class="modal fade" id="CustomdateOverview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title input100" id="exampleModalLabel" style="color:#16915B;font-size:170%;"><i style="color:#0BFF73;" class="icon-sli-calendar"></i>  Custom Date Overview</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                            <!-- <span aria-hidden="true">&times;</span> -->
                            <!-- </button> -->
                        </div>
                        <div class="modal-body">
                        <div class="container-contact100">
		<div class="wrap-contact100">
			<!-- <form class="contact100-form validate-form"> -->
            <?= Form::open(array('url' => 'EmsOverviewCustomDate','method'=>'get','class'=>'contact100-form validate-form','target' => '_blank')) ?>
                                    
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

				<!-- <div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Phone</span>
					<input class="input100" type="text" name="phone" placeholder="Enter Number Phone">
				</div> -->

				<!-- <div class="wrap-input100 input100-select bg1">
					<span class="label-input100">Needed Services *</span>
					<div>
						<select class="js-select2" name="service">
							<option>Please chooses</option>
							<option>eCommerce Bussiness</option>
							<option>UI/UX Design</option>
							<option>Online Services</option>
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div> -->

				<!-- <div class="w-full dis-none js-show-service">
					<div class="wrap-contact100-form-radio">
						<span class="label-input100">What type of products do you sell?</span>

						<div class="contact100-form-radio m-t-15">
							<input class="input-radio100" id="radio1" type="radio" name="type-product" value="physical" checked="checked">
							<label class="label-radio100" for="radio1">
								Phycical Products
							</label>
						</div>

						<div class="contact100-form-radio">
							<input class="input-radio100" id="radio2" type="radio" name="type-product" value="digital">
							<label class="label-radio100" for="radio2">
								Digital Products
							</label>
						</div>

						<div class="contact100-form-radio">
							<input class="input-radio100" id="radio3" type="radio" name="type-product" value="service">
							<label class="label-radio100" for="radio3">
								Services Consulting
							</label>
						</div>
					</div> -->

					<!-- <div class="wrap-contact100-form-range">
						<span class="label-input100">Budget *</span>

						<div class="contact100-form-range-value">
							$<span id="value-lower">610</span> - $<span id="value-upper">980</span>
							<input type="text" name="from-value">
							<input type="text" name="to-value">
						</div>

						<div class="contact100-form-range-bar">
							<div id="filter-bar"></div>
						</div>
					</div> -->
				<!-- </div> -->

				<!-- <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Please Type Your Message">
					<span class="label-input100">Message</span>
					<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
				</div> -->

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
            <div class="Chart1">
            
                <!-- Graph Power -->
                
                      
                
            
            </div>
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

              function Daily1(){
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

          // Interval Time Total Energy 
          setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGettotalenergy",
                      type: 'GET',   
                      }).done( 
                      function(TotalEnergy) 
                          {
                              console.log("Total Energy: "+TotalEnergy); 
                              document.getElementById("TotalEnergy").innerHTML = TotalEnergy.toFixed(0)+" Unit";      
                          }
                      );
        //   }, 300000);         
          // Interval Time REAL-TIME Power 
        //   setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGetrealtimepower",
                      type: 'GET',   
                      }).done( 
                      function(RealtimePower) 
                          {
                              
                              console.log("RealtimePower: "+RealtimePower/1000); 

                              document.getElementById("RealtimePower").innerHTML = (RealtimePower/1000).toFixed(3)+" kW";      
                          }
                      );
        //   }, 300000);
           // Interval Time Electricity Charge 
        //    setInterval(function () {
                  $.ajax(
                      {
                      url: "/EMSGettotalenergy",
                      type: 'GET',   
                      }).done( 
                      function(ElectricityCharge) 
                          {
                              
                              console.log("ElectricityCharge: "+ElectricityCharge*{{$Money_rate}}); 

                              document.getElementById("ElectricityCharge").innerHTML = "$ "+(ElectricityCharge*{{$Money_rate}}).toFixed(2)+" Bath";      
                          }
                      );
          }, 300000);
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
