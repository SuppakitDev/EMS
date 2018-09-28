@extends('Basetemplate.AdminLayout')
<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>


    </style>


@section('content')
<div class="main-inner">
    <div class="container">
      <div class="row">  
        <!-- <div class="span6"> -->
          <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>All Company</h3>
                </div>
              <div class="widget-content">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> NAME </th>
                    <th> DISPLAY </th>
                    <th> TEL </th>
                    <th> MONEY RATE </th>
                    <th> CREATE AT </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> 1 </td>
                    <td> http://www.egrappler.com/ </td>
                    <td> http://www.egrappler.com/ </td>
                    <td> http://www.egrappler.com/ </td>
                    <td> http://www.egrappler.com/ </td>
                    <td> http://www.egrappler.com/ </td>
                    <td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
                  </tr>
                </tbody>
              </table>       
          </div> 
          </div> 
        </div>

@endsection



