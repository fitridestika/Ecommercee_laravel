<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul', 'nama', 'nim', 'angkatan', 'dosen_pembimbing_1', 'dosen_pembimbing2'
    ];
}
