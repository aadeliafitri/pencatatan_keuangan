<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// 'App\Http\Controllers\Validator'

class ProfileController extends Controller
{
    public function UpdateProfile(Request $request) {
        $user = Auth::user();

        if ($user) {
            $validator = Validator::make(request()->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $user->id,
                // 'password' => 'required' 
             ]);
     
             if ($validator->fails()) {
                 return response()->json($validator->messages());
             }

            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'Profil berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'Profil gagal diperbarui'
            ]);
        }
    }
}
