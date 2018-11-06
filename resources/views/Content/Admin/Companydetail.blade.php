@extends('Basetemplate.AdminLayout')
<script src="Admin-layout/js/jquery-1.7.2.min.js"></script> 
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
                  <h3>All Building</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a href="#addbuilding" data-toggle="modal" class="btn btn-success" >Add Building</a></li>
                  </ul>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="Priority0"> ID </th>
                    <th class="Priority1"> NAME </th>
                    <th class="Priority2"> DISPLAY </th>
                    <th class="Priority5"> CREATE AT </th>
                    <th class="td-actions"></th>
                    <th class="td-actions"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($Building as $Buildings) 
               
                  <tr>
                    <td class="Priority0"> {{$Buildings->id}} </td>
                    <td class="Priority1"> {{$Buildings->Build_Name}} </td>
                    <td class="Priority2"> {{$Buildings->Display_list}} </td>
                    <td class="Priority5"> {{$Buildings->created_at}} </td>
                    <td class="Priority6">
                    <a href="#EditBuilding{{$Buildings->id}}" data-toggle="modal"><img src="Admin-layout/img/document.png" style="width:25px;" ></a>
                    </td>
                    <td class="Priority7">
                    <a href="/RemoveBuilding?ID={{$Buildings->id}}" onclick="return confirm('Are you sure? This will remove this Building and child department.')" ><img src="Admin-layout/img/sd-card.png" style="width:25px;" ></a>                    
                    </td>
                    
                  </tr>
          </div>
      </div>
                  </div>
    <!--START MODAL Edit Building-->
      <div class="modal fade" id="EditBuilding{{$Buildings->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:310px;" >
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel">{{$Buildings->Build_Name}}</h5>
              </div>
              <div class="modal-body">
                    <form action="/EditBuilding" method="get" >
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="Build_Name">Build Name</label>
                              <input type="text" class="form-control" name="Build_Name" id="Build_Name" value="{{$Buildings->Build_Name}}">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="Display_list">Display List</label>
                              @foreach($Displaylist as $Displaylists)
                                    <div class="col-md-3">
                                        <div>
                                          <input id="Displaylist{{$Buildings->id}}{{$Displaylists}}" type="checkbox" name="Displaylist[]" 
                                                value="{{$Displaylists}}">
                                                {{$Displaylists}}
                                        </div>
                                    </div>
                              @endforeach
                            </div>
                          </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <?php
            $Displaylistbuilding = [];
            $Displaylistbuilding = explode(",",$Buildings->Display_list);
            
                                            
        ?>
             @foreach($Displaylistbuilding as $Displaylistbuildings )
                @foreach($Displaylist as $Displaylists)
                    @if($Displaylistbuildings == $Displaylists)
                        <script>
                            document.getElementById("Displaylist{{$Buildings->id}}{{$Displaylists}}").checked = true;
                            
                        </script>
                    @endif
                @endforeach
            @endforeach 
            <input type="hidden" name="C_ID" value="{{$companyid}}">
            <input type="hidden" name="ID" value="{{$Buildings->id}}">
                    </form>
                </div>
              </div>
          <!--END MODAL Edit Building-->

                @endforeach
                </tbody>
              </table>       
            </div> 
         <!-- </div>  -->
        </div>


            <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>All Department</h3>
                  <ul class="nav pull-right top-menu" >
                    <li ><a href="#adddepartment" data-toggle="modal" class="btn btn-warning" >Add Department</a></li>
                  </ul>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="Priority0"> ID </th>
                    <!-- <th class="Priority1"> C_ID </th> -->
                    <th class="Priority3"> B_ID </th>
                    <th class="Priority1"> NAME </th>
                    <th class="Priority2"> DISPLAY </th>
                    <th class="Priority5"> CREATE AT </th>
                    <th class="td-actions"></th>
                    <th class="td-actions"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($Dapartment as $Dapartments) 
               
                  <tr>
                    <td class="Priority0"> {{$Dapartments->id}} </td>
                    <td class="Priority1"> {{$Dapartments->B_ID}} </td>
                    <td class="Priority2"> {{$Dapartments->Dept_Name}} </td>
                    <td class="Priority2"> {{$Dapartments->DIS_number}} </td>
                    <td class="Priority5"> {{$Dapartments->created_at}} </td>
                    <td class="Priority6">
                    <a href="#EditDepartment{{$Dapartments->id}}" data-toggle="modal"><img src="Admin-layout/img/document.png" style="width:25px;" ></a>
                    </td>
                    <td class="Priority7">
                    <a href="/RemoveDepartment?ID={{$Dapartments->id}}" onclick="return confirm('Are you sure? This will remove this Department.')" ><img src="Admin-layout/img/sd-card.png" style="width:25px;" ></a>                    
                    </td>
                  </tr>
    </div>
  </div>
                  </div>
      <!--START MODAL Edit Department-->
      <div class="modal fade" id="EditDepartment{{$Dapartments->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:310px;" >
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel">{{$Buildings->Build_Name}}</h5>
              </div>
              <div class="modal-body">
                    <form action="/EditDepartment" method="get" >
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="Build_Name">Department Name</label>
                              <input type="text" class="form-control" name="Dept_Name" id="Dept_Name" value="{{$Dapartments->Dept_Name}}">
                            </div>
                            <div class="form-group">
                                <label for="Buildlist">Building Select</label>
                                <select class="form-control" id="Buildlistedit{{$Dapartments->id}}" name="B_ID" value="" >

                                <option name="B_ID" value="{{$Dapartments->B_ID}}" >{{$Dapartments->B_ID}}</option>
                                  @foreach($Building as $Buildings)
                                    <option name="B_ID" value="{{$Buildings->id}}" >{{$Buildings->Build_Name}}</option>
                                  @endforeach 
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="DIS_number">Display Select</label>
                            <select class="form-control" name="DIS_number" id="DIS_number{{$Dapartments->id}}" value="">
                            <option  value="">Select Display</option>
                            </select>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  
            <input type="hidden" name="C_ID" value="{{$companyid}}">
            <input type="hidden" name="ID" value="{{$Dapartments->id}}">
                    </form>
                </div>
              </div>
              <script type="text/javascript"> 
            $( document ).ready(function() {
              var Buildingidedit{{$Dapartments->id}} = document.getElementById('Buildlistedit{{$Dapartments->id}}').value;
                $.get('/getdisplaylist?Buildingid=' +Buildingidedit{{$Dapartments->id}}, function(data){
                    $('#DIS_number{{$Dapartments->id}}').empty();
                    // console.log(data);
                    $.each(data, function(index, display){
                    $('#DIS_number{{$Dapartments->id}}').append('<option  value="'+display+'">'+display+'</option>');
                        });
                });

            $('#Buildlistedit{{$Dapartments->id}}').on('change',function(e){
                // console.log(e);
                var Buildingidedit{{$Dapartments->id}} = e.target.value;
                $.get('/getdisplaylist?Buildingid=' +Buildingidedit{{$Dapartments->id}}, function(data){
                    $('#DIS_number{{$Dapartments->id}}').empty();
                    // console.log(data);
                    $.each(data, function(index, display){
                    $('#DIS_number{{$Dapartments->id}}').append('<option  value="'+display+'">'+display+'</option>');
                        });
                });
            });

 });
</script> 
          <!--END MODAL Edit Department-->
                @endforeach
                </tbody>
              </table>       
            </div> 
         <!-- </div>  -->
        </div>
        
     </div> 
          
</div>
<!-- MODAL ADD BUILDING -->
<div class="modal fade bd-example-modal-sm" id="addbuilding" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="width:310px;" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mySmallModalLabel">Add Building</h5>
      </div>
      <div class="modal-body">
          <form method="POST"  action="/Addbuilding"class="form-horizontal" role="form">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="B_name">Build Name</label>
                <input type="text" class="form-control" name="B_name" id="B_name" placeholder="Build Name">
              </div>
              <div class="form-group col-md-6">
                <label for="Displaylist">Display List</label>
                                          @foreach($Displaylist as $Displaylists)
                                            <!-- <div class="col-md-3"> -->
                                                <!-- <div> -->
                                                <input id="Displaylist{{$Displaylists}}" type="checkbox" name="Displaylist[]" 
                                                value="{{$Displaylists}}">
                                                {{$Displaylists}}
                                              
                                                <!-- </div> -->
                                                <!-- </div> -->
                                            @endforeach 
              </div>
            </div>
            <input type="hidden" name="C_ID" value="{{$companyid}}">
            <!-- <div class="form-row">
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
            </div> -->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL ADD DEPARTMENT -->
<div class="modal fade bd-example-modal-sm" id="adddepartment" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="width:310px;" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mySmallModalLabel">Add Department</h5>
      </div>
      <div class="modal-body">
          <form method="POST" action="/Adddepartment" class="form-horizontal" role="form">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="Dept_name">Department Name</label>
                <input type="text" class="form-control" name="Dept_name" id="Dept_name" placeholder="Department Name">
              </div>
              <div class="form-group">
                <label for="Buildlist">Building Select</label>
                @foreach($Building as $Buildings)
                @if ($loop->first)
                <select class="form-control" id="Buildlist" name="B_ID" value="{{$Buildings->id}}" >
                @endif
                @endforeach 
                  @foreach($Building as $Buildings)
                    <option name="B_ID" value="{{$Buildings->id}}" >{{$Buildings->Build_Name}}</option>
                  @endforeach 
                </select>
              </div>
              <div class="form-group">
                <label for="Displaylist">Display Select</label>
                <select class="form-control" name="DIS_number" id="Displaylist">
                <option  value="">Select Display</option>
                </select>
              </div>
            </div>
            </div>
            <input type="hidden" name="C_ID" value="{{$companyid}}">     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"> 
 $( document ).ready(function() {

           
              var Buildingid = document.getElementById('Buildlist').value;
                $.get('/getdisplaylist?Buildingid=' +Buildingid, function(data){
                    $('#Displaylist').empty();
                    // console.log(data);
                    $.each(data, function(index, display){
                    $('#Displaylist').append('<option  value="'+display+'">'+display+'</option>');
                        });
                });

            $('#Buildlist').on('change',function(e){
                // console.log(e);
                var Buildingid = e.target.value;
                $.get('/getdisplaylist?Buildingid=' +Buildingid, function(data){
                    $('#Displaylist').empty();
                    // console.log(data);
                    $.each(data, function(index, display){
                    $('#Displaylist').append('<option  value="'+display+'">'+display+'</option>');
                        });
                });
            });

 });
</script>

@endsection



