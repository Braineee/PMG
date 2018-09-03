<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ///
        if(Auth::check()){
            //dump(Auth::user()->id); 
                
            $users = User::where('is_deleted', '0')->get();

            return view('users.index', ['users' => $users]);
        }

        return view('auth.login');
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // DO NOT DESTROY A USER
    }

    /**
     * Flag a currnt user as deleted
     * 
     * @param $user_id
     */
    public function deleteUser($user_id = null){

        if($user_id != null){
            //check whether user is an admin
            if(Auth::user()->role_id == 1){

                $delete = User::whereId($user_id)->update([
                    'is_deleted'        => 1,
                    'is_deleted_by'     => Auth::user()->id
                ]);

                if($delete){
                    //return if flaged as deleted
                    return redirect()->route('users.index')->with('success','User has been deleted successfully');
                }

                return redirect()->route('users.index')->with('error','There was an error deleting user');


            }else{
                return redirect()->route('users.index')->with('error','You do not have the previledge to delete a user');
            }
        }
    }
}
