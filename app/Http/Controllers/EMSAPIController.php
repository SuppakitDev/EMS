<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ems_info;
use App\ems_overview;
use App\display_info;

class EMSAPIController extends Controller
{
    public function EmsInsert()
    {

        if(Input::get('TAG') == 1)
        {
            // Start Prepare Data to varable Zone
            $C_ID                = Input::get('C_ID');
            $B_ID                = Input::get('B_ID');
            $D_ID                = Input::get('D_ID');
            $DIS_number          = Input::get('DIS_number');
            // $InsName             = Input::get('InsName'); แทนด้วย ฺB_ID
            $DIS_date            = Input::get('DIS_date');
            // String 1
            $ID1                 = Input::get('ID1');
            $Ln1                 = Input::get('Ln1');
            $Cs1                 = Input::get('Cs1');
            $Ec1                 = Input::get('Ec1');
            $Fm1                 = Input::get('Fm1');
            $Vrms1               = Input::get('Vrms1');
            $Irms1               = Input::get('Irms1');
            $S1                  = Input::get('S1');
            $Q1                  = Input::get('Q1');
            $PF1                 = Input::get('PF1');
            $Apf1                = Input::get('Apf1');
            $Apr1                = Input::get('Apr1');
            $Pof1                = Input::get('Pof1');
            $Por1                = Input::get('Por1');
            // String 2
            $ID2                 = Input::get('ID2');
            $Ln2                 = Input::get('Ln2');
            $Cs2                 = Input::get('Cs2');
            $Ec2                 = Input::get('Ec2');
            $Fm2                 = Input::get('Fm2');
            $Vrms2               = Input::get('Vrms2');
            $Irms2               = Input::get('Irms2');
            $S2                  = Input::get('S2');
            $Q2                  = Input::get('Q2');
            $PF2                 = Input::get('PF2');
            $Apf2                = Input::get('Apf2');
            $Apr2                = Input::get('Apr2');
            $Pof2                = Input::get('Pof2');
            $Por2                = Input::get('Por2');
            // String 3
            $ID3                 = Input::get('ID3');
            $Ln3                 = Input::get('Ln3');
            $Cs3                 = Input::get('Cs3');
            $Ec3                 = Input::get('Ec3');
            $Fm3                 = Input::get('Fm3');
            $Vrms3               = Input::get('Vrms3');
            $Irms3               = Input::get('Irms3');
            $S3                  = Input::get('S3');
            $Q3                  = Input::get('Q3');
            $PF3                 = Input::get('PF3');
            $Apf3                = Input::get('Apf3');
            $Apr3                = Input::get('Apr3');
            $Pof3                = Input::get('Pof3');
            $Por3                = Input::get('Por3');
            // String 4
            $ID4                 = Input::get('ID4');
            $Ln4                 = Input::get('Ln4');
            $Cs4                 = Input::get('Cs4');
            $Ec4                 = Input::get('Ec4');
            $Fm4                 = Input::get('Fm4');
            $Vrms4               = Input::get('Vrms4');
            $Irms4               = Input::get('Irms4');
            $S4                  = Input::get('S4');
            $Q4                  = Input::get('Q4');
            $PF4                 = Input::get('PF4');
            $Apf4                = Input::get('Apf4');
            $Apr4                = Input::get('Apr4');
            $Pof4                = Input::get('Pof4');
            $Por4                = Input::get('Por4');
            // String 5
            $ID5                 = Input::get('ID5');
            $Ln5                 = Input::get('Ln5');
            $Cs5                 = Input::get('Cs5');
            $Ec5                 = Input::get('Ec5');
            $Fm5                 = Input::get('Fm5');
            $Vrms5               = Input::get('Vrms5');
            $Irms5               = Input::get('Irms5');
            $S5                  = Input::get('S5');
            $Q5                  = Input::get('Q5');
            $PF5                 = Input::get('PF5');
            $Apf5                = Input::get('Apf5');
            $Apr5                = Input::get('Apr5');
            $Pof5                = Input::get('Pof5');
            $Por5                = Input::get('Por5');
            // End Prepare Data to varable Zone
            
            // Start Insert to ems_info Table
            $EmsAPI                 = new ems_info();
            $EmsAPI->C_ID           = $C_ID ;         
            $EmsAPI->B_ID           = $B_ID;
            $EmsAPI->D_ID           = $D_ID;
            $EmsAPI->Dis_Number     = $DIS_number;  
            $EmsAPI->Dis_Date       = $DIS_date; 

            $EmsAPI->ID1            = $ID1;
            $EmsAPI->Ln1            = $Ln1;
            $EmsAPI->Cs1            = $Cs1;
            $EmsAPI->Ec1            = $Ec1;
            $EmsAPI->Fm1            = $Fm1;
            $EmsAPI->Vrms1          = $Vrms1;
            $EmsAPI->Irms1          = $Irms1;
            $EmsAPI->S1             = $S1;
            $EmsAPI->Q1             = $Q1;
            $EmsAPI->PF1            = $PF1;
            $EmsAPI->Apf1           = $Apf1;
            $EmsAPI->Apr1           = $Apr1;
            $EmsAPI->Pof1           = $Pof1;
            $EmsAPI->Por1           = $Por1;

            $EmsAPI->ID2            = $ID2;
            $EmsAPI->Ln2            = $Ln2;
            $EmsAPI->Cs2            = $Cs2;
            $EmsAPI->Ec2            = $Ec2;
            $EmsAPI->Fm2            = $Fm2;
            $EmsAPI->Vrms2          = $Vrms2;
            $EmsAPI->Irms2          = $Irms2;
            $EmsAPI->S2             = $S2;
            $EmsAPI->Q2             = $Q2;
            $EmsAPI->PF2            = $PF2;
            $EmsAPI->Apf2           = $Apf2;
            $EmsAPI->Apr2           = $Apr2;
            $EmsAPI->Pof2           = $Pof2;
            $EmsAPI->Por2           = $Por2;

            $EmsAPI->ID3            = $ID3;
            $EmsAPI->Ln3            = $Ln3;
            $EmsAPI->Cs3            = $Cs3;
            $EmsAPI->Ec3            = $Ec3;
            $EmsAPI->Fm3            = $Fm3;
            $EmsAPI->Vrms3          = $Vrms3;
            $EmsAPI->Irms3          = $Irms3;
            $EmsAPI->S3             = $S3;
            $EmsAPI->Q3             = $Q3;
            $EmsAPI->PF3            = $PF3;
            $EmsAPI->Apf3           = $Apf3;
            $EmsAPI->Apr3           = $Apr3;
            $EmsAPI->Pof3           = $Pof3;
            $EmsAPI->Por3           = $Por3;

            $EmsAPI->ID4            = $ID4;
            $EmsAPI->Ln4            = $Ln4;
            $EmsAPI->Cs4            = $Cs4;
            $EmsAPI->Ec4            = $Ec4;
            $EmsAPI->Fm4            = $Fm4;
            $EmsAPI->Vrms4          = $Vrms4;
            $EmsAPI->Irms4          = $Irms4;
            $EmsAPI->S4             = $S4;
            $EmsAPI->Q4             = $Q4;
            $EmsAPI->PF4            = $PF4;
            $EmsAPI->Apf4           = $Apf4;
            $EmsAPI->Apr4           = $Apr4;
            $EmsAPI->Pof4           = $Pof4;
            $EmsAPI->Por4           = $Por4;

            $EmsAPI->ID5            = $ID5;
            $EmsAPI->Ln5            = $Ln5;
            $EmsAPI->Cs5            = $Cs5;
            $EmsAPI->Ec5            = $Ec5;
            $EmsAPI->Fm5            = $Fm5;
            $EmsAPI->Vrms5          = $Vrms5;
            $EmsAPI->Irms5          = $Irms5;
            $EmsAPI->S5             = $S5;
            $EmsAPI->Q5             = $Q5;
            $EmsAPI->PF5            = $PF5;
            $EmsAPI->Apf5           = $Apf5;
            $EmsAPI->Apr5           = $Apr5;
            $EmsAPI->Pof5           = $Pof5;
            $EmsAPI->Por5           = $Por5;

            $EmsAPI->save();
            // End Insert to ems_info Table

            // Start Insert to ems_Over Table
            $TotalVrms      = $Vrms1+$Vrms2+$Vrms3+$Vrms4+$Vrms5;
            $TotalIrms      = $Irms1+$Irms2+$Irms3+$Irms4+$Irms5;
            $TotalS         = $S1+$S2+$S3+$S4+$S5;
            $TotalQ         = $Q1+$Q2+$Q3+$Q4+$Q5;
            $TotalPF        = $PF1+$PF2+$PF3+$PF4+$PF5;
            $TotalApf       = $Apf1+$Apf2+$Apf3+$Apf4+$Apf5;
            $TotalApr       = $Apr1+$Apr2+$Apr3+$Apr4+$Apr5;
            $TotalPof       = $Pof1+$Pof2+$Pof3+$Pof4+$Pof5;
            $TotalPor       = $Por1+$Por2+$Por3+$Por4+$Por5;

            $EmsOverview                = new ems_overview();
            $EmsOverview->C_ID          = $C_ID;
            $EmsOverview->B_ID          = $B_ID;
            $EmsOverview->D_ID          = $D_ID;
            $EmsOverview->Dis_Number    = $DIS_number;
            $EmsOverview->Dis_Date      = $DIS_date;
            $EmsOverview->Vrms          = $TotalVrms;
            $EmsOverview->Irms          = $TotalIrms;
            $EmsOverview->S             = $TotalS;
            $EmsOverview->Q             = $TotalQ;
            $EmsOverview->PF            = $TotalPF;
            $EmsOverview->Apf           = $TotalApf;
            $EmsOverview->Apr           = $TotalApr;
            $EmsOverview->Pof           = $TotalPof;
            $EmsOverview->Por           = $TotalPor;

            $EmsOverview->save();
            // End Insert to ems_Over Table

        }
        elseif(Input::get('TAG') == 2)
        {
            // Start Prepare Data to varable Zone
            $C_ID_info            = Input::get('C_ID');
            $B_ID_info            = Input::get('B_ID');   
            $DIS_date_info        = Input::get('DIS_date');
            $DIS_number_info      = Input::get('DIS_number');
            $Model_Code_of_DIS    = Input::get('Model_DIS');
            $Manufact_DIS         = Input::get('Manufact_DIS');
            $Serial_DIS           = Input::get('Serial_DIS');
            $Firmware_DIS         = Input::get('Firmware_DIS');
            $Model_CT             = Input::get('Model_CT');
            $Manufact_CT          = Input::get('Manufact_CT');
            $Serial_CT            = Input::get('Serial_CT');
            $Firmware_CT          = Input::get('Firmware_CT');
            // End Prepare Data to varable Zone

            // Start Insert to display_info Table
            $Display_info                           = new display_info();
            $Display_info->Dis_SerialNo             = $Serial_DIS;         
            $Display_info->C_ID                     = $C_ID_info ;         
            $Display_info->B_ID                     = $B_ID_info;         
            $Display_info->Dis_Number               = $DIS_number_info;         
            $Display_info->DisModel                 = $Model_Code_of_DIS;         
            $Display_info->DisManufacturing_Date    = $Manufact_DIS;         
            $Display_info->DisFirmware_Version      = $Firmware_DIS;
            $Display_info->Ct_SerialNo              = $Serial_CT;         
            $Display_info->CtModel                  = $Model_CT;         
            $Display_info->CtManufacturing_Date     = $Manufact_CT;         
            $Display_info->CtFirmware_Version       = $Firmware_CT;

            $Display_info->save();         
            // End Insert to display_info Table

            // Start Insert to ct_info Table
            // $ct_info                       = new ct_info();
            // $ct_info->Dis_SerialNo         = $Serial_DIS;         
            // $ct_info->Ct_SerialNo          = $Serial_CT;         
            // $ct_info->Model                = $Model_CT;         
            // $ct_info->Manufacturing_Date   = $Manufact_CT;         
            // $ct_info->Firmware_Version     = $Firmware_CT;
            // $ct_info->save();         
            // End Insert to ct_info Table           
        }
    }


    public function AutoEmsInsertDis01()
    {
            // Start Prepare Data to varable Zone
            $C_ID                = 0;
            $B_ID                = 0;
            $D_ID                = 0;
            $DIS_number          = 01;
            // $InsName             = Input::get('InsName'); แทนด้วย ฺB_ID
            $DIS_date            = Input::get('date');
            // String 1
            $ID1                 = 01;
            $Ln1                 = "AIRFORCE";
            $Cs1                 = 'B';
            $Ec1                 = "002";
            $Fm1                 = rand( 4000 , 5050);
            $Vrms1               = rand( 20000 , 30000);
            $Irms1               = rand( 00000 , 20000);
            $S1                  = rand( 140000 , 200000);
            $Q1                  = rand( 000000 , 100000);
            $PF1                 = rand( 500 , 1000);
            $Apf1                = rand( 0000000000 , 0000000021);
            $Apr1                = 0000000000;
            $Pof1                = rand( 002000 , 003000);
            $Por1                = 00000;
            // String 2
            $ID2                 = 02;
            $Ln2                 = "AIRFORCE";
            $Cs2                 = 'B';
            $Ec2                 = "002";
            $Fm2                 = rand( 4000 , 5050);
            $Vrms2               = rand( 20000 , 30000);
            $Irms2               = rand( 00000 , 20000);
            $S2                  = rand( 140000 , 200000);
            $Q2                  = rand( 000000 , 100000);
            $PF2                 = rand( 500 , 1000);
            $Apf2                = rand( 0000000000 , 0000000021);
            $Apr2                = 0000000000;
            $Pof2                = rand( 002000 , 003000);
            $Por2                = 00000;
            // String 3
            $ID3                 = 03;
            $Ln3                 = "AIRFORCE";
            $Cs3                 = 'B';
            $Ec3                 = "002";
            $Fm3                 = rand( 4000 , 5050);
            $Vrms3               = rand( 20000 , 30000);
            $Irms3               = rand( 00000 , 20000);
            $S3                  = rand( 140000 , 200000);
            $Q3                  = rand( 000000 , 100000);
            $PF3                 = rand( 500 , 1000);
            $Apf3                = rand( 0000000000 , 0000000021);
            $Apr3                = 0000000000;
            $Pof3                = rand( 002000 , 003000);
            $Por3                = 00000;
            // String 4
            $ID4                 = 04;
            $Ln4                 = "AIRFORCE";
            $Cs4                 = 'B';
            $Ec4                 = "002";
            $Fm4                 = rand( 4000 , 5050);
            $Vrms4               = rand( 20000 , 30000);
            $Irms4               = rand( 00000 , 20000);
            $S4                  = rand( 140000 , 200000);
            $Q4                  = rand( 000000 , 100000);
            $PF4                 = rand( 500 , 1000);
            $Apf4                = rand( 0000000000 , 0000000021);
            $Apr4                = 0000000000;
            $Pof4                = rand( 002000 , 003000);
            $Por4                = 00000;
            // String 5
            $ID5                 = 05;
            $Ln5                 = "AIRFORCE";
            $Cs5                 = 'B';
            $Ec5                 = "002";
            $Fm5                 = rand( 4000 , 5050);
            $Vrms5               = rand( 20000 , 30000);
            $Irms5               = rand( 00000 , 20000);
            $S5                  = rand( 140000 , 200000);
            $Q5                  = rand( 000000 , 100000);
            $PF5                 = rand( 500 , 1000);
            $Apf5                = rand( 0000000000 , 0000000021);
            $Apr5                = 0000000000;
            $Pof5                = rand( 002000 , 003000);
            $Por5                = 00000;
            // End Prepare Data to varable Zone
            
            // Start Insert to ems_info Table
            $EmsAPI                 = new ems_info();
            $EmsAPI->C_ID           = $C_ID ;         
            $EmsAPI->B_ID           = $B_ID;
            $EmsAPI->D_ID           = $D_ID;
            $EmsAPI->Dis_Number     = $DIS_number;  
            $EmsAPI->Dis_Date       = $DIS_date; 

            $EmsAPI->ID1            = $ID1;
            $EmsAPI->Ln1            = $Ln1;
            $EmsAPI->Cs1            = $Cs1;
            $EmsAPI->Ec1            = $Ec1;
            $EmsAPI->Fm1            = $Fm1;
            $EmsAPI->Vrms1          = $Vrms1;
            $EmsAPI->Irms1          = $Irms1;
            $EmsAPI->S1             = $S1;
            $EmsAPI->Q1             = $Q1;
            $EmsAPI->PF1            = $PF1;
            $EmsAPI->Apf1           = $Apf1;
            $EmsAPI->Apr1           = $Apr1;
            $EmsAPI->Pof1           = $Pof1;
            $EmsAPI->Por1           = $Por1;

            $EmsAPI->ID2            = $ID2;
            $EmsAPI->Ln2            = $Ln2;
            $EmsAPI->Cs2            = $Cs2;
            $EmsAPI->Ec2            = $Ec2;
            $EmsAPI->Fm2            = $Fm2;
            $EmsAPI->Vrms2          = $Vrms2;
            $EmsAPI->Irms2          = $Irms2;
            $EmsAPI->S2             = $S2;
            $EmsAPI->Q2             = $Q2;
            $EmsAPI->PF2            = $PF2;
            $EmsAPI->Apf2           = $Apf2;
            $EmsAPI->Apr2           = $Apr2;
            $EmsAPI->Pof2           = $Pof2;
            $EmsAPI->Por2           = $Por2;

            $EmsAPI->ID3            = $ID3;
            $EmsAPI->Ln3            = $Ln3;
            $EmsAPI->Cs3            = $Cs3;
            $EmsAPI->Ec3            = $Ec3;
            $EmsAPI->Fm3            = $Fm3;
            $EmsAPI->Vrms3          = $Vrms3;
            $EmsAPI->Irms3          = $Irms3;
            $EmsAPI->S3             = $S3;
            $EmsAPI->Q3             = $Q3;
            $EmsAPI->PF3            = $PF3;
            $EmsAPI->Apf3           = $Apf3;
            $EmsAPI->Apr3           = $Apr3;
            $EmsAPI->Pof3           = $Pof3;
            $EmsAPI->Por3           = $Por3;

            $EmsAPI->ID4            = $ID4;
            $EmsAPI->Ln4            = $Ln4;
            $EmsAPI->Cs4            = $Cs4;
            $EmsAPI->Ec4            = $Ec4;
            $EmsAPI->Fm4            = $Fm4;
            $EmsAPI->Vrms4          = $Vrms4;
            $EmsAPI->Irms4          = $Irms4;
            $EmsAPI->S4             = $S4;
            $EmsAPI->Q4             = $Q4;
            $EmsAPI->PF4            = $PF4;
            $EmsAPI->Apf4           = $Apf4;
            $EmsAPI->Apr4           = $Apr4;
            $EmsAPI->Pof4           = $Pof4;
            $EmsAPI->Por4           = $Por4;

            $EmsAPI->ID5            = $ID5;
            $EmsAPI->Ln5            = $Ln5;
            $EmsAPI->Cs5            = $Cs5;
            $EmsAPI->Ec5            = $Ec5;
            $EmsAPI->Fm5            = $Fm5;
            $EmsAPI->Vrms5          = $Vrms5;
            $EmsAPI->Irms5          = $Irms5;
            $EmsAPI->S5             = $S5;
            $EmsAPI->Q5             = $Q5;
            $EmsAPI->PF5            = $PF5;
            $EmsAPI->Apf5           = $Apf5;
            $EmsAPI->Apr5           = $Apr5;
            $EmsAPI->Pof5           = $Pof5;
            $EmsAPI->Por5           = $Por5;

            $EmsAPI->save();
            // End Insert to ems_info Table

            // Start Insert to ems_Over Table
            $TotalVrms      = $Vrms1+$Vrms2+$Vrms3+$Vrms4+$Vrms5;
            $TotalIrms      = $Irms1+$Irms2+$Irms3+$Irms4+$Irms5;
            $TotalS         = $S1+$S2+$S3+$S4+$S5;
            $TotalQ         = $Q1+$Q2+$Q3+$Q4+$Q5;
            $TotalPF        = $PF1+$PF2+$PF3+$PF4+$PF5;
            $TotalApf       = $Apf1+$Apf2+$Apf3+$Apf4+$Apf5;
            $TotalApr       = $Apr1+$Apr2+$Apr3+$Apr4+$Apr5;
            $TotalPof       = $Pof1+$Pof2+$Pof3+$Pof4+$Pof5;
            $TotalPor       = $Por1+$Por2+$Por3+$Por4+$Por5;

            $EmsOverview                = new ems_overview();
            $EmsOverview->C_ID          = $C_ID;
            $EmsOverview->B_ID          = $B_ID;
            $EmsOverview->D_ID          = $D_ID;
            $EmsOverview->Dis_Number    = $DIS_number;
            $EmsOverview->Dis_Date      = $DIS_date;
            $EmsOverview->Vrms          = $TotalVrms;
            $EmsOverview->Irms          = $TotalIrms;
            $EmsOverview->S             = $TotalS;
            $EmsOverview->Q             = $TotalQ;
            $EmsOverview->PF            = $TotalPF;
            $EmsOverview->Apf           = $TotalApf;
            $EmsOverview->Apr           = $TotalApr;
            $EmsOverview->Pof           = $TotalPof;
            $EmsOverview->Por           = $TotalPor;

            $EmsOverview->save();
            // End Insert to ems_Over Table

        }

        public function AutoEmsInsertDis02()
    {
            // Start Prepare Data to varable Zone
            $C_ID                = 0;
            $B_ID                = 0;
            $D_ID                = 0;
            $DIS_number          = 02;
            // $InsName             = Input::get('InsName'); แทนด้วย ฺB_ID
            $DIS_date            = Input::get('date');
            // String 1
            $ID1                 = 01;
            $Ln1                 = "AIRFORCE2";
            $Cs1                 = 'B';
            $Ec1                 = "002";
            $Fm1                 = rand( 4000 , 5050);
            $Vrms1               = rand( 20000 , 30000);
            $Irms1               = rand( 00000 , 20000);
            $S1                  = rand( 140000 , 200000);
            $Q1                  = rand( 000000 , 100000);
            $PF1                 = rand( 500 , 1000);
            $Apf1                = rand( 0000000000 , 0000000021);
            $Apr1                = 0000000000;
            $Pof1                = rand( 002000 , 003000);
            $Por1                = 00000;
            // String 2
            $ID2                 = 02;
            $Ln2                 = "AIRFORCE2";
            $Cs2                 = 'B';
            $Ec2                 = "002";
            $Fm2                 = rand( 4000 , 5050);
            $Vrms2               = rand( 20000 , 30000);
            $Irms2               = rand( 00000 , 20000);
            $S2                  = rand( 140000 , 200000);
            $Q2                  = rand( 000000 , 100000);
            $PF2                 = rand( 500 , 1000);
            $Apf2                = rand( 0000000000 , 0000000021);
            $Apr2                = 0000000000;
            $Pof2                = rand( 002000 , 003000);
            $Por2                = 00000;
            // String 3
            $ID3                 = 03;
            $Ln3                 = "AIRFORCE2";
            $Cs3                 = 'B';
            $Ec3                 = "002";
            $Fm3                 = rand( 4000 , 5050);
            $Vrms3               = rand( 20000 , 30000);
            $Irms3               = rand( 00000 , 20000);
            $S3                  = rand( 140000 , 200000);
            $Q3                  = rand( 000000 , 100000);
            $PF3                 = rand( 500 , 1000);
            $Apf3                = rand( 0000000000 , 0000000021);
            $Apr3                = 0000000000;
            $Pof3                = rand( 002000 , 003000);
            $Por3                = 00000;
            // String 4
            $ID4                 = 04;
            $Ln4                 = "AIRFORCE2";
            $Cs4                 = 'B';
            $Ec4                 = "002";
            $Fm4                 = rand( 4000 , 5050);
            $Vrms4               = rand( 20000 , 30000);
            $Irms4               = rand( 00000 , 20000);
            $S4                  = rand( 140000 , 200000);
            $Q4                  = rand( 000000 , 100000);
            $PF4                 = rand( 500 , 1000);
            $Apf4                = rand( 0000000000 , 0000000021);
            $Apr4                = 0000000000;
            $Pof4                = rand( 002000 , 003000);
            $Por4                = 00000;
            // String 5
            $ID5                 = 05;
            $Ln5                 = "AIRFORCE2";
            $Cs5                 = 'B';
            $Ec5                 = "002";
            $Fm5                 = rand( 4000 , 5050);
            $Vrms5               = rand( 20000 , 30000);
            $Irms5               = rand( 00000 , 20000);
            $S5                  = rand( 140000 , 200000);
            $Q5                  = rand( 000000 , 100000);
            $PF5                 = rand( 500 , 1000);
            $Apf5                = rand( 0000000000 , 0000000021);
            $Apr5                = 0000000000;
            $Pof5                = rand( 002000 , 003000);
            $Por5                = 00000;
            // End Prepare Data to varable Zone
            
            // Start Insert to ems_info Table
            $EmsAPI                 = new ems_info();
            $EmsAPI->C_ID           = $C_ID ;         
            $EmsAPI->B_ID           = $B_ID;
            $EmsAPI->D_ID           = $D_ID;
            $EmsAPI->Dis_Number     = $DIS_number;  
            $EmsAPI->Dis_Date       = $DIS_date; 

            $EmsAPI->ID1            = $ID1;
            $EmsAPI->Ln1            = $Ln1;
            $EmsAPI->Cs1            = $Cs1;
            $EmsAPI->Ec1            = $Ec1;
            $EmsAPI->Fm1            = $Fm1;
            $EmsAPI->Vrms1          = $Vrms1;
            $EmsAPI->Irms1          = $Irms1;
            $EmsAPI->S1             = $S1;
            $EmsAPI->Q1             = $Q1;
            $EmsAPI->PF1            = $PF1;
            $EmsAPI->Apf1           = $Apf1;
            $EmsAPI->Apr1           = $Apr1;
            $EmsAPI->Pof1           = $Pof1;
            $EmsAPI->Por1           = $Por1;

            $EmsAPI->ID2            = $ID2;
            $EmsAPI->Ln2            = $Ln2;
            $EmsAPI->Cs2            = $Cs2;
            $EmsAPI->Ec2            = $Ec2;
            $EmsAPI->Fm2            = $Fm2;
            $EmsAPI->Vrms2          = $Vrms2;
            $EmsAPI->Irms2          = $Irms2;
            $EmsAPI->S2             = $S2;
            $EmsAPI->Q2             = $Q2;
            $EmsAPI->PF2            = $PF2;
            $EmsAPI->Apf2           = $Apf2;
            $EmsAPI->Apr2           = $Apr2;
            $EmsAPI->Pof2           = $Pof2;
            $EmsAPI->Por2           = $Por2;

            $EmsAPI->ID3            = $ID3;
            $EmsAPI->Ln3            = $Ln3;
            $EmsAPI->Cs3            = $Cs3;
            $EmsAPI->Ec3            = $Ec3;
            $EmsAPI->Fm3            = $Fm3;
            $EmsAPI->Vrms3          = $Vrms3;
            $EmsAPI->Irms3          = $Irms3;
            $EmsAPI->S3             = $S3;
            $EmsAPI->Q3             = $Q3;
            $EmsAPI->PF3            = $PF3;
            $EmsAPI->Apf3           = $Apf3;
            $EmsAPI->Apr3           = $Apr3;
            $EmsAPI->Pof3           = $Pof3;
            $EmsAPI->Por3           = $Por3;

            $EmsAPI->ID4            = $ID4;
            $EmsAPI->Ln4            = $Ln4;
            $EmsAPI->Cs4            = $Cs4;
            $EmsAPI->Ec4            = $Ec4;
            $EmsAPI->Fm4            = $Fm4;
            $EmsAPI->Vrms4          = $Vrms4;
            $EmsAPI->Irms4          = $Irms4;
            $EmsAPI->S4             = $S4;
            $EmsAPI->Q4             = $Q4;
            $EmsAPI->PF4            = $PF4;
            $EmsAPI->Apf4           = $Apf4;
            $EmsAPI->Apr4           = $Apr4;
            $EmsAPI->Pof4           = $Pof4;
            $EmsAPI->Por4           = $Por4;

            $EmsAPI->ID5            = $ID5;
            $EmsAPI->Ln5            = $Ln5;
            $EmsAPI->Cs5            = $Cs5;
            $EmsAPI->Ec5            = $Ec5;
            $EmsAPI->Fm5            = $Fm5;
            $EmsAPI->Vrms5          = $Vrms5;
            $EmsAPI->Irms5          = $Irms5;
            $EmsAPI->S5             = $S5;
            $EmsAPI->Q5             = $Q5;
            $EmsAPI->PF5            = $PF5;
            $EmsAPI->Apf5           = $Apf5;
            $EmsAPI->Apr5           = $Apr5;
            $EmsAPI->Pof5           = $Pof5;
            $EmsAPI->Por5           = $Por5;

            $EmsAPI->save();
            // End Insert to ems_info Table

            // Start Insert to ems_Over Table
            $TotalVrms      = $Vrms1+$Vrms2+$Vrms3+$Vrms4+$Vrms5;
            $TotalIrms      = $Irms1+$Irms2+$Irms3+$Irms4+$Irms5;
            $TotalS         = $S1+$S2+$S3+$S4+$S5;
            $TotalQ         = $Q1+$Q2+$Q3+$Q4+$Q5;
            $TotalPF        = $PF1+$PF2+$PF3+$PF4+$PF5;
            $TotalApf       = $Apf1+$Apf2+$Apf3+$Apf4+$Apf5;
            $TotalApr       = $Apr1+$Apr2+$Apr3+$Apr4+$Apr5;
            $TotalPof       = $Pof1+$Pof2+$Pof3+$Pof4+$Pof5;
            $TotalPor       = $Por1+$Por2+$Por3+$Por4+$Por5;

            $EmsOverview                = new ems_overview();
            $EmsOverview->C_ID          = $C_ID;
            $EmsOverview->B_ID          = $B_ID;
            $EmsOverview->D_ID          = $D_ID;
            $EmsOverview->Dis_Number    = $DIS_number;
            $EmsOverview->Dis_Date      = $DIS_date;
            $EmsOverview->Vrms          = $TotalVrms;
            $EmsOverview->Irms          = $TotalIrms;
            $EmsOverview->S             = $TotalS;
            $EmsOverview->Q             = $TotalQ;
            $EmsOverview->PF            = $TotalPF;
            $EmsOverview->Apf           = $TotalApf;
            $EmsOverview->Apr           = $TotalApr;
            $EmsOverview->Pof           = $TotalPof;
            $EmsOverview->Por           = $TotalPor;

            $EmsOverview->save();
            // End Insert to ems_Over Table

        }


        
}
