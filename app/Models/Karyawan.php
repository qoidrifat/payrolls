<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

class Karyawan extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'npwp',
        'nomor_rekening_bank',
        'department_id',
        'position',
        'status',
        'user_id', // Tambahkan user_id ke fillable
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo // Tambahkan return type BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
