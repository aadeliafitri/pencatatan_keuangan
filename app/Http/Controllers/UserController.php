<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function DaftarKeuanganUser() {
        // try {
            $users = User::all();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'keuangan' => [
                    'pendapatan' => $user->totalKeuanganMasuk(),
                    'pengeluaran' => $user->totalKeuanganKeluar(),
                    'saldo' => $user->saldoKeuangan(),
                ],
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data pengguna dan rekap keuangan berhasil ditampilkan',
        ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Data pengguna dan rekap keuangan gagal ditampilkan',
        //     ]);
        // }
        
    }
}
