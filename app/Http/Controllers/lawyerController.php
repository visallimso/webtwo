<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Lawyers;
use Hash;
use Session;

class lawyerController extends Controller
{
    public function signinLawyer(){

        return view('signinLawyer');

    }

    public function register_lawyer (){

        return view('register_lawyer');
    }

    public function registerLawyer(Request $request){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',
            'phoneNumber' => 'required',
            'emailAddress' => 'required|email|unique:lawyers,email',
            'Password' => 'required',
            'education' => 'required',
            'accomplishment' => 'required',
        ]);

        $law = new lawyers();
        $law->first_name = $request->firstName;
        $law->last_name = $request->lastName;
        $law->date_of_birth = $request->dob;
        $law->gender = $request->gender;
        $law->Field = $request->field;
        $law->phone_number = $request->phoneNumber;
        $law->email = $request->emailAddress;
        // $user->password = $request->Password;
        //if u want to encrypted the pw
        $law->password = Hash::make($request->Password);
        $law->education = $request->education;
        $law->accomplishment = $request->accomplishment;

        $res = $law->save();
        if($res){
            return back()->with('success','You have registerd');
        }else{
            return back()->with('fail','You have failed registaration');
        }
    }

    public function loginLawyer (Request $request){
        // $request->validate([
        //     'emailAddress' => 'required',
        //     'Password' => 'required',
        // ]);

        $law = lawyers::where('email','=',$request->emailAddress)->first();
        if ($law && Hash::check($request->Password, $law->password)) {
            $request->session()->put('loginId', $law->id);
            return redirect('/lawhome');
        } else {
            return back()->with('fail', 'Your password is incorrect');
        }             
    }

    public function lawhome(Request $request){
        return view('lawhome');
    }

    public function lawabout(Request $request){
        return view('lawyer.lawabout');
    }

    public function lawannoucement(Request $request){
        return view('lawyer.lawannoucement');
    }

    public function lawcontact(Request $request){
        return view('lawyer.lawcontact');
    }

    public function dashboard()
    {
        $data1 = null;

        if (Session::has('loginId')) {
            $userId = Session::get('loginId');

            $data1 = Lawyers::find($userId);

            if (!$data1) {
                return redirect('/')->with('fail', 'User not found');
            }
        } else {
            return redirect('/signinLawyer')->with('fail', 'Login required');
        }

        return view('dashboard', compact('data1'));
    }

    public function lawyershow()
    {
        $data1 = null;

        if (Session::has('loginId')) {
            $userId = Session::get('loginId');

            $data1 = Lawyers::find($userId);

            if (!$data1) {
                return redirect('/')->with('fail', 'User not found');
            }
        } else {
            return redirect('/signinLawyer')->with('fail', 'Login required');
        }

        return view('lawyershow', compact('data1'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('loginId');
        $request->session()->flush();

        return redirect('/signinLawyer')->with('success', 'Logged out successfully');
    }

    public function lawyeredit(Request $request)
    {
        $userId = $request->id;

        $law = Lawyers::find($userId);

        if (!$law) {
            return back()->with('fail', 'User not found');
        }

        return view('lawyeredit', compact('law'));
    }

    public function update1(Request $request)
        {
            $userId = $request->id;

            $law = lawyers::find($userId);

            if (!$law) {
                return back()->with('fail', 'User not found');
            }

            $law->first_name = $request->firstName;
            $law->last_name = $request->lastName;
            $law->date_of_birth = $request->dob;
            $law->gender = $request->gender;
            // $user->email = $request->emailAddress;
            // $user->password = $request->Password;
            // $law->Field = $request->field;
            $law->phone_number = $request->phoneNumber;
            $law->education = $request->education;
            $law->accomplishment = $request->accomplishment;

            $law->save();

            return redirect('/dashboard')->with('success', 'User updated successfully');
        }
}
