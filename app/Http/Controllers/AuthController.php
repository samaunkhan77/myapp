<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registration()
    {
        return view('backend.pages.auth.sign-up');
    }

    public function registrationPost(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $data = [
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ];
            User::create($data);
            toast()->success('Registration successfully');
            return response()->json(['success' => 'Registration successfully']);

        }catch (Exception $e) {
            toast()->error($e->getMessage());
            return $e->getMessage();
        }
    }


    public function login()
    {
        return view('backend.pages.auth.sign-in');
    }

    public function loginPost(Request $request)
    {
        try{
            $request->validate([
                'mobile' => 'required',
                'password' => 'required'
            ]);

            if(auth()->attempt(['mobile' => $request->input('mobile'), 'password' => $request->input('password')])) {
                toast()->success('Login successfully');
                return redirect()->route('dashboard')->with('success', 'Login successfully');
            }

            toast()->error('Login failed');
            return redirect()->back();

        }catch (Exception $e) {
            toast()->error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function dashboard()
    {
        return view('backend.components.dashboard');
    }
}
