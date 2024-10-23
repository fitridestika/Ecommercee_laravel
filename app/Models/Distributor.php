<?php

namespace App\Models;

use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_distributor', 'kota', 'provinsi', 'kontak', 'email'
    ];
}
