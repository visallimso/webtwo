<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Users;
use Hash;
use Session;

class clientController extends Controller
{
    public function signin(){

        return view('signin');

    }

    public function register_client (){

        return view('register_client');
    }

    public function registerClient (Request $request){

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',
            'emailAddress' => 'required|email|unique:users,email',
            'Password' => 'required',
        ]);

        $user = new Users();
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->date_of_birth = $request->dob;
        $user->gender = $request->gender;
        $user->email = $request->emailAddress;
        // $user->password = $request->Password;
        //if u want to encrypted the pw
       $user->password = Hash::make($request->Password);

        $res = $user->save();
        if($res){
            return back()->with('success','You have registerd');
        }else{
            return back()->with('fail','You have failed registaration');
        }
    }

    public function loginClient (Request $request){
        // $request->validate([
        //     'emailAddress' => 'required',
        //     'Password' => 'required',
        // ]);

        $user = Users::where('email','=',$request->emailAddress)->first();
        if ($user && Hash::check($request->Password, $user->password)) {
            $request->session()->put('loginId', $user->id);
            return redirect('/uhome');
        } else {
            return back()->with('fail', 'Your password is incorrect');
        }       
    }

    public function home(Request $request){
        return view('home');
    }

    public function uhome(Request $request){
        return view('uhome');
    }

    public function uabout(Request $request){
        return view('user.uabout');
    }

    public function uannoucement(Request $request){
        return view('user.uannoucement');
    }

    public function ucontact(Request $request){
        return view('user.ucontact');
    }

    public function profile()
    {
        $data = null;

        if (Session::has('loginId')) {
            $userId = Session::get('loginId');

            $data = Users::find($userId);

            if (!$data) {
                return redirect('/')->with('fail', 'User not found');
            }
        } else {
            return redirect('/signin')->with('fail', 'Login required');
        }

        return view('profile', compact('data'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('loginId');
        $request->session()->flush();

        return redirect('/signin')->with('success', 'Logged out successfully');
    }

    public function clientEdit(Request $request)
    {
        $userId = $request->id;

        $user = Users::find($userId);

        if (!$user) {
            return back()->with('fail', 'User not found');
        }

        return view('clientEdit', compact('user'));
    }

    public function update(Request $request)
        {
            $userId = $request->id;

            $user = Users::find($userId);

            if (!$user) {
                return back()->with('fail', 'User not found');
            }

            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->date_of_birth = $request->dob;
            $user->gender = $request->gender;
            // $user->email = $request->emailAddress;
            // $user->password = $request->Password;

            $user->save();

            return redirect('/profile')->with('success', 'User updated successfully');
        }

}
