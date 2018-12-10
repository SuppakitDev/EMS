<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EMS</title>
    <link rel="icon" href="{!! asset('Main-layout\img\EMS.png') !!}"/>
    <link rel="stylesheet" href="Main-layout/css/components.css">
    <link rel="stylesheet" href="Main-layout/css/icons.css">
    <link rel="stylesheet" href="Main-layout/css/responsee.css">
    <link rel="stylesheet" href="Main-layout/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="Main-layout/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- CUSTOM STYLE -->      
    <link rel="stylesheet" href="Main-layout/css/template-style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,700,900&amp;subset=latin-ext" rel="stylesheet"> 
    <!-- <script type="text/javascript" src="Main-layout/js/jquery-1.8.3.min.js"></script> -->
    <!-- <script type="text/javascript" src="Main-layout/js/jquery-ui.min.js"></script>    -->

    <link href="Form-login/css/style.css" rel="stylesheet" type="text/css" />
    <!-- /custom style sheet -->
    <!-- fontawesome css -->
    <link href="Form-login/css/fontawesome-all.css" rel="stylesheet" />
    <!-- /fontawesome css -->
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
  </head>
 
  <body class="size-1280">
    <!-- HEADER -->
    <header role="banner" class="position-absolute">    
      <!-- Top Navigation -->
      <nav class="background-transparent background-primary-dott full-width sticky">          
        <div class="top-nav"> 
          <!-- mobile version logo -->              
          <div class="logo hide-l hide-xl hide-xxl">
             <a href="/filtermember" class="logo">
              <!-- Logo White Version -->
              <img class="logo-white" src="Main-layout/img/EMS3.png" alt="">
              <!-- Logo Dark Version -->
              <img class="logo-dark" src="Main-layout/img/EMS3.png" alt="">
            </a>
          </div>                  
          <p class="nav-text"></p>
          
          <!-- left menu items -->
          <div class="top-nav left-menu">
             <ul class="right top-ul chevron">
                <!-- <li><a href="##">Periodical</a></li> -->
                <li>
                  <a href="/filtermember" >Home</a>
                  <!-- <ul>
                    <li><a>Daily</a></li>
                    <li><a>Monthly</a></li>
                    <li><a>Yearly</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#Customdate">Custom date</a></li>
                  </ul> -->
                </li>
                <li><a href="#" data-toggle="modal" data-target="#Exportbill">Electric charge</a></li>
                <li><a href="#" data-toggle="modal" data-target="#ExportCsv">CSV Export</a></li>
             </ul>
          </div>
          
          <!-- logo -->
          <ul class="logo-menu">
            <a href="/filtermember" class="logo">
              <!-- Logo White Version -->
              <img class="logo-white" src="Main-layout/img/EMS3.png" alt="">
              <!-- Logo Dark Version -->
              <img class="logo-dark" src="Main-layout/img/EMSNT.png" alt="">
            </a>
          </ul>
          
          <!-- right menu items -->
          <div class="top-nav right-menu">
             <ul class="top-ul chevron">
                <li>
                  <a href="##" >Site Detail</a>
                  <ul>
                    @foreach($Building as $Buildings)
                    <li><a>{{$Buildings->Build_Name}}</a>
                      <ul>
                      @foreach($Department as $Departments)
                          @if($Departments->B_ID == $Buildings->id)
                            <li style="width:100px;" ><a href="\Insidedept?Deptid={{$Departments->id}}">{{$Departments->Dept_Name}}</a></li>
                          @endif
                      @endforeach
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                </li>
                <li><a href="EmsInformation">Information</a></li>
                <li>
                  <a href="##" >{{ Auth::user()->Fname }}</a>
                  <ul>
                    <li><a data-toggle="modal" data-target="#exampleModal" >Profile</a></li>
                    <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                  </ul>
                </li>
             </ul> 
          </div>
        </div>
      </nav>
    </header>
    <!-- MAIN -->
    <main role="main">    
      <!-- Header -->
      @yield('content')
    </main>

    <!-- Modal Zone -->
        <!-- Modal Export Bill -->
        <div class="modal fade" id="Exportbill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Electric charge</h5>
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

        <!-- Modal Costom date -->
        <div class="modal fade" id="Customdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customdate</h5>
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

         <!-- Modal Export CSV -->
         <div class="modal fade" id="ExportCsv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size:20px;font-weight:bold;">ExportCsv</h5>
              </div>
              <div class="modal-body">
              
    	<div class="row">
			<div class="col-md-12 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
            <!-- Script ฝากไว้ที่ไฟล์ C:\xampp\htdocs\EMS\public\Main-layout\js\template-scripts.js -->
            <!-- CSS ฝากไว้ที่ไฟล์ C:\xampp\htdocs\EMS\public\Main-layout\css\icons.css -->
							<div class="col-3">
								<a href="#" class="active" id="Daily-link">Daily</a>  
							</div>
							<div class="col-3">
								<a href="#" id="Monthly-link">Monthly</a>
							</div>
              <div class="col-3">
								<a href="#" id="Yearly-link">Yearly</a>
							</div>
              <div class="col-3">
								<a href="#" id="Customrange-link">Custom range</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
                <!-- Form Daily -->
								<form id="Daily-form" action="/CsvExportDaily" method="post" role="form" style="display: block;">
									<div class="form-group">
                  <label for="DayDepartment" style="color:black;font-weight:bold;margin:2% 0% 0% 2%;">Select Department <p>(Choose more than one option.)</p></label><br>
                    @foreach($Department as $Departments)
                    <input type="checkbox" id="DayDepartment" name="DayDepartment" value="{{$Departments->Dept_Name}}" style="margin-left:3%"> {{$Departments->Dept_Name}} 
                    @endforeach
									</div>
                  <div class="form-group">
                  <label for="DaySelect" style="color:black;font-weight:bold;margin:2% 0% 2% 2%;">Select Date</label><br>
										<input type="date" name="DaySelect" id="DaySelect" tabindex="1" class="form-control" placeholder="SelectDate" value="">
									</div>
									<div class="form-group">
										<div class="row" >
											<div class="col-sm-6 col-sm-offset-6 " >
												<input type="submit"  tabindex="4" class="form-control  btn btn-success" value="EXPORT DAILY" style="margin-left:50%;">
											</div>
										</div>
									</div>
                </form>
                <!-- Form Monthly -->
								<form id="Monthly-form" action="/CsvExportMonthly" method="post" role="form" style="display: none;">
                  <div class="form-group">
                  <label for="MonthDepartment" style="color:black;font-weight:bold;margin:2% 0% 0% 2%;">Select Department <p>(Choose more than one option.)</p></label><br>
                    @foreach($Department as $Departments)
                    <input type="checkbox" id="MonthDepartment" name="MonthDepartment" value="{{$Departments->Dept_Name}}" style="margin-left:3%"> {{$Departments->Dept_Name}} 
                    @endforeach
									</div>
                  <div class="form-group">
                  <label for="MonthSelect" style="color:black;font-weight:bold;margin:2% 0% 2% 2%;">Select Month</label><br>
										<input type="month" name="MonthSelect" id="MonthSelect" tabindex="1" class="form-control" placeholder="SelectMonth" value="">
									</div>
									<div class="form-group">
										<div class="row" >
											<div class="col-sm-6 col-sm-offset-6 " >
												<input type="submit"  tabindex="4" class="form-control  btn btn-info" value="EXPORT MONTHLY" style="margin-left:50%;">
											</div>
										</div>
									</div>
                </form>
                <!-- Form Yearly -->
								<form id="Yearly-form" action="/CsvExportYearly" method="post" role="form" style="display: none;">
									<div class="form-group">
                  <label for="YearDepartment" style="color:black;font-weight:bold;margin:2% 0% 0% 2%;">Select Department <p>(Choose more than one option.)</p></label><br>
                    @foreach($Department as $Departments)
                    <input type="checkbox" id="YearDepartment" name="YearDepartment" value="{{$Departments->Dept_Name}}" style="margin-left:3%"> {{$Departments->Dept_Name}} 
                    @endforeach
									</div>
                  <div class="form-group">
                  <label for="YearSelect" style="color:black;font-weight:bold;margin:2% 0% 2% 2%;">Select Year</label><br>
                  <input type="number"  name="YearSelect"   class="form-control" min="2017" value="2018" max="2100"><br>
									</div>
									<div class="form-group">
										<div class="row" >
											<div class="col-sm-6 col-sm-offset-6 " >
												<input type="submit"  tabindex="4" class="form-control  btn btn-danger" value="EXPORT Yearly" style="margin-left:50%;">
											</div>
										</div>
									</div>
                </form>
                <!-- Form Customrange -->
								<form id="Customrange-form" action="/CsvExportCustomdate" method="post" role="form" style="display: none;">
									<div class="form-group">
                  <label for="CusDepartment" style="color:black;font-weight:bold;margin:2% 0% 0% 2%;">Select Department <p>(Choose more than one option.)</p></label><br>
                    @foreach($Department as $Departments)
                    <input type="checkbox" id="CusDepartment" name="CusDepartment" value="{{$Departments->Dept_Name}}" style="margin-left:3%"> {{$Departments->Dept_Name}} 
                    @endforeach
									</div>
                  <div class="form-group">
                  <label for="CusSelectStart" style="color:black;font-weight:bold;margin:2% 0% 2% 2%;">Select Date</label><br>
										<input type="date" name="CusSelectStart" id="CusSelectStart" tabindex="1" class="form-control" placeholder="SelectStartDate" value="">
									</div>
                  <div class="form-group">
                  <label for="CusSelectStop" style="color:black;font-weight:bold;margin:2% 0% 2% 2%;">Select Date</label><br>
										<input type="date" name="CusSelectStop" id="CusSelectStop" tabindex="1" class="form-control" placeholder="SelectStopDate" value="">
									</div>
									<div class="form-group">
										<div class="row" >
											<div class="col-sm-6 col-sm-offset-6 " >
												<input type="submit"  tabindex="4" class="form-control  btn btn-warning" value="EXPORT CUSTOM RANGE" style="margin-left:50%;">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

              </div>
              <div class="modal-footer">
                  <div class="col-4">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success">Save changes</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
    <!-- Modal Zone -->

    <!-- FOOTER -->
    <footer>
      <!-- Social -->
      <div class="background-primary padding text-center">
        <a href="/"><i class="icon-facebook_circle text-size-25 text-dark"></i></a> 
        <a href="/"><i class="icon-twitter_circle text-size-25 text-dark"></i></a>
        <a href="/"><i class="icon-google_plus_circle text-size-25 text-dark"></i></a>
        <a href="/"><i class="icon-instagram_circle text-size-25 text-dark"></i></a> 
        <a href="/"><i class="icon-linked_in_circle text-size-25 text-dark"></i></a>                                                                       
      </div>
      <!-- Main Footer -->
      <section class="section background-dark">
        <div class="line"> 
          <div class="margin2x">
            <div class="s-12 m-6 l-3 xl-5">
               <h4 class="text-white text-strong">Our Mission</h4>
               <p>
               Thai Tabuchi Electric Co.,Ltd are recognized as a leader in manufacturing of transformer and power supply unit. We produce the products according to customer specification which meet the latest safety standard. Our products are using in Audio system, Air conditioner, Microwave Oven, Battery Chargers and Power Adaptors and many more. We are supplied Switching transformer, High voltage transformer, Switching power supply unit and Mobile phone charger.
                 <!-- <b class="text-size-20">Veri fastidii consectetuer</b> ius in, eum alii dicunt omnium eu. Wisi nostrud equidem ut usu. <b class="text-size-20">Deleniti pertinacia eu est</b>, te his soluta quaestio pericula. -->
               </p>
            </div>
            <div class="s-12 m-6 l-3 xl-2">
               <h4 class="text-white text-strong margin-m-top-30">Useful Links</h4>
               <a class="text-primary-hover" href="page.html">FAQ</a><br>      
               <a class="text-primary-hover" href="contact.html">Contact Us</a><br>
               <a class="text-primary-hover" href="blog.html">Blog</a>
            </div>
            <div class="s-12 m-6 l-3 xl-2">
               <h4 class="text-white text-strong margin-m-top-30">Powered by</h4>
               <a class="text-primary-hover" href="page.html">THAI TABUCHI</a><br>
               <a class="text-primary-hover" href="page.html">Resert and development department</a><br>
               <!-- <a class="text-primary-hover" href="page.html">Disclaimer</a> -->
            </div>
            <div class="s-12 m-6 l-3 xl-3">
               <h4 class="text-white text-strong margin-m-top-30">Contact Us</h4>
                <p><i class="icon-sli-screen-smartphone text-primary"></i> 038538982-6</p>
                <a class="text-primary-hover" href="mailto:contact@sampledomain.com"><i class="icon-sli-mouse text-primary"></i> Fax. 038538303</a><br>
                <a class="text-primary-hover" href="www.thai-tabuchi.co.th"><i class="icon-sli-mouse text-primary"></i> www.thai-tabuchi.co.th</a>
            </div>
          </div>  
        </div>    
      </section>
      <div class="background-dark">
         <div class="line">
            <hr class="break margin-top-bottom-0" style="border-color: #777;">
         </div>
      </div>
      <!-- Bottom Footer -->
      <section class="padding-2x background-dark full-width">
        <div class="line">
          <div class="s-12 l-6">
            <p class="text-size-12">Copyright 2018, By Afterclap</p>
            <p class="text-size-12">All images have been purchased from Bigstock. Do not use the images in your website.</p>
          </div>
          <div class="s-12 l-6">
            <a class="right text-size-12 text-primary-hover" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding<br> by Afterclap</a>
          </div>
        </div>  
      </section>
    </footer>

    <!-- Modal Edit profile -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Profile Editor {{ Auth::user()->Username}}</h5>
           
          </div>
          <div class="modal-body">
          <div class="container">
    
	<div class="row">
      <!-- left column -->
      <div class="col-md-4">
        <div class="text-center">
        <?= Form::open(array('url'=> 'Profile/'.Auth::user()->id, 'method' => 'POST','files' => true)) ?>
        {{ method_field('PUT') }}
          {{ csrf_field() }}
          <img src="/Img/profiles/resize/{{ Auth::user()->image}}"  style="border-radius: 50%;margin:auto;width:60%;" >

          <br>
        
          <input type="file" name="image" >
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-8 personal-info"  >
        <h3>Personal info</h3>
        
       
        <div class="row">
            <div class="form-group">
              <label class="col-lg-6 control-label">First name:</label>
              <div class="col-lg-12">
                <input class="form-control" type="text" name="Fname" value="{{ Auth::user()->Fname}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-6 control-label">Last name:</label>
              <div class="col-lg-12">
                <input class="form-control" type="text" name="Lname" value="{{ Auth::user()->Lname}}">
              </div>
            </div>
        </div>
        <div class="row">
        <div class="form-group">
            <label class="col-md-6 control-label">Username:</label>
            <div class="col-md-12">
              <input class="form-control" type="text" name="Username" value="{{ Auth::user()->Username}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-6 control-label">Email:</label>
            <div class="col-lg-12">
              <input class="form-control" type="text" name="email" value="{{ Auth::user()->email}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-md-6 control-label">Telephone:</label>
            <div class="col-md-12">
              <input class="form-control" type="text" name="Tel"  value="{{ Auth::user()->Tel}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <!-- <label class="col-md-6 control-label">Password:</label> -->
            <div class="col-md-12">
              <!-- <input  class="form-control" type="password" value="11111122333"> -->
              <input type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2" value="Changes password">
            </div>
          </div>
        
          </div>
          <div class="form-group">
            @if (count($errors) > 0)
            <script>
            $(document).ready(function()
              {
                $("#exampleModal").modal();
              });
            </script>
            <div class="alert alert-warning">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" data-dismiss="modal" value="Cancel">
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>

          </div>
       
        </div>
      </div>
    </div>
 <!-- Modal Edit profile -->

 <!-- Modal change password -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
      </div>
      <div class="modal-body">
      @if (count($errors) > 0)
      <div class="alert alert-warning">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
      @endif
      <?= Form::open(array('url'=> 'Changepass/'.Auth::user()->id, 'method' => 'PUT','files' => true)) ?>
          {{ csrf_field() }}
        <div class="form-group">
            <label class="col-md-6 control-label">Current Password:</label>
            <div class="col-md-12">
              <input class="form-control" name="current-password" type="password" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12 control-label">Password:</label>
            <div class="col-md-12">
              <input class="form-control" type="password" name="password" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12 control-label">Confirm password:</label>
            <div class="col-md-12">
              <input class="form-control" type="password" name="password_confirmation" value="">
            </div>
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Change password</button>
      </div>
         {!! Form::close() !!}
    </div>
  </div>

</div>
 <!-- Modal change password -->
 @include('sweet::alert')
    <script type="text/javascript" src="Main-layout/js/responsee.js"></script>
    <script type="text/javascript" src="Main-layout/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="Main-layout/js/template-scripts.js"></script> 
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>
</html>

