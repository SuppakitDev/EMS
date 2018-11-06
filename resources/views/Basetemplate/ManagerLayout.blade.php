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
                  <a href="##" >Periodical</a>
                  <ul>
                    <li><a>Daily</a></li>
                    <li><a>Monthly</a></li>
                    <li><a>Yearly</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#Customdate">Custom date</a></li>
                  </ul>
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
                    <li><a>Building 1</a>
                      <ul>
                        <li><a href="\Insidedept">Department1</a></li>
                        <li><a>Department2</a></li>
                        <li><a>Department3</a></li>
                      </ul>
                    </li>
                    <li><a>Building 2</a>
                    <ul>
                        <li><a>Department1</a></li>
                        <li><a>Department2</a></li>
                        <li><a>Department3</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="EmsInformation">Information</a></li>
                <li>
                  <a href="##" >{{ Auth::user()->Fname }}</a>
                  <ul>
                    <li><a>Profile</a></li>
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
                <h5 class="modal-title" id="exampleModalLabel">ExportCsv</h5>
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
    <script type="text/javascript" src="Main-layout/js/responsee.js"></script>
    <script type="text/javascript" src="Main-layout/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="Main-layout/js/template-scripts.js"></script> 
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


  </body>
</html>

