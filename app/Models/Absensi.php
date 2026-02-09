<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Absensi extends Model implements HasMedia
{
    use HasFactory, HasRoles, InteractsWithMedia;
    protected $fillable = [
        'karyawan_id',
        'foto_absensi',
        'date',
        'check_in',
        'check_out',
        'status',
    ];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
