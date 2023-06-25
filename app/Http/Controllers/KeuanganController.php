<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeuanganController extends Controller
{
    public function CreateCatatan(Request $request) {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
			'nama_catatan' => 'required|string',
			'kategori' => 'required',
			'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $keuangan = Keuangan::Create([
            'nama_catatan' => request('nama_catatan'),
            'kategori' => request('kategori'),
            'jumlah' => request('jumlah'),
            'id_user' => $user->id,
        ]);

        if ($keuangan) {
            return response()->json([
                'status' => true,
                'data' => $keuangan, 
                'message' => 'Data Keuangan Berhasil Ditambahkan']);
        }else {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Data Keuangan Gagal Ditambahkan']);
        }
    }

    public function UpdateCatatan(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'nama_catatan' => 'required|string',
                'kategori' => 'required',
                'jumlah' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->messages());
            }
    
            $keuangan = Keuangan::where('id_catatan', $id)->first();
            $keuangan->nama_catatan = $request->nama_catatan;
            $keuangan->kategori = $request->kategori;
            $keuangan->jumlah = $request->jumlah;
            $keuangan->save();
    
            
                return response()->json([
                    'status' => true,
                    'data' => $keuangan, 
                    'message' => 'Data Keuangan Berhasil Diubah']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Data Keuangan Gagal Diubah']);
        }
    }
}
