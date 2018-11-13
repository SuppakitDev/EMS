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
    <script type="text/javascript" src="Main-layout/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Main-layout/js/jquery-ui.min.js"></script>   

    <link href="Form-login/css/style.css" rel="stylesheet" type="text/css" />
    <!-- /custom style sheet -->
    <!-- fontawesome css -->
    <link href="Form-login/css/fontawesome-all.css" rel="stylesheet" />
    <!-- /fontawesome css -->
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  </head>
 
  <body class="size-1280">
    <!-- HEADER -->
    <header role="banner" class="position-absolute">    
      <!-- Top Navigation -->
      <nav class="background-transparent background-primary-dott full-width sticky">          
        <div class="top-nav"> 
          <!-- mobile version logo -->              
          <div class="logo hide-l hide-xl hide-xxl">
             <a href="index.html" class="logo">
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
                <!-- <li><a href="index.html">Menu1</a></li>
                <li><a href="about-us.html">Menu2</a></li>
                <li><a href="services.html">Menu3</a></li> -->
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
                <!-- <li>
                  <a href="##" >Menu4</a>
                  <ul>
                    <li><a>Product 1</a></li>
                    <li><a>Product 2</a></li>
                  </ul>
                </li> -->
                <!-- <li><a href="gallery.html">Gallery</a></li>
                <li><a href="contact.html">Contact</a></li> -->
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <!-- <li><a href="{{ url('/home') }}">Home</a></li> -->
                    @else
                    <!-- <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li> -->
                    @endauth
                </div>
                @endif
             </ul> 
          </div>
        </div>
      </nav>
    </header>
    
    <!-- MAIN -->
    <main role="main">    
      <!-- Header -->
      <header class="section-top-padding background-image text-center" style="background-image:url(Main-layout/img/BG/BG02-edit.jpg)">
      <div class="container"  >
  <div class="row">
  <div class="col" id="login" style="margin-top:10%;">
  <div class=" w3l-login-form">
        <!-- <h2>Login Here</h2> -->
        @if (Route::has('login'))
          @auth
            <form method="get" action="/filtermember">
                <button style="background-color:#F26C66;" type="submit">Go to Dashboard!!</button>
            </form>
          @else
        <form method="POST" action="{{ route('login') }}">
                        @csrf

            <div class="w3l-form-group">
                <!-- <p>Username:</p> -->
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input style="background-color: #fff0;border-color:#fff0;color:#FFF;" placeholder="Username" id="Username" type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" name="Username" value="{{ old('Username') }}" required>
                    
                                @if ($errors->has('Username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Username') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>
            <div class="w3l-form-group">
                <!-- <label>Password:</label> -->
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input style="background-color: #fff0;border-color:#fff0;color:#FFF;" placeholder="Password"  id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>
            <!-- <div class="forgot">
                <a href="#">Forgot Password?</a>
                <p><input type="checkbox">Remember Me</p>
            </div> -->
            <button type="submit">Login</button>
        </form>
        @endauth
        <!-- <p class=" w3l-register-p">Don't have an account?<a href="#" class="register"> Register</a></p> -->
    </div>
    </div>
    @endif
    <div id="intro" class="col-8">
        <h1 class="text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1 margin-bottom-40 margin-top-130">
          Energy Monitoring System
        </h1>
        <p class="text-white">EMS is a system to monitor the amount of electrical energy used in buildings. The goal is to reduce unnecessary energy consumption.</p>
        <i class="slow icon-sli-arrow-down text-white margin-top-20 text-size-16"></i>
        <!-- Image -->
        <img class="margin-top-20 center" style="width:70%;" src="Main-layout/img/app2.png" alt="">
        <!-- <img class="margin-top-20 center"  src="Main-layout/img/app.png" alt=""> -->
        
        <!-- dark full width arrow object -->
        
        </div>
  </div>
  <img class="arrow-object" src="Main-layout/img/arrow-object-dark.svg" alt="">
      </header>
      
      <!-- Section 1 -->
      <section class="section-small-padding background-dark text-center">      
        <div class="line">
          <div class="m-10 l-6 xl-4 center">
            <div class="margin">
              <!-- <a class="s-12 m-6 margin-s-bottom" href="/">
                <img class="full-img right" src="Main-layout/img/google-play.svg" alt="">
              </a>
              <a class="s-12 m-6" href="/">
                <img class="full-img" src="Main-layout/img/app-store.svg" alt="">
              </a> -->
              <p class="text-white">EMS is a system to monitor the amount of electrical energy used in buildings. The goal is to reduce unnecessary energy consumption.</p>
            </div>
          </div>                                                                                               
        </div>       
      </section>
  
    </main>

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
    <script type="text/javascript" src="Main-layout/js/responsee.js"></script>
    <script type="text/javascript" src="Main-layout/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="Main-layout/js/template-scripts.js"></script> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

