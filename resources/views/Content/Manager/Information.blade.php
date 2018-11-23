@extends('Basetemplate.ManagerLayout')
<link href="Card/material-dashboard.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@section('content')
<header class="section background-image text-center" style="background-image:url(Main-layout/img/BG02-edit.jpg)">       
  <img class="arrow-object" src="Main-layout/img/arrow-object-white.svg" alt="">
</header>
<style>
    @media only screen and (min-device-width: 975px) and (max-device-width: 1199px) 
    {
    .Priority3
    {
      display:none;
    }
    .Priority5
    {
      display:none;
    }
    .Priority8 
    {
      display:none;
    }
    }
    @media only screen and (min-device-width: 375px) and (max-device-width: 975px) 
    {
    .Priority3 
    {
      display:none;
    }
    .Priority5 
    {
      display:none;
    }
    .Priority8 
    {
      display:none;
    }
    .Priority2 
    {
      display:none;
    }
    .Priority9 
    {
      display:none;
    }
    .Priority0
    {
      display:none;
    }
    }
</style>   
<div class=" d-block w-80" style="margin-top:2%;margin-left:2%;margin-right:2%;margin-bottom:2%;height:50%;">
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active ">
      <h3>Information of Display and CT in Company!!</h3> 
    </div>
  @for($i = 0 ; $i <= sizeof($Name)-1 ; $i++)
        <div class="carousel-item ">
        <h3>Build :{{$Name[$i]}}</h3> 
        <table class="table">
      <thead>
        <tr>
          <th class="Priority0" >TimeStamp   </th>
          <th class="Priority1" >DisModel</th>
          <th class="Priority2">Dis_Number</th>
          <th class="Priority3" >DisManufacturing</th>
          <th class="Priority4" >Dis_SerialNo</th>
          <th class="Priority5" >DisFirmware</th>
          <th class="Priority6" >Ct_SerialNo</th>
          <th class="Priority7">CtModel</th>
          <th class="Priority8" >CtManufacturing</th>
          <th class="Priority9" >CtFirmware</th>
        </tr>
      </thead>
      <tbody>
      @foreach($DisplayInfo[$i] as $DisplayInfos)
        <tr>
          <th class="Priority0"  scope="row">{{$DisplayInfos->created_at}}</th>
          <td class="Priority1" >{{$DisplayInfos->DisModel}}</td>
          <td class="Priority2" >{{$DisplayInfos->Dis_Number}}</td>
          <td class="Priority3" >{{$DisplayInfos->DisManufacturing_Date}}</td>
          <td class="Priority4" >{{$DisplayInfos->Dis_SerialNo}}</td>
          <td class="Priority5" >{{$DisplayInfos->DisFirmware_Version}}</td>
          <td class="Priority6" >{{$DisplayInfos->Ct_SerialNo}}</td>
          <td class="Priority7" >{{$DisplayInfos->CtModel}}</td>
          <td class="Priority8" >{{$DisplayInfos->CtManufacturing_Date}}</td>
          <td class="Priority9" >{{$DisplayInfos->CtFirmware_Version}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
        </div>
@endfor
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon"  aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</div>
<!-- </section> -->

@endsection