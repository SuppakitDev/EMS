@extends('Basetemplate.AdminLayout')
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="Admin-theme/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@section('content')

<style>
@media only screen and (min-device-width: 560px) and (max-device-width: 740px) 
{
.Priority4
{
  display:none;
}
.Priority3 
{
  display:none;
}
.Priority4 
{
  display:none;
}
}
@media only screen and (min-device-width: 360px) and (max-device-width: 560px) 
{
.Priority4 
{
  display:none;
}
.Priority3 
{
  display:none;
}
.Priority2 
{
  display:none;
}
.Priority5 
{
  display:none;
}
}

</style>
@foreach($Company as $Companys)
<div class="main-inner">
    <div class="container" style="margin-top:2%;" >
      <div class="row">
        <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>Member in {{$Companys->C_name}}</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a href="#Addmember" data-toggle="modal" class="btn btn-info" style="height:37px;" >Add Member</a></li>
                  </ul>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="Priority0"> Username </th>
                    <th class="Priority1"> First Name </th>
                    <th class="Priority2"> Last Name </th>
                    <th class="Priority3"> Tel </th>
                    <th class="Priority4"> Email </th>
                    <th class="Priority5"> Status </th>
                    <th class="Priority6"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($Member as $Members)
                  <tr>
                  <td class="Priority0">{{$Members->Username}}</td>
                    <td class="Priority1">{{$Members->Fname}}</td>
                    <td class="Priority2">{{$Members->Lname}}</td>
                    <td class="Priority3">{{$Members->Tel}}</td>
                    <td class="Priority4">{{$Members->email}}</td>
                    <td class="Priority5">{{$Members->Status}}</td>
                    <td class="Priority6">
                    <a href="#EditMember{{$Members->id}}" data-toggle="modal"><img src="Admin-layout/img/document.png" style="width:25px;" ></a>
                    </td>
                    <td class="Priority7">
                    <a href="/RemoveMember?ID={{$Members->id}}" onclick="return confirm('Are you sure? This will remove this user.')" ><img src="Admin-layout/img/sd-card.png" style="width:25px;" ></a>                    
                    </td>
                  </tr>

                   <!-- Modal Edit Member -->
 <div id="EditMember{{$Members->id}}" z-index="-99" role="dialog" class="w3-modal" data-backdrop="false" >
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
    <header class="w3-container w3-green"> 
   <h2><i class="fa fa-user-plus"></i> Edit new Member : {{$Members->Fname}} </h2>
  </header>
 
       

      <form class="w3-container"  method="POST" action="/UpdateMember"  enctype="multipart/form-data" >
        @csrf
        <div class="w3-section">
                <div class="form-group">
                    <div class="col-sm-6">

                    <label for="Username"><b>User Name</b></label>
                    <input  type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" name="Username" value="{{$Members->Username}}"  placeholder="Username" required >
                                @if ($errors->has('Username'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Username') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-sm-6">
                    <label for="Fname"><b>First Name</b></label>
                    <input  type="text" class="form-control{{ $errors->has('Fname') ? ' is-invalid' : '' }}" name="Fname" value="{{$Members->Fname}}"  placeholder="First name" required >
                                @if ($errors->has('Fname'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>

                 <div class="form-group">
                 <div class="col-sm-6">
                 <label for="Lname"><b>Last Name</b></label>
                    <input type="text" class="form-control{{ $errors->has('Lname') ? ' is-invalid' : '' }}" name="Lname" value="{{$Members->Lname}}"  placeholder="Last name" required >
                                @if ($errors->has('Lname'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif
                     </div>
                    <div class="col-sm-6">
                    <label for="Tel"><b>Telephone</b></label>
                    <input  type="text" class="form-control{{ $errors->has('Tel') ? ' is-invalid' : '' }}" name="Tel" value="{{$Members->Tel}}"  placeholder="Telephone" required >
                                @if ($errors->has('Tel'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Tel') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>
                        <input  type="hidden" name="ID" value="{{$Members->id}}" required>

                <!-- HIDDEN ZONE -->
                
                        <!-- <input id="B_ID" type="hidden" name="B_ID" value="0" required> -->
                        <!-- <input id="C_ID" type="hidden" name="C_ID" value="{{$Companys->id}}" required> -->
                        <!-- <input id="D_ID" type="hidden" name="D_ID" value="0" required> -->
                        <!-- <input id="Status" type="hidden" name="Status" value="Manager" required> -->
                        <!-- <input id="CreateBy" type="hidden" name="CreateBy" value="{{ Auth::user()->id }}" required>  -->
                <!-- HIDDEN ZONE -->
                
                <div class="form-group">
                    <div class="col-sm-8">
                    <label for="email"><b>Email</b></label>
                    <input  type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$Members->email}}"  placeholder="Email" required >
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                    <!-- <div class="col-sm-6">
                    
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" style="color:red;" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                     </div>
                </div>
                <div class="form-group">
                 <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->

<!-- <div class="col-md-6">
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm-Password" required>
</div> -->
                    <div style="margin-top:3%;" class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                     </div>
                </div>       
        </div> 
      </form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('EditMember{{$Members->id}}').style.display='none'" type="button" style="margin-left:2%;margin-top:5px;" class="w3-button w3-red pull-right">Cancel</button> 
      </div>
    </div>
  </div>
</div>
 <!-- Modal Edit Member -->
 
 @if($errors->all())
        <script>
          $(document).ready(function()
              {
                $("#EditMember{{$Members->id}}").modal();
              });
        </script>
        @endif
                @endforeach
                </tbody>
              </table>

        </div>
      </div>
                   
    </div>
  </div>
  


 <!-- Modal Add Member -->
 <div id="Addmember" z-index="-99" role="dialog" class="w3-modal" data-backdrop="false" >
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
    <header class="w3-container w3-green"> 
   <h2><i class="fa fa-user-plus"></i> Create new Member! </h2>
  </header>
 

      <form class="w3-container" id="AddMember" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" >
        @csrf
        <div class="w3-section">
                <div class="form-group">
                    <div class="col-sm-6">
                    <input id="Username" type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" name="Username" value="{{ old('Username') }}"  placeholder="Username" required >
                                @if ($errors->has('Username'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Username') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-sm-6">
                    <input id="Fname" type="text" class="form-control{{ $errors->has('Fname') ? ' is-invalid' : '' }}" name="Fname" value="{{ old('Fname') }}"  placeholder="First name" required >
                                @if ($errors->has('Fname'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>

                 <div class="form-group">
                 <div class="col-sm-6">
                    <input id="Lname" type="text" class="form-control{{ $errors->has('Lname') ? ' is-invalid' : '' }}" name="Lname" value="{{ old('Lname') }}"  placeholder="Last name" required >
                                @if ($errors->has('Lname'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif
                     </div>
                    <div class="col-sm-6">
                    <input id="Tel" type="text" class="form-control{{ $errors->has('Tel') ? ' is-invalid' : '' }}" name="Tel" value="{{ old('Tel') }}"  placeholder="Telephone" required >
                                @if ($errors->has('Tel'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('Tel') }}</strong>
                                    </span>
                                @endif
                     </div>
                </div>
                <!-- HIDDEN ZONE -->
                        <input id="B_ID" type="hidden" name="B_ID" value="0" required>
                        <input id="C_ID" type="hidden" name="C_ID" value="{{$Companys->id}}" required>
                        <input id="D_ID" type="hidden" name="D_ID" value="0" required>
                        <input id="Status" type="hidden" name="Status" value="Manager" required>
                        <input id="CreateBy" type="hidden" name="CreateBy" value="{{ Auth::user()->id }}" required> 
                <!-- HIDDEN ZONE -->
                
                <div class="form-group">
                    <div class="col-sm-8">
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Email" required >
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color:red;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                    <div class="col-sm-6">
                    
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" style="color:red;" role="alert">
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
      <button onclick="document.getElementById('Addmember').style.display='none'" type="button" style="margin-left:2%;" class="w3-button w3-red pull-right">Cancel</button> 
      </div>
    </div>
  </div>
</div>
@if($errors->all())
        <script>
           $("#AddMember").submit(function()
           {
               $("#Addmember").modal();
            });
       </script>
@endif
 <!-- Modal Add Member -->
 @endforeach
@endsection



