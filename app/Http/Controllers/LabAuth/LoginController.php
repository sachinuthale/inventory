<?php

namespace App\Http\Controllers\LabAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;
use Session;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show login page
        return view('pages.login');
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
    public function update(Request $request, $id)
    {
        //
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

    /**
    * Check User
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function checkUser(Request $request)
    {
        $validatedData = $request->validate([
            'inputEmail' => 'required|email',
            'inputPassword' => 'required',
        ]);

        if(User::where('email', $request->inputEmail)->exists()){
            if (Auth::attempt(['email' => $request->inputEmail, 'password' => $request->inputPassword])) {
                // Authentication passed...
                return redirect()->intended('about');
            } else {
                return redirect('login')->with('error', 'Wrong Password');
            }
        } else {
            return redirect('login')->with('error', 'Please enter your correct email/username...');
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('login')->with('success','You have now been signed out. See ya.');
    }
}
