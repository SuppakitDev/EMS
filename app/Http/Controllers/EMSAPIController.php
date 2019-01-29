<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ems_info;
use App\ems_overview;
use App\display_info;
use App\building;
use App\Display_list;
use App\ip_access;
use App\department;
use DB;

class EMSAPIController extends Controller
{
    public function EmsInsert()
    {
        // if(Input::get('TAG') == 1)
        // {
        //       // ส่วนของการตรวจสอบ C_ID,B_ID,D_ID จาก DIS_number
        // $URLDIS_serialno = Input::get('DIS_serialno');
        // $REAL_C_ID = DB::table('display_lists')
        // ->where('SerialNo', '=', $URLDIS_serialno)
        // ->select('C_ID')
        // ->get();
        // foreach($REAL_C_ID as $REAL_C_IDs)
        //         {
        //             $REAL_C_ID = $REAL_C_IDs->C_ID;
        //         }

        // $URLInsName = Input::get('InsName');
        // $REAL_B_ID = DB::table('building')
        // ->where('Build_Name', '=', $URLInsName)
        // ->select('id')
        // ->get();
        // foreach($REAL_B_ID as $REAL_B_IDs)
        // {
        //     $REAL_B_ID = $REAL_B_IDs->id;
        // }

        // $URLDepartment_Name = Input::get('Department_Name');
        // $REAL_D_ID = DB::table('department')
        // ->where('Dept_Name', '=', $URLDepartment_Name)
        // ->select('id')
        // ->get();
        // foreach($REAL_D_ID as $REAL_D_IDs)
        // {
        //     $REAL_D_ID = $REAL_D_IDs->id;
        // }
        // // ส่วนของการตรวจสอบ C_ID,B_ID,D_ID จาก DIS_number
        //     // Start Prepare Data to varable Zone
        //     $C_ID                = $REAL_C_ID;
        //     $B_ID                = $REAL_B_ID;
        //     $D_ID                = $REAL_D_ID;
        //     $DIS_number          = Input::get('DIS_number');
        //     // $InsName             = Input::get('InsName'); แทนด้วย ฺB_ID
        //     $DIS_date            = Input::get('DIS_date');
        //     // String 1
        //     $ID1                 = Input::get('ID1');
        //     $Ln1                 = Input::get('Ln1');
        //     $Cs1                 = Input::get('Cs1');
        //     $Ec1                 = Input::get('Ec1');
        //     $Fm1                 = Input::get('Fm1');
        //     $Vrms1               = Input::get('Vrms1');
        //     $Irms1               = Input::get('Irms1');
        //     $S1                  = Input::get('S1');
        //     $Q1                  = Input::get('Q1');
        //     $PF1                 = Input::get('PF1');
        //     $Apf1                = Input::get('Apf1');
        //     $Apr1                = Input::get('Apr1');
        //     $Pof1                = Input::get('Pof1');
        //     $Por1                = Input::get('Por1');
        //     // String 2
        //     $ID2                 = Input::get('ID2');
        //     $Ln2                 = Input::get('Ln2');
        //     $Cs2                 = Input::get('Cs2');
        //     $Ec2                 = Input::get('Ec2');
        //     $Fm2                 = Input::get('Fm2');
        //     $Vrms2               = Input::get('Vrms2');
        //     $Irms2               = Input::get('Irms2');
        //     $S2                  = Input::get('S2');
        //     $Q2                  = Input::get('Q2');
        //     $PF2                 = Input::get('PF2');
        //     $Apf2                = Input::get('Apf2');
        //     $Apr2                = Input::get('Apr2');
        //     $Pof2                = Input::get('Pof2');
        //     $Por2                = Input::get('Por2');
        //     // String 3
        //     $ID3                 = Input::get('ID3');
        //     $Ln3                 = Input::get('Ln3');
        //     $Cs3                 = Input::get('Cs3');
        //     $Ec3                 = Input::get('Ec3');
        //     $Fm3                 = Input::get('Fm3');
        //     $Vrms3               = Input::get('Vrms3');
        //     $Irms3               = Input::get('Irms3');
        //     $S3                  = Input::get('S3');
        //     $Q3                  = Input::get('Q3');
        //     $PF3                 = Input::get('PF3');
        //     $Apf3                = Input::get('Apf3');
        //     $Apr3                = Input::get('Apr3');
        //     $Pof3                = Input::get('Pof3');
        //     $Por3                = Input::get('Por3');
        //     // String 4
        //     $ID4                 = Input::get('ID4');
        //     $Ln4                 = Input::get('Ln4');
        //     $Cs4                 = Input::get('Cs4');
        //     $Ec4                 = Input::get('Ec4');
        //     $Fm4                 = Input::get('Fm4');
        //     $Vrms4               = Input::get('Vrms4');
        //     $Irms4               = Input::get('Irms4');
        //     $S4                  = Input::get('S4');
        //     $Q4                  = Input::get('Q4');
        //     $PF4                 = Input::get('PF4');
        //     $Apf4                = Input::get('Apf4');
        //     $Apr4                = Input::get('Apr4');
        //     $Pof4                = Input::get('Pof4');
        //     $Por4                = Input::get('Por4');
        //     // String 5
        //     $ID5                 = Input::get('ID5');
        //     $Ln5                 = Input::get('Ln5');
        //     $Cs5                 = Input::get('Cs5');
        //     $Ec5                 = Input::get('Ec5');
        //     $Fm5                 = Input::get('Fm5');
        //     $Vrms5               = Input::get('Vrms5');
        //     $Irms5               = Input::get('Irms5');
        //     $S5                  = Input::get('S5');
        //     $Q5                  = Input::get('Q5');
        //     $PF5                 = Input::get('PF5');
        //     $Apf5                = Input::get('Apf5');
        //     $Apr5                = Input::get('Apr5');
        //     $Pof5                = Input::get('Pof5');
        //     $Por5                = Input::get('Por5');
        //     // End Prepare Data to varable Zone
            
        //     // Start Insert to ems_info Table
        //     $EmsAPI                 = new ems_info();
        //     $EmsAPI->C_ID           = $C_ID ;         
        //     $EmsAPI->B_ID           = $B_ID;
        //     $EmsAPI->D_ID           = $D_ID;
        //     $EmsAPI->Dis_Number     = $DIS_number;  
        //     $EmsAPI->Dis_Date       = $DIS_date; 

        //     $EmsAPI->ID1            = $ID1;
        //     $EmsAPI->Ln1            = $Ln1;
        //     $EmsAPI->Cs1            = $Cs1;
        //     $EmsAPI->Ec1            = $Ec1;
        //     $EmsAPI->Fm1            = $Fm1;
        //     $EmsAPI->Vrms1          = $Vrms1;
        //     $EmsAPI->Irms1          = $Irms1;
        //     $EmsAPI->S1             = $S1;
        //     $EmsAPI->Q1             = $Q1;
        //     $EmsAPI->PF1            = $PF1;
        //     $EmsAPI->Apf1           = $Apf1;
        //     $EmsAPI->Apr1           = $Apr1;
        //     $EmsAPI->Pof1           = $Pof1;
        //     $EmsAPI->Por1           = $Por1;

        //     $EmsAPI->ID2            = $ID2;
        //     $EmsAPI->Ln2            = $Ln2;
        //     $EmsAPI->Cs2            = $Cs2;
        //     $EmsAPI->Ec2            = $Ec2;
        //     $EmsAPI->Fm2            = $Fm2;
        //     $EmsAPI->Vrms2          = $Vrms2;
        //     $EmsAPI->Irms2          = $Irms2;
        //     $EmsAPI->S2             = $S2;
        //     $EmsAPI->Q2             = $Q2;
        //     $EmsAPI->PF2            = $PF2;
        //     $EmsAPI->Apf2           = $Apf2;
        //     $EmsAPI->Apr2           = $Apr2;
        //     $EmsAPI->Pof2           = $Pof2;
        //     $EmsAPI->Por2           = $Por2;

        //     $EmsAPI->ID3            = $ID3;
        //     $EmsAPI->Ln3            = $Ln3;
        //     $EmsAPI->Cs3            = $Cs3;
        //     $EmsAPI->Ec3            = $Ec3;
        //     $EmsAPI->Fm3            = $Fm3;
        //     $EmsAPI->Vrms3          = $Vrms3;
        //     $EmsAPI->Irms3          = $Irms3;
        //     $EmsAPI->S3             = $S3;
        //     $EmsAPI->Q3             = $Q3;
        //     $EmsAPI->PF3            = $PF3;
        //     $EmsAPI->Apf3           = $Apf3;
        //     $EmsAPI->Apr3           = $Apr3;
        //     $EmsAPI->Pof3           = $Pof3;
        //     $EmsAPI->Por3           = $Por3;

        //     $EmsAPI->ID4            = $ID4;
        //     $EmsAPI->Ln4            = $Ln4;
        //     $EmsAPI->Cs4            = $Cs4;
        //     $EmsAPI->Ec4            = $Ec4;
        //     $EmsAPI->Fm4            = $Fm4;
        //     $EmsAPI->Vrms4          = $Vrms4;
        //     $EmsAPI->Irms4          = $Irms4;
        //     $EmsAPI->S4             = $S4;
        //     $EmsAPI->Q4             = $Q4;
        //     $EmsAPI->PF4            = $PF4;
        //     $EmsAPI->Apf4           = $Apf4;
        //     $EmsAPI->Apr4           = $Apr4;
        //     $EmsAPI->Pof4           = $Pof4;
        //     $EmsAPI->Por4           = $Por4;

        //     $EmsAPI->ID5            = $ID5;
        //     $EmsAPI->Ln5            = $Ln5;
        //     $EmsAPI->Cs5            = $Cs5;
        //     $EmsAPI->Ec5            = $Ec5;
        //     $EmsAPI->Fm5            = $Fm5;
        //     $EmsAPI->Vrms5          = $Vrms5;
        //     $EmsAPI->Irms5          = $Irms5;
        //     $EmsAPI->S5             = $S5;
        //     $EmsAPI->Q5             = $Q5;
        //     $EmsAPI->PF5            = $PF5;
        //     $EmsAPI->Apf5           = $Apf5;
        //     $EmsAPI->Apr5           = $Apr5;
        //     $EmsAPI->Pof5           = $Pof5;
        //     $EmsAPI->Por5           = $Por5;

        //     $EmsAPI->save();
        //     // End Insert to ems_info Table

        //     // Start Insert to ems_Over Table
        //     $TotalVrms      = $Vrms1+$Vrms2+$Vrms3+$Vrms4+$Vrms5;
        //     $TotalIrms      = $Irms1+$Irms2+$Irms3+$Irms4+$Irms5;
        //     $TotalS         = $S1+$S2+$S3+$S4+$S5;
        //     $TotalQ         = $Q1+$Q2+$Q3+$Q4+$Q5;
        //     $TotalPF        = $PF1+$PF2+$PF3+$PF4+$PF5;
        //     $TotalApf       = $Apf1+$Apf2+$Apf3+$Apf4+$Apf5;
        //     $TotalApr       = $Apr1+$Apr2+$Apr3+$Apr4+$Apr5;
        //     $TotalPof       = $Pof1+$Pof2+$Pof3+$Pof4+$Pof5;
        //     $TotalPor       = $Por1+$Por2+$Por3+$Por4+$Por5;

        //     $EmsOverview                = new ems_overview();
        //     $EmsOverview->C_ID          = $C_ID;
        //     $EmsOverview->B_ID          = $B_ID;
        //     $EmsOverview->D_ID          = $D_ID;
        //     $EmsOverview->Dis_Number    = $DIS_number;
        //     $EmsOverview->Dis_Date      = $DIS_date;
        //     $EmsOverview->Vrms          = $TotalVrms;
        //     $EmsOverview->Irms          = $TotalIrms;
        //     $EmsOverview->S             = $TotalS;
        //     $EmsOverview->Q             = $TotalQ;
        //     $EmsOverview->PF            = $TotalPF;
        //     $EmsOverview->Apf           = $TotalApf;
        //     $EmsOverview->Apr           = $TotalApr;
        //     $EmsOverview->Pof           = $TotalPof;
        //     $EmsOverview->Por           = $TotalPor;

        //     $EmsOverview->save();
        //     // End Insert to ems_Over Table
        //     return "TAG1 Reccored Successed!" ;
        // }
        // elseif(Input::get('TAG') == 2)
        // {
        //      // ส่วนของการตรวจสอบ C_ID,B_ID,D_ID จาก DIS_number
        // $URLDIS_serialno = Input::get('Serial_DIS');
        // $REAL_C_ID2 = DB::table('display_lists')
        // ->where('SerialNo', '=', $URLDIS_serialno)
        // ->select('C_ID')
        // ->get();
        // foreach($REAL_C_ID2 as $REAL_C_ID2s)
        //         {
        //             $REAL_C_ID2 = $REAL_C_ID2s->C_ID;
        //         }

        // $DIS_NUM02 = Input::get('DIS_number');
        // $REAL_B_ID2 = DB::table('building')
        // ->where('Display_list', '=', $DIS_NUM02)
        // ->select('id')
        // ->get();
        // foreach($REAL_B_ID2 as $REAL_B_ID2s)
        // {
        //     $REAL_B_ID2 = $REAL_B_ID2s->id;
        // }

        // // ส่วนของการตรวจสอบ C_ID,B_ID,D_ID จาก DIS_number
        //     // Start Prepare Data to varable Zone
        //     $C_ID_info            = $REAL_C_ID2;
        //     $B_ID_info            = $REAL_B_ID2; 
        //     $DIS_date_info        = Input::get('DIS_date');
        //     $DIS_number_info      = Input::get('DIS_number');
        //     $Model_Code_of_DIS    = Input::get('Model_DIS');
        //     $Manufact_DIS         = Input::get('Manufact_DIS');
        //     $Serial_DIS           = Input::get('Serial_DIS');
        //     $Firmware_DIS         = Input::get('Firmware_DIS');
        //     $Model_CT             = Input::get('Model_CT');
        //     $Manufact_CT          = Input::get('Manufact_CT');
        //     $Serial_CT            = Input::get('Serial_CT');
        //     $Firmware_CT          = Input::get('Firmware_CT');
        //     // End Prepare Data to varable Zone

        //     // Start Insert to display_info Table
        //     $Display_info                           = new display_info();
        //     $Display_info->Dis_SerialNo             = $Serial_DIS;         
        //     $Display_info->C_ID                     = $C_ID_info ;         
        //     $Display_info->B_ID                     = $B_ID_info;         
        //     $Display_info->Dis_Number               = $DIS_number_info;         
        //     $Display_info->DisModel                 = $Model_Code_of_DIS;         
        //     $Display_info->DisManufacturing_Date    = $Manufact_DIS;         
        //     $Display_info->DisFirmware_Version      = $Firmware_DIS;
        //     $Display_info->Ct_SerialNo              = $Serial_CT;         
        //     $Display_info->CtModel                  = $Model_CT;         
        //     $Display_info->CtManufacturing_Date     = $Manufact_CT;         
        //     $Display_info->CtFirmware_Version       = $Firmware_CT;

        //     $Display_info->save();         
        //     // End Insert to display_info Table

        //     // Start Insert to ct_info Table
        //     // $ct_info                       = new ct_info();
        //     // $ct_info->Dis_SerialNo         = $Serial_DIS;         
        //     // $ct_info->Ct_SerialNo          = $Serial_CT;         
        //     // $ct_info->Model                = $Model_CT;         
        //     // $ct_info->Manufacturing_Date   = $Manufact_CT;         
        //     // $ct_info->Firmware_Version     = $Firmware_CT;
        //     // $ct_info->save();         
        //     // End Insert to ct_info Table  
        //     return "TAG2 Reccored Successed!" ;         
        // }
        // elseif(Input::get('TAG') == 3)
        // {

        //     // Start Prepare Data to varable Zone
        //     $DIS_number            = Input::get('DIS_number');
        //     $IP_ACCESS          = Input::get('IP_ACCESS');
        //     // End Prepare Data to varable Zone

        //     // Start Insert to display_info Table
        //     $ipaccess                           = new ip_access();
        //     $ipaccess->DIS_number           = $DIS_number;         
        //     $ipaccess->IP_Access            = $IP_ACCESS ;         
        //     $ipaccess->save();         
           
        //     return "TAG3 Reccored Successed!" ;         
        // }
        require_once 'DB/REST_api.php';
    }


    
}
