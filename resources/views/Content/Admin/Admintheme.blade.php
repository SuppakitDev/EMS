@extends('Basetemplate.AdminLayout')
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="Admin-theme/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Admin-theme/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="Admin-theme/css/style.css" rel="stylesheet">
  <link href="Admin-theme/css/style-responsive.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <link rel="stylesheet" type="text/css" href="Admin-theme/lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  @section('content')

  <div class="main-inner">
    <div class="container" style="margin-top:2%;">
      <div class="row">  
        <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>Admin Theme</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a onclick="document.getElementById('CreateAdmin').style.display='block'" class="logout" >Create Admin</a></li>
                  </ul>
                </div>
                <div class="widget-content">

               @foreach($admintheme as $adminthemes)
              <div class="col-lg-3 col-md-3 col-sm-3 mb">
                <div class="content-panel pn">
                  <div id="profile-02">
                    <div class="user">
                      <img src="Admin-theme/img/friends/fr-06.jpg" class="img-circle" width="100">
                      <h4>{{ $adminthemes->Fname }}</h4>
                    </div>
                  </div>
                  <div class="pr2-social centered">
                    <!-- <a href="/adminshow{{$adminthemes->id}}"><i class="fa fa-street-view"></i></a> -->
                    <a onclick="document.getElementById('EditAdmin{{ $adminthemes->id }}').style.display='block'"><i class="fa fa-user-circle-o"></i></a>
                    <a href="/adminremove{{$adminthemes->id}}"><i class="fa fa-trash-o"></i></a>
                  </div>
                </div>
              </div> 

              <!-- Modal Edit Admin Profile -->
              <div id="EditAdmin{{ $adminthemes->id }}" z-index="-99" role="dialog" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
                  <header class="w3-container w3-green"> 
                      <h2><i class="fa fa-address-card"></i> Edit Admin Profile</h2>
                  </header>
 
                 
                  <form class="w3-container"  action="EmsAdminProfile/{{ $adminthemes->id }}"  method="PUT" enctype="multipart/form-data" >
                      @csrf
                    <!-- <div class="w3-section"  > -->
                        <div class="form-group" style="margin-top:5%;" >
                          <div class="col-sm-6" >
                              <input id="Username" type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" name="Username" value="{{ $adminthemes->Username }}"  placeholder="{{ $adminthemes->Username }}" required autofocus>
                                <!-- @if ($errors->has('Username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Username') }}</strong>
                                    </span>
                                @endif -->
                          </div>
                        <div class="col-sm-6">
                              <input id="Fname" type="text" class="form-control{{ $errors->has('Fname') ? ' is-invalid' : '' }}" name="Fname" value="{{ $adminthemes->Fname }}"  placeholder="{{ $adminthemes->Fname }}" required autofocus>
                                <!-- @if ($errors->has('Fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                                @endif -->
                          </div>
                      </div>

                 <div class="form-group">
                 <div class="col-sm-6">
                    <input id="Lname" type="text" class="form-control{{ $errors->has('Lname') ? ' is-invalid' : '' }}" name="Lname" value="{{ $adminthemes->Lname }}"  placeholder="{{ $adminthemes->Lname }}" required autofocus>
                                <!-- @if ($errors->has('Lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif -->
                     </div>
                    <div class="col-sm-6">
                    <input id="Tel" type="text" class="form-control{{ $errors->has('Tel') ? ' is-invalid' : '' }}" name="Tel" value="{{ $adminthemes->Tel }}"  placeholder="{{ $adminthemes->Tel }}" required autofocus>
                                <!-- @if ($errors->has('Tel'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Tel') }}</strong>
                                    </span>
                                @endif -->
                     </div>
                </div>
                <!-- HIDDEN ZONE -->
                        <input id="B_ID" type="hidden" name="B_ID" value="{{ $adminthemes->B_ID }}" required>
                        <input id="C_ID" type="hidden" name="C_ID" value="{{ $adminthemes->C_ID }}" required>
                        <input id="D_ID" type="hidden" name="D_ID" value="{{ $adminthemes->D_ID }}" required>
                        <input id="Status" type="hidden" name="Status" value="{{ $adminthemes->Status }}" required>
                        <input id="CreateBy" type="hidden" name="CreateBy" value="{{ $adminthemes->CreateBy }}" required> 
                <!-- HIDDEN ZONE -->
                <div class="form-group">
                    <div class="col-sm-8">
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $adminthemes->email }}"  placeholder="{{ $adminthemes->email }}" required >
                                <!-- @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif -->
                    </div>
                    
              </div>
              <div style="margin-top:3%;" class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                     </div>
            </form>
          
              <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('EditAdmin{{ $adminthemes->id }}').style.display='none'" type="button" style="margin-left:2%;" class="w3-button w3-red pull-right">Cancel</button> 
      
      
   
            </div>

        </div>
      </div>
    </div>
              <!-- Modal Edit Admin Profile -->

              @endforeach
  
        </div>
     </div> 
    </div>       
  </div>
        @if($errors->all())
        <script>
          $(document).ready(function()
              {
                $("#CreateAdmin").modal();
              });
        </script>
        @endif
 <!-- Modal Add admin -->
 <div id="CreateAdmin" z-index="-99" role="dialog" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
    <header class="w3-container w3-green"> 
   <h2><i class="fa fa-user-plus"></i> Create new Admin!</h2>
  </header>
 

      <form class="w3-container"  method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" >
        @csrf
        <div class="w3-section">
                <div class="form-group">
                    <div class="col-sm-6">
                    <input id="Username" type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" name="Username" value="{{ old('username') }}"  placeholder="Username" required autofocus>
                                @if ($errors->has('Username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Username') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-sm-6">
                    <input id="Fname" type="text" class="form-control{{ $errors->has('Fname') ? ' is-invalid' : '' }}" name="Fname" value="{{ old('Fname') }}"  placeholder="First name" required autofocus>
                                @if ($errors->has('Fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>

                 <div class="form-group">
                 <div class="col-sm-6">
                    <input id="Lname" type="text" class="form-control{{ $errors->has('Lname') ? ' is-invalid' : '' }}" name="Lname" value="{{ old('Lname') }}"  placeholder="Last name" required autofocus>
                                @if ($errors->has('Lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif
                     </div>
                    <div class="col-sm-6">
                    <input id="Tel" type="text" class="form-control{{ $errors->has('Tel') ? ' is-invalid' : '' }}" name="Tel" value="{{ old('Tel') }}"  placeholder="Telephone" required autofocus>
                                @if ($errors->has('Tel'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Tel') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>
                <!-- HIDDEN ZONE -->
                        <input id="B_ID" type="hidden" name="B_ID" value="1" required>
                        <input id="C_ID" type="hidden" name="C_ID" value="1" required>
                        <input id="D_ID" type="hidden" name="D_ID" value="1" required>
                        <input id="Status" type="hidden" name="Status" value="ADMIN" required>
                        <input id="CreateBy" type="hidden" name="CreateBy" value="0" required> 
                <!-- HIDDEN ZONE -->
                
                <div class="form-group">
                    <div class="col-sm-8">
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Email" required >
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                    <div class="col-sm-6">
                    
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

@if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif
                     </div>
                </div>
                <div class="form-group">
                <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->

<div class="col-md-6">
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm-Password" required>
</div>
                    <div style="margin-top:3%;" class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                     </div>
                </div>
                
        </div>
        
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('CreateAdmin').style.display='none'" type="button" style="margin-left:2%;" class="w3-button w3-red pull-right">Cancel</button> 
      
      
   
      </div>

    </div>
  </div>
</div>
 <!-- Modal Add admin -->

@endsection

  <script src="Admin-theme/lib/jquery/jquery.min.js"></script>
  <script src="Admin-theme/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="Admin-theme/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="Admin-theme/lib/jquery.scrollTo.min.js"></script>
  <script src="Admin-theme/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="Admin-theme/lib/common-scripts.js"></script>
  <script src="Admin-theme/lib/advanced-form-components.js"></script>
  <script type="text/javascript" src="Admin-theme/lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script src="Admin-theme/lib/jquery-ui-1.9.2.custom.min.js"></script>


