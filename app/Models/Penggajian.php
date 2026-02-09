<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penggajian extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [ // Pastikan ini didefinisikan
        'karyawan_id',
        'tanggal_penggajian',
        'gaji_pokok',
        'tunjangan',
        'upah_lembur',
        'bonus',
        'potongan',
        'gaji_bersih',
        'periode_penggajian',
    ];
    // Casting tipe data
    protected $casts = [
        'gaji_pokok' => 'float',
        'tunjangan' => 'float',
        'upah_lembur' => 'float',
        'bonus' => 'float',
        'potongan' => 'float',
        'gaji_bersih' => 'float'
    ];

    // Relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // Mutator untuk membersihkan input gaji pokok
    public function setGajiPokokAttribute($value)
    {
        $this->attributes['gaji_pokok'] = $this->cleanNumber($value);
    }

    // Mutator untuk membersihkan input tunjangan
    public function setTunjanganAttribute($value)
    {
        $this->attributes['tunjangan'] = $this->cleanNumber($value);
    }

    // Mutator untuk membersihkan input upah lembur
    public function setUpahLemburAttribute($value)
    {
        $this->attributes['upah_lembur'] = $this->cleanNumber($value);
    }

    // Mutator untuk membersihkan input bonus
    public function setBonusAttribute($value)
    {
        $this->attributes['bonus'] = $this->cleanNumber($value);
    }

    // Mutator untuk membersihkan input potongan
    public function setPotonganAttribute($value)
    {
        $this->attributes['potongan'] = $this->cleanNumber($value);
    }

    // Metode pembersih angka
    private function cleanNumber($value)
    {
        return (float) str_replace(['IDR', '.', ','], ['', '', '.'], $value ?? 0);
    }

    // Accessor untuk format tampilan gaji pokok
    public function getGajiPokokFormattedAttribute()
    {
        return 'IDR ' . number_format($this->gaji_pokok, 0, ',', '.');
    }

    // Metode untuk menghitung gaji bersih
    public function hitungGajiBersih()
    {
        return max(
            0,
            $this->gaji_pokok +
                $this->tunjangan +
                $this->upah_lembur +
                $this->bonus -
                $this->potongan
        );
    }
}
