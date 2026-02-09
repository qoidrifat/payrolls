<?php

// app/Models/Allowance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_tunjangan',
        'nominal',
    ];

    public function penggajians() {
        return $this->belongsToMany(Penggajian::class);
    }
}
