<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests\Updateprofile;
use Image;
use File;
use DB;
use Alert;
class ProfileController extends Controller
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
        //
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
    public function update(Updateprofile $request, $id)
    {
        $users = User::find($id);
        if($request->hasFile('image')){
            $filename = str_random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/Img/profiles/',$filename);
            Image::make(public_path(). '/Img/profiles/' . $filename)->resize(100,100)->save(public_path().'/Img/profiles/resize/'.$filename);

            $users->update($request->all());
            // $users->update(['Fname' =>$filename]);            
            $users->update(['image' =>$filename]);

        }else{
            $filename = Auth::user()->image; 
            $users->update($request->all());
            $users->update(['image' =>Auth::user()->image]);
            
        }
        
        
        // $newpass = bcrypt($request->pass);
        // $users->update(['password' =>$newpass]);
        alert()->success('You Profile have been Changed.', 'Complete!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
