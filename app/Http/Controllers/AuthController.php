<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password' => 'required|min:6'
        ], [
            'required' => ':attribute tidak boleh kosong'
        ], [
            'email' => 'surel',
            'password' => 'sandi aplikasi'
        ]);
        $user = User::where('email', $request->email)->first();
        $code = 401;
        $message = "";
        $data = null;
        $status = "error";
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                //generate token
                $user->generateToken();
                $status = 'success';
                $message = 'Login Sukes';
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = "login gagal password salah";
            }
        } else {
            $message = "login gagal,email tidak terdaftar";
        }
        return \response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors;
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles'    => json_encode(['CUSTOMER']),
            ]);
            if ($user) {
                $user->generateToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'register failed';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => "success",
            'message' => "Logout Berhasil",
            'data' => null
        ], 200);
    }
    public function userInfo()
    {
        return response()->json([
        'status' => 'logged',
        'message' => 'user info',
        'data' => Auth::user()
    ], 200);
    }
}
