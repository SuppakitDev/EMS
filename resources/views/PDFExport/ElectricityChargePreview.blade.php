<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }
    </style>

</head>


<div class="container">

<body class="login-page" style="background: white">

    <div>
        <div class="row">

                <div class="col-xs-1">
                <h4><img  src="Main-layout/img/EMS.png" style="width:75px;"></h4>
                <strong> <b style="margin-left: 15px;">EMS&trade;</b> </strong><br>

            </div>

            <div class="col-xs-3">
                <h5><U style="margin-left: 5px;"><b>{{$C_Name}}</b> Information</U></h5>
                <strong>Company Inc.</strong><br>
                <!-- ADDRESS COMPANY -->
                {{$Address}} <br>
                P: {{$Tel}} <br>
                E: {{$Email}}

                <br>
            </div>

             <div class="col-xs-2">
                <h5><U style="margin-left: 5px;">Installation Information</U></h5>
                <strong>Installation Name.</strong>
                @foreach($Building as $Buildings)
                    
                        <br>{{$Buildings->Build_Name}}
                    
                @endforeach
            </div>

             <div class="col-xs-3">
                <h5><U style="margin-left: 5px;">Account Information</U></h5>
                <strong>Detail.</strong><br>
                <b>Money Rate/Unit:</b>{{$Money_rate}} Bath <br>
                <b>Account:</b>{{$Account}} <br>
                 <b>Information of:</b>{{$Monthshow}} <br>
                 <b>Export at:</b><?php echo date("m/d/Y h:i:s", time());?>
            </div>

             <div class="col-xs-2">
                <h5><U style="margin-left: 5px;">Powered by</U></h5>
                <strong>THAI-TABUCHI ELECTRIC, Inc.</strong><br>
                <img src="https://rebuyersguide.nreca.coop/uploads/listings/28d034d79f9a727a62923da683003094a77bb950.png" style="width:110px;height:45px;" alt="logo">
            </div>
        

            <!-- <div class="col-xs-2">
                <img src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png" alt="logo">
            </div> -->
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <!-- <div class="row">
            <div class="col-xs-6">
                <h4>To:</h4>
                <address>
                    <strong>Andre Madarang</strong><br>
                    <span>andre@andre.com</span> <br>
                    <span>123 Address St.</span>
                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Invoice Num:</th>
                            <td class="text-right">56</td>
                        </tr>
                        <tr>
                            <th> Invoice Date: </th>
                            <td class="text-right">Oct 1, 2018</td>
                        </tr>
                    </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table style="width: 100%; margin-bottom: 20px">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px"><div> Balance Due (CAD) </div></th>
                            <td style="padding: 5px" class="text-right"><strong> $600 </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->

        <table class="table">
            <thead style="background: #F5F5F5;">
                <tr>
                    <th>Qty</th>
                    <th>Department</th>
                    <th></th>
                    <th>Energy</th>
                    <th></th>
                    <th>Money</th>
                </tr>
            </thead>
            <tbody>
             @foreach($DeptName as $DeptNames)
                
                <tr style="padding:4px;">
                        <td style="padding:4px;" >{{$loop->iteration}}</td>
                        <td style="padding:4px;">{{$DeptNames}}</td>
                        <td style="padding:4px;"></td>
              
                            <td style="padding:4px;">{{$Totalenergythisday[$loop->index]}} kWh</td>
                   
                        <td style="padding:4px;"></td>
                       
                            <td style="padding:4px;">{{$Charge[$loop->index]}} Bath</td>
                       
                </tr>
             @endforeach 
            </tbody>
        </table>

            <div class="row">
                <div class="col-xs-6"></div>
                <div class="col-xs-5">
                    <table style="width: 100%">
                        <tbody>
                            <tr class="well" style="padding: 5px">
                                <th style="padding: 5px"><div> Total energy </div></th>
                                <td style="padding: 5px" class="text-right"><strong> {{$SumEnergy}} kWh</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6"></div>
                <div class="col-xs-5">
                    <table style="width: 100%">
                        <tbody>
                            <tr class="well" style="padding: 5px">
                                <th style="padding: 5px"><div> Total money </div></th>
                                <td style="padding: 5px" class="text-right"><strong> {{$SumCharge}} Bath </strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-bottom: 0px">&nbsp;</div>

           
        </div>

 </div>
 <div class="row"> 

<button style="margin-left:5%;" class="btn btn-success" onclick="window.location.href='/filtermember'"> <span class="glyphicon glyphicon-arrow-left"></span> BACK TO HOME</button>

<button style="margin-left:65%;" class="btn btn-danger" onclick="window.location.href='/ElectricityChargeBill_Export?ElectricDepartment={{$DeptID}}&ElectricMonthSelect=2018-12'"> <span class="glyphicon glyphicon-save-file"></span> EXPORT TO PDF</button>
</div>
</div>
</body>
</html>