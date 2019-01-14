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
                  <h3>Display in {{$Companys->C_name}}</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a href="#AddDisplay" data-toggle="modal" class="btn btn-info" style="height:37px;" >Add Display</a></li>
                  </ul>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="Priority0"> Display_No </th>
                    <th class="Priority1"> Serial </th>
                    <th class="Priority6"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($Display as $Displays)
                  <tr>
                  <td class="Priority0">{{$Displays->Dis_Number}}</td>
                    <td class="Priority1">{{$Displays->SerialNo}}</td>
                    
                    <td class="Priority6">
                    <a href="#EditDisplay{{$Displays->id}}" data-toggle="modal"><img src="Admin-layout/img/document.png" style="width:25px;" ></a>
                    </td>
                    <td class="Priority7">
                    <a href="/RemoveDisplay?ID={{$Displays->id}}" onclick="return confirm('Are you sure? This will remove this Display.')" ><img src="Admin-layout/img/sd-card.png" style="width:25px;" ></a>                    
                    </td>
                  </tr>

                <!-- Modal Edit Display -->
                <div id="EditDisplay{{$Displays->id}}" z-index="-99" role="dialog" class="w3-modal" data-backdrop="false" >
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
                    <header class="w3-container w3-green"> 
                <h2><i class="fa fa-user-plus"></i>Display {{$Displays->Dis_Number}} </h2>
                </header>

                    <form class="w3-container" id="EditDisplay" method="get" action="/EditDisplay" aria-label="{{ __('Register') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="w3-section">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                    <label for="SerialNo">SerialNo</label>
                                <input type="text" class="form-control" name="SerialNo" id="SerialNo" value="{{$Displays->SerialNo}}">
                                    </div>
                                    <div class="col-sm-3">
                                    <label for="Display_No">Display_No</label>
                                <input type="text" class="form-control" name="Display_No" id="Display_No" value="{{$Displays->Dis_Number}}">
                                    </div>
                                </div>

                                
                                <!-- HIDDEN ZONE -->
                                        <input id="C_ID" type="hidden" name="C_ID" value="{{$Companys->id}}" required> 
                                        <input type="hidden" name="ID" value="{{$Displays->id}}">
                                <!-- HIDDEN ZONE -->
                                
                                <div class="form-group">
                                <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->


                                    <div style="margin-top:3%;" class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                    </div>
                                </div>       
                        </div> 
                    </form>
                    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('EditDisplay{{$Displays->id}}').style.display='none'" type="button" style="margin-left:2%;" class="w3-button w3-red pull-right">Cancel</button> 
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal Edit Member -->
                @endforeach
                </tbody>
              </table>

        </div>
      </div>
                   
    </div>
  </div>
  

 <!-- Modal Add Display -->
 <div id="AddDisplay" z-index="-99" role="dialog" class="w3-modal" data-backdrop="false" >
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="width:600px;" >
    <header class="w3-container w3-green"> 
   <h2><i class="fa fa-user-plus"></i> Register new Display! </h2>
  </header>

      <form class="w3-container" id="AddMember" method="POST" action="/AddDisplay" aria-label="{{ __('Register') }}" enctype="multipart/form-data" >
        @csrf
        <div class="w3-section">
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="SerialNo">SerialNo</label>
                <input type="text" class="form-control" name="SerialNo" id="SerialNo" placeholder="Serial_No">
                    </div>
                    <div class="col-sm-3">
                    <label for="Display_No">Display_No</label>
                <input type="text" class="form-control" name="Display_No" id="Display_No" placeholder="Display_No">
                     </div>
                </div>

                 
                <!-- HIDDEN ZONE -->
                        <input id="C_ID" type="hidden" name="C_ID" value="{{$Companys->id}}" required> 
                <!-- HIDDEN ZONE -->
                
                <div class="form-group">
                <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->


                    <div style="margin-top:3%;" class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                     </div>
                </div>       
        </div> 
      </form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('AddDisplay').style.display='none'" type="button" style="margin-left:2%;" class="w3-button w3-red pull-right">Cancel</button> 
      </div>
    </div>
  </div>
</div>
 <!-- Modal Add Member -->
 
 @endforeach
@endsection



