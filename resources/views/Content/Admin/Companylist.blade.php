@extends('Basetemplate.AdminLayout')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<style>
@media only screen and (min-device-width: 560px) and (max-device-width: 740px) 
{
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
.Priority5 
{
  display:none;
}
}
</style>


@section('content')
<div class="main-inner">
    <div class="container" style="margin-top:2%;" >
      <div class="row">  
        <!-- <div class="span7"> -->
          <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>All Company</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a href="#addcompany" data-toggle="modal" class="btn btn-success" >Add Company</a></li>
                  </ul>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="Priority0"> ID </th>
                    <th class="Priority1"> NAME </th>
                    <th class="Priority2"> DISPLAY </th>
                    <th class="Priority3"> TEL </th>
                    <th class="Priority4"> MONEY RATE </th>
                    <th class="Priority5"> CREATE AT </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($company as $companys) 
                  @if( !$loop->first )
                  <tr>
                    <td class="Priority0"> {{$companys->id}} </td>
                    <td class="Priority1"> {{$companys->C_name}} </td>
                    <td class="Priority2"> {{$companys->Display_list}} </td>
                    <td class="Priority3"> {{$companys->Tel}} </td>
                    <td class="Priority4"> {{$companys->Money_rate}} </td>
                    <td class="Priority5"> {{$companys->created_at}} </td>
                    <td class="td-actions">
                        <a href="/Gotothiscompany?ID={{$companys->id}}"><img src="Admin-layout/img/exit.png" style="width:25px;" ></a>
                        <a href="/Addusertocompany?ID={{$companys->id}}"><img src="Admin-layout/img/add-user.png" style="width:25px;" ></a>
                        <a href="#Company{{$companys->id}}" data-toggle="modal"><img src="Admin-layout/img/document.png" style="width:25px;" ></a>
                        <a > <?= Form::open(array('url' => 'Company/'.$companys->id,'method'=>'DELETE')) ?>
                              <button type="submit" style="padding: 0;border: none;background: none;" onclick="return confirm('Are you sure? This will remove this Company.')" ><img src="Admin-layout/img/sd-card.png" style="width:25px;" ></span></button>
                                {!! Form::close() !!}</a>
                    </td>
                  </tr>
                   <!-- MODAL Edit -->
                   <div class="modal fade" id="Company{{$companys->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:310px;">
                   <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mySmallModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
      <?= Form::open(array('url' => 'Company/'.$companys->id,'method'=>'POST')) ?>
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="C_name">Company Name</label>
                <input type="text" class="form-control" name="C_name" id="C_name" value="{{$companys->C_name}}">
              </div>
              <div class="form-group col-md-6">
                <label for="Latitude">Latitude</label>
                <input type="text" class="form-control" name="Latitude" id="Latitude" value="{{$companys->lat}}">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Longitude">Longitude</label>
                <input type="text" class="form-control"  name="Longitude" id="Longitude" value="{{$companys->lon}}">
              </div>
              <div class="form-group col-md-6">
                <label for="Display_list">Display_list</label>
                <input type="text" class="form-control" name="Display_list" id="Display_list" value="{{$companys->Display_list}}">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Tel">Tel</label>
                <input type="Tel" class="form-control" name="Tel" id="Tel" value="{{$companys->Tel}}">
              </div>
              <div class="form-group col-md-6">
                <label for="Money_rate">Money_rate</label>
                <input type="text" class="form-control" name="Money_rate" id="Money_rate"value="{{$companys->Money_rate}}">
              </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
                  </div>
                  @endif
                @endforeach
                </tbody>
              </table>       
            </div> 
         <!-- </div>  -->
        </div>
        
     </div> 
          
</div>
<!-- MODAL ADD -->
<div class="modal fade bd-example-modal-sm" id="addcompany" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="width:310px;" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mySmallModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
          <form method="POST" action="Company" class="form-horizontal" role="form">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="C_name">Company Name</label>
                <input type="text" class="form-control" name="C_name" id="C_name" placeholder="Company Name">
              </div>
              <div class="form-group col-md-6">
                <label for="Latitude">Latitude</label>
                <input type="text" class="form-control" name="Latitude" id="Latitude" placeholder="Latitude">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Longitude">Longitude</label>
                <input type="text" class="form-control"  name="Longitude" id="Longitude" placeholder="Longitude">
              </div>
              <div class="form-group col-md-6">
                <label for="Display_list">Display_list</label>
                <input type="text" class="form-control" name="Display_list" id="Display_list" placeholder="Display_list">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Tel">Tel</label>
                <input type="Tel" class="form-control" name="Tel" id="Tel" placeholder="Tel">
              </div>
              <div class="form-group col-md-6">
                <label for="Money_rate">Money_rate</label>
                <input type="text" class="form-control" name="Money_rate" id="Money_rate" placeholder="Money_rate">
              </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection



