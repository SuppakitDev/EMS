<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2 > EMS CSV EXPORT MONTHLY </h2>
    <h4> MONTH : {{$month}}</h4>
    <h4> DEPARTMENT:</h4>
    @foreach($deptname as $deptnames)
    <td></td><p style="margin-left:50px;" >{{$deptnames->Dept_Name}}</p>
    @endforeach 
    <br>
    <table>
    <thead>
    <tr>
        <th>ID</th>
        <th>C_ID</th>
        <th>B_ID</th>
        <th>D_ID</th>
        <th>Dis_Number</th>
        <th>Dis_Date</th>
        <th>ID1</th>
        <th>Ln1</th>
        <th>Cs1</th>
        <th>Ec1</th>
        <th>Fm1</th>
        <th>Vrms1</th>
        <th>Irms1</th>
        <th>S1</th>
        <th>Q1</th>
        <th>PF1</th>
        <th>Apf1</th>
        <th>Apr1</th>
        <th>Pof1</th>
        <th>Por1</th>
        <th>ID2</th>
        <th>Ln2</th>
        <th>Cs2</th>
        <th>Ec2</th>
        <th>Fm2</th>
        <th>Vrms2</th>
        <th>Irms2</th>
        <th>S2</th>
        <th>Q2</th>
        <th>PF2</th>
        <th>Apf2</th>
        <th>Apr2</th>
        <th>Pof2</th>
        <th>Por2</th>
        <th>ID3</th>
        <th>Ln3</th>
        <th>Cs3</th>
        <th>Ec3</th>
        <th>Fm3</th>
        <th>Vrms3</th>
        <th>Irms3</th>
        <th>S3</th>
        <th>Q3</th>
        <th>PF3</th>
        <th>Apf3</th>
        <th>Apr3</th>
        <th>Pof3</th>
        <th>Por3</th>
        <th>ID4</th>
        <th>Ln4</th>
        <th>Cs4</th>
        <th>Ec4</th>
        <th>Fm4</th>
        <th>Vrms4</th>
        <th>Irms4</th>
        <th>S4</th>
        <th>Q4</th>
        <th>PF4</th>
        <th>Apf4</th>
        <th>Apr4</th>
        <th>Pof4</th>
        <th>Por4</th>
        <th>ID5</th>
        <th>Ln5</th>
        <th>Cs5</th>
        <th>Ec5</th>
        <th>Fm5</th>
        <th>Vrms5</th>
        <th>Irms5</th>
        <th>S5</th>
        <th>Q5</th>
        <th>PF5</th>
        <th>Apf5</th>
        <th>Apr5</th>
        <th>Pof5</th>
        <th>Por5</th>

        <th>Created_at</th>

    </tr>
    </thead>
    <tbody>
@foreach($data as $datas)
        <tr>
            <td>{{$datas->id}}</td>
            <td>{{$datas->C_ID}}</td>
            <td>{{$datas->B_ID}}</td>
            <td>{{$datas->D_ID}}</td>
            <td>{{$datas->Dis_Number}}</td>
            <td>{{$datas->Dis_Date}}</td>
            <td>{{$datas->ID1}}</td>
            <td>{{$datas->Ln1}}</td>
            <td>{{$datas->Cs1}}</td>
            <td>{{$datas->Ec1}}</td>
            <td>{{$datas->Fm1}}</td>
            <td>{{$datas->Vrms1}}</td>
            <td>{{$datas->Irms1}}</td>
            <td>{{$datas->S1}}</td>
            <td>{{$datas->Q1}}</td>
            <td>{{$datas->PF1}}</td>
            <td>{{$datas->Apf1}}</td>
            <td>{{$datas->Apr1}}</td>
            <td>{{$datas->Pof1}}</td>
            <td>{{$datas->Por1}}</td>

            <td>{{$datas->ID2}}</td>
            <td>{{$datas->Ln2}}</td>
            <td>{{$datas->Cs2}}</td>
            <td>{{$datas->Ec2}}</td>
            <td>{{$datas->Fm2}}</td>
            <td>{{$datas->Vrms2}}</td>
            <td>{{$datas->Irms2}}</td>
            <td>{{$datas->S2}}</td>
            <td>{{$datas->Q2}}</td>
            <td>{{$datas->PF2}}</td>
            <td>{{$datas->Apf2}}</td>
            <td>{{$datas->Apr2}}</td>
            <td>{{$datas->Pof2}}</td>
            <td>{{$datas->Por2}}</td>

            <td>{{$datas->ID3}}</td>
            <td>{{$datas->Ln3}}</td>
            <td>{{$datas->Cs3}}</td>
            <td>{{$datas->Ec3}}</td>
            <td>{{$datas->Fm3}}</td>
            <td>{{$datas->Vrms3}}</td>
            <td>{{$datas->Irms3}}</td>
            <td>{{$datas->S3}}</td>
            <td>{{$datas->Q3}}</td>
            <td>{{$datas->PF3}}</td>
            <td>{{$datas->Apf3}}</td>
            <td>{{$datas->Apr3}}</td>
            <td>{{$datas->Pof3}}</td>
            <td>{{$datas->Por3}}</td>

            <td>{{$datas->ID4}}</td>
            <td>{{$datas->Ln4}}</td>
            <td>{{$datas->Cs4}}</td>
            <td>{{$datas->Ec4}}</td>
            <td>{{$datas->Fm4}}</td>
            <td>{{$datas->Vrms4}}</td>
            <td>{{$datas->Irms4}}</td>
            <td>{{$datas->S4}}</td>
            <td>{{$datas->Q4}}</td>
            <td>{{$datas->PF4}}</td>
            <td>{{$datas->Apf4}}</td>
            <td>{{$datas->Apr4}}</td>
            <td>{{$datas->Pof4}}</td>
            <td>{{$datas->Por4}}</td>

            <td>{{$datas->ID5}}</td>
            <td>{{$datas->Ln5}}</td>
            <td>{{$datas->Cs5}}</td>
            <td>{{$datas->Ec5}}</td>
            <td>{{$datas->Fm5}}</td>
            <td>{{$datas->Vrms5}}</td>
            <td>{{$datas->Irms5}}</td>
            <td>{{$datas->S5}}</td>
            <td>{{$datas->Q5}}</td>
            <td>{{$datas->PF5}}</td>
            <td>{{$datas->Apf5}}</td>
            <td>{{$datas->Apr5}}</td>
            <td>{{$datas->Pof5}}</td>
            <td>{{$datas->Por5}}</td>

            <td>{{$datas->created_at}}</td>


        </tr>
@endforeach
    </tbody>
</table>

</body>
</html>
