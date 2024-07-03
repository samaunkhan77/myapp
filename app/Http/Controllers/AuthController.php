<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            toastify()->success('Your action was successful!');
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

            $user = User::where('mobile', $request->input('mobile'))->first();
            if ($user !== null && Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                $request->session()->put('user', $user);
                toastify()->success('Your action was successful!');
                return response()->json(['success' => 'Login successfully', 'token' => $token]);
            }

            toastify()->error('Sorry, Try to a valid mobile and password');
            return response()->json(['error' => 'Sorry, Try to a valid mobile and password']);

        }catch (Exception $e) {
            toast()->error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function dashboard()
    {
        return view('backend.components.dashboard');
    }


    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return response()->json(['status' => 'success', 'message' => 'Logged out successfully']);
    }
}
