<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Image;
use File;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // alert()->success('Success', 'Add User Complete!!'); 
        return url()->previous();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',

            'Username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'Tel' => 'required|string|max:10',
            'CreateBy' =>'required',            
            'C_ID' =>'required',
            'B_ID' =>'required',
            // 'image' =>'required',
            'Status' =>'required',
            'D_ID' =>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create( array $data)
    {

      
        return User::create([
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
            
    
            'Username' => $data['Username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),            
            'Fname' => $data['Fname'],
            'Lname' => $data['Lname'],
            'Tel' => $data['Tel'],
            // 'image' =>  $filename,
            'CreateBy' => $data['CreateBy'],            
            'C_ID' => $data['C_ID'],
            'B_ID' => $data['B_ID'],
            'Status' => $data['Status'],
            'D_ID' => $data['D_ID'],
        ]);

        // $file = $request->file('image');
        // $thumbnail_path = public_path('uploads/propic/thumbnail/');
        // $original_path = public_path('uploads/propic/original/');
        // $file_name = 'user_'. $user->id .'_'. str_rand(32) . '.' . $file->getClientOriginalExtension();
        //   Image::make($file)
        //         ->resize(261,null,function ($constraint) {
        //           $constraint->aspectRatio();
        //            })
        //         ->save($original_path . $file_name)
        //         ->resize(90, 90)
        //         ->save($thumbnail_path . $file_name);
      
        // $User->update(['image' => $file_name]);
        // return $user;
    }
}
