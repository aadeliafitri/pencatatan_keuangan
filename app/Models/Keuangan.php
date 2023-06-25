<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_catatan',
        'nama_catatan',
        'kategori',
        'jumlah',
        'id_user',
    ];
    protected $primaryKey = 'id_catatan';


    public function user() {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}
