<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
//$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

$input = json_decode(file_get_contents('php://input'),true);

// connect to the mysql database
$link = mysqli_connect('localhost', 'root', '', 'ems_project');
mysqli_set_charset($link,'utf8');
 

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;



$DIS_date;
 
// escape the columns and values from the input object
// $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
// $values = array_map(function ($value) use ($link) {
//   if ($value===null) return null;
//   return mysqli_real_escape_string($link,(string)$value);
// },array_values($input));

 
// build the SET part of the SQL command
// $set = '';
// for ($i=0;$i<count($columns);$i++) {
//   $set.=($i>0?',':'').'`'.$columns[$i].'`=';
//   $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
// }
 
// create SQL based on HTTP method

     
switch ($method) 
{
  case 'PUT':
  {
      $sql = "update `$table` set $set where id=$key"; break;
  }
  case 'GET':
  {
      $TAG = $_GET['TAG'];

      if($TAG == '2')
        {

            /*** get data information ***/
          	// $ID =  $_GET['ID'];
          	// $Logging_time_stamp =  $_GET['Logging_time_stamp'];
            $DIS_number = $_GET['DIS_number'];
            $Model_Code_of_DIS = $_GET['Model_DIS'];
            $Manufacturing_date_of_DIS = $_GET['Manufact_DIS'];
            $Serial_number_of_DIS = $_GET['Serial_DIS'];
            $Firmware_version_of_DIS =  $_GET['Firmware_DIS'];
            $Model_Code_of_CT =  $_GET['Model_CT'];
            $Manufacturing_date_of_CT =  $_GET['Manufact_CT'];
            $Serial_number_of_CT =  $_GET['Serial_CT'];
            $Firmware_version_of_CT =  $_GET['Firmware_CT'];

            /*** Insert value ***/
            $sql = "INSERT INTO ems_information (
            ID,
            DIS_number,
            Model_Code_of_DIS,
            Manufacturing_date_of_DIS,
            Serial_number_of_DIS,
            Firmware_version_of_DIS,
            Model_Code_of_CT,
            Manufacturing_date_of_CT,
            Serial_number_of_CT,
            Firmware_version_of_CT)
            VALUES (
            '$ID',
            '$DIS_number',
            '$Model_Code_of_DIS',
            '$Manufacturing_date_of_DIS',
            '$Serial_number_of_DIS',
            '$Firmware_version_of_DIS',
            '$Model_Code_of_CT',
            '$Manufacturing_date_of_CT',
            '$Serial_number_of_CT',
            '$Firmware_version_of_CT')"; 
            break;
        }
        else
        {

        }


        if($TAG == '1')
        {


            $InsName = $_GET['InsName'];
            $DIS_number =  $_GET['DIS_number'];
            $DIS_serialno =  $_GET['DIS_serialno'];
            $DIS_date = $_GET['DIS_date'];
            $Department_Name =  $_GET['Department_Name'];
            $ID1 =  $_GET['ID1'];
            $Ln1 =  $_GET['Ln1'];
            $Cs1 =  $_GET['Cs1'];
            $Ec1 =  $_GET['Ec1'];
            $Fm1 =  $_GET['Fm1'];
            $Vrms1 =  $_GET['Vrms1'];
            $Irms1 =  $_GET['Irms1'];
            $S1 =  $_GET['S1'];
            $Q1 =  $_GET['Q1'];
            $PF1 =  $_GET['PF1'];
            $Apf1 =  $_GET['Apf1'];

            $Apr1 =  $_GET['Apr1'];
            $Pof1 =  $_GET['Pof1'];
            $Por1 =  $_GET['Por1'];

            $ID2 =  $_GET['ID2'];
            $Ln2 =  $_GET['Ln2'];
            $Cs2 =  $_GET['Cs2'];
            $Ec2 =  $_GET['Ec2'];
            $Fm2 =  $_GET['Fm2'];
            $Vrms2 =  $_GET['Vrms2'];
            $Irms2 =  $_GET['Irms2'];
            $S2 =  $_GET['S2'];
            $Q2 =  $_GET['Q2'];
            $PF2 =  $_GET['PF2'];
            $Apf2 =  $_GET['Apf2'];
            $Apr2 =  $_GET['Apr2'];
            $Pof2 =  $_GET['Pof2'];
            $Por2 =  $_GET['Por2'];

            $ID3 =  $_GET['ID3'];
            $Ln3 =  $_GET['Ln3'];
            $Cs3 =  $_GET['Cs3'];
            $Ec3 =  $_GET['Ec3'];
            $Fm3 =  $_GET['Fm3'];
            $Vrms3 =  $_GET['Vrms3'];
            $Irms3 =  $_GET['Irms3'];
            $S3 =  $_GET['S3'];
            $Q3 =  $_GET['Q3'];
            $PF3 =  $_GET['PF3'];
            $Apf3 =  $_GET['Apf3'];
            $Apr3 =  $_GET['Apr3'];
            $Pof3 =  $_GET['Pof3'];
            $Por3 =  $_GET['Por3'];

            $ID4 =  $_GET['ID4'];
            $Ln4 =  $_GET['Ln4'];
            $Cs4 =  $_GET['Cs4'];
            $Ec4 =  $_GET['Ec4'];
            $Fm4 =  $_GET['Fm4'];
            $Vrms4 =  $_GET['Vrms4'];
            $Irms4 =  $_GET['Irms4'];
            $S4 =  $_GET['S4'];
            $Q4 =  $_GET['Q4'];
            $PF4 =  $_GET['PF4'];
            $Apf4 =  $_GET['Apf4'];
            $Apr4 =  $_GET['Apr4'];
            $Pof4 =  $_GET['Pof4'];
            $Por4 =  $_GET['Por4'];

            $ID5 =  $_GET['ID5'];
            $Ln5 =  $_GET['Ln5'];
            $Cs5 =  $_GET['Cs5'];
            $Ec5 =  $_GET['Ec5'];
            $Fm5 =  $_GET['Fm5'];
            $Vrms5 =  $_GET['Vrms5'];
            $Irms5 =  $_GET['Irms5'];
            $S5 =  $_GET['S5'];
            $Q5 =  $_GET['Q5'];
            $PF5 =  $_GET['PF5'];
            $Apf5 =  $_GET['Apf5'];
            $Apr5 =  $_GET['Apr5'];
            $Pof5 =  $_GET['Pof5'];
            $Por5 =  $_GET['Por5'];

            // SUM analyse



         

            /*** insert data ***/
            $sql = "INSERT INTO ems_ct (
            InsName,
            DIS_number,
            DIS_serialno,
            DIS_date,
            Department_Name,
            ID1,
            Ln1,
            Cs1,
            Ec1,
            Fm1,
            Vrms1,
            Irms1,
            S1,
            Q1,
            PF1,
            Apf1,
            Apr1,
            Pof1,
            Por1,

            ID2,
            Ln2,
            Cs2,
            Ec2,
            Fm2,
            Vrms2,
            Irms2,
            S2,
            Q2,
            PF2,
            Apf2,
            Apr2,
            Pof2,
            Por2,

            ID3,
            Ln3,
            Cs3,
            Ec3,
            Fm3,
            Vrms3,
            Irms3,
            S3,
            Q3,
            PF3,
            Apf3,
            Apr3,
            Pof3,
            Por3,

            ID4,
            Ln4,
            Cs4,
            Ec4,
            Fm4,
            Vrms4,
            Irms4,
            S4,
            Q4,
            PF4,
            Apf4,
            Apr4,
            Pof4,
            Por4,

            ID5,
            Ln5,
            Cs5,
            Ec5,
            Fm5,
            Vrms5,
            Irms5,
            S5,
            Q5,
            PF5,
            Apf5,
            Apr5,
            Pof5,
            Por5

            -- TotalEnergy,
            -- ToatalPower
            )
            VALUES (
            '$InsName',
            '$DIS_number',
            '$DIS_serialno',
            '$DIS_date',
            '$Department_Name',
            '$ID1',
            '$Ln1',
            '$Cs1',
            '$Ec1',
            '$Fm1',
            '$Vrms1',
            '$Irms1',
            '$S1',
            '$Q1',
            '$PF1',
            '$Apf1',
            '$Apr1',
            '$Pof1',
            '$Por1',

            '$ID2',
            '$Ln2',
            '$Cs2',
            '$Ec2',
            '$Fm2',
            '$Vrms2',
            '$Irms2',
            '$S2',
            '$Q2',
            '$PF2',
            '$Apf2',
            '$Apr2',
            '$Pof2',
            '$Por2',

            '$ID3',
            '$Ln3',
            '$Cs3',
            '$Ec3',
            '$Fm3',
            '$Vrms3',
            '$Irms3',
            '$S3',
            '$Q3',
            '$PF3',
            '$Apf3',
            '$Apr3',
            '$Pof3',
            '$Por3',

            '$ID4',
            '$Ln4',
            '$Cs4',
            '$Ec4',
            '$Fm4',
            '$Vrms4',
            '$Irms4',
            '$S4',
            '$Q4',
            '$PF4',
            '$Apf4',
            '$Apr4',
            '$Pof4',
            '$Por4',

            '$ID5',
            '$Ln5',
            '$Cs5',
            '$Ec5',
            '$Fm5',
            '$Vrms5',
            '$Irms5',
            '$S5',
            '$Q5',
            '$PF5',
            '$Apf5',
            '$Apr5',
            '$Pof5',
            '$Por5')";


            break;
         }
         else
         {
            
         }

      $TAG = $_GET['TAG'];

      if($TAG == '3')        
      {
           
            $DIS_number = $_GET['DIS_number'];
            $IP_ACCESS = $_GET['IP_ACCESS'];
            /*** Insert value ***/
            $sql = "INSERT INTO ip_address (
            DIS_number,
            IP_ACCESS)
            VALUES (
            '$DIS_number',
            '$IP_ACCESS')"; 
            break;
        }
        else
        {

        }
  }
  case 'DELETE':
  {
    $sql = "delete `$table` where id=$key"; break;
  }

}
 
// excecute SQL statement
$result = mysqli_query($link,$sql);

mysqli_close($link);




