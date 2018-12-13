<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client_company;
use App\building;
use App\department;
use App\User;
use Alert;
use DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Response;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new client_company();
        $company->C_name = $request->C_name;
        $company->lat = $request->Latitude;
        $company->lon = $request->Longitude;
        $company->Display_list = $request->Display_list;
        $company->Address = $request->Address;
        $company->Email = $request->Email;
        $company->Tel = $request->Tel;
        $company->Money_rate = $request->Money_rate;
        $company->save(); 
        
        alert()->success('Success This Company Added!!', 'Complete!');
        return redirect()->Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = client_company::find($id);
        $company->C_name = $request->C_name;
        $company->lat = $request->Latitude;
        $company->lon = $request->Longitude;
        $company->Display_list = $request->Display_list;
        $company->Address = $request->Address;
        $company->Email = $request->Email;
        $company->Tel = $request->Tel;
        $company->Money_rate = $request->Money_rate;
        $company->save();
        alert()->success('This Company Changed.', 'Success!');
        return redirect()->Back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = client_company::find($id);
        $company->delete();
        Alert::warning('This Company Removed.', 'Complete!');      
        return redirect()->Back();
    }

    public function Gotothiscompany()
    {
        $companyid = Input::get('ID');

        $Building = DB::table('building')
                     ->where('C_ID', '=', $companyid)
                     ->get();

        $Dapartment = DB::table('department')
                     ->where('C_ID', '=', $companyid)
                     ->get();

        $Displaylist = DB::table('client_company')
                     ->where('id', '=', $companyid)
                     ->select('Display_list')
                     ->get();
        
                    foreach ($Displaylist as $Displaylists) 
                    {
                        $Displaylist = explode(",",$Displaylists->Display_list);
                    }            

        return view('Content\Admin\Companydetail',
        [
            'Building' => $Building,
            'Dapartment' => $Dapartment,
            'Displaylist' => $Displaylist,
            'companyid' => $companyid,
            
        
        ]);

        
    }

    public function Addbuilding()
    {
        $B_name = Input::get('B_name');
        $Displaylist = Input::get('Displaylist');
        $C_ID = Input::get('C_ID');
        
        $building = new building();
        $building->C_ID = $C_ID;
        $building->Build_Name =  $B_name;
        $Displaylist = implode(",",$Displaylist);
        $building->Display_list =  $Displaylist;
        $building->save();
        alert()->success('This Building Added.', 'Success!');
        return redirect()->Back(); 
    }


    public function getdisplaylist(){

        header("Content-type: text/json");
 
        $Buildingid = Input::get('Buildingid'); 
        $Displaylist = DB::table('building')
            ->distinct()
            ->where('id','=',$Buildingid)
            // ->where('MBxID','=',$MBxID)
            ->select('Display_list')
            ->get();

            foreach ($Displaylist as $Displaylists) 
                    {
                        $Displaylist = explode(",",$Displaylists->Display_list);
                        
                    }   
            return Response::json($Displaylist);
            // return $Displaylist;
                
    }

    public function Adddepartment()
    {
        $Dept_name = Input::get('Dept_name');
        $Displaylist = Input::get('DIS_number');
        $C_ID = Input::get('C_ID');
        $B_ID = Input::get('B_ID');
        
        $department = new department();
        $department->C_ID = $C_ID;
        $department->Dept_Name =  $Dept_name;
        $department->B_ID =  $B_ID;
        $department->DIS_number =  $Displaylist;
        $department->save();
        alert()->success('This Department Added.', 'Success!');
        return redirect()->Back(); 
    }

    public function RemoveBuilding()
    {
        $ID = Input::get('ID');
        $building = building::find($ID);
        $building->delete();
        Alert::warning('This Building Removed.', 'Complete!');              
        return redirect()->Back();
    }


    public function RemoveDepartment()
    {
        $ID = Input::get('ID');
        $department = department::find($ID);
        $department->delete();
        Alert::warning('This Deoartment Removed.', 'Complete!');                       
        return redirect()->Back();
    }

    public function EditBuilding()
    {
        $ID = Input::get('ID');
        $Build_Name = Input::get('Build_Name');
        $Displaylist = Input::get('Displaylist');
        $C_ID = Input::get('C_ID');
        $building = building::find($ID);
        $building->Build_Name = $Build_Name;
        $Displaylistresult = implode(",",$Displaylist);
        $building->Display_list = $Displaylistresult;
        $building->C_ID = $C_ID;
        $building->save();    
        alert()->success('This Building Changed.', 'Success!');
        return redirect()->Back();

        
    } 

    public function EditDepartment()
    {
        $ID = Input::get('ID');
        $Dept_Name = Input::get('Dept_Name');
        $B_ID = Input::get('B_ID');
        $DIS_number = Input::get('DIS_number');
        $C_ID = Input::get('C_ID');

        $department = department::find($ID);
        $department->Dept_Name = $Dept_Name;
        
        $department->DIS_number = $DIS_number;
        $department->B_ID = $B_ID;
        $department->C_ID = $C_ID;
        $department->save();
        alert()->success('This Department Changed.', 'Success!');
        return redirect()->Back();


    }
    
    public function Addusertocompany()
    {
        $companyid = Input::get('ID');
        $Company = DB::table('client_company')
        ->where('id', '=', $companyid)
        ->get();

        $Member = DB::table('users')
        ->where('C_ID', '=', $companyid)
        ->where('Status', '=', 'Manager')
        ->get();
        
        return view('Content\Admin\Companymember',
        [
            'Company' => $Company,
            'Member' => $Member,
        ]);
    }

    public function RemoveMember()
    {
        $ID = Input::get('ID');
        $users = User::find($ID);
        $users->delete();
        Alert::warning('This Member Removed.', 'Complete!');
        return redirect()->Back();
    }


    public function UpdateMember()
    {
        $ID = Input::get('ID');
        $Username = Input::get('Username');
        $Fname = Input::get('Fname');
        $Lname = Input::get('Lname');
        $Tel = Input::get('Tel');
        $email = Input::get('email');

        $updateDetails=array(
            'Username' => $Username,
            'Fname'    => $Fname,
            'Lname'    => $Lname,
            'Tel'    => $Tel,
            'email'    => $email
        );
        

        DB::table('users')
            ->where('id', $ID)
            ->update($updateDetails);
            Alert::success('This Memeber Changed.', 'Complete!');  
            return redirect()->Back();

            // return $Username;
    }



}
