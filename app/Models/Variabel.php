<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variabel extends Model
{
    use HasFactory;

    protected $table = "variabel";

    protected $fillable = ['nama', 'kode', 'keterangan'];

    public function getKodeAttribute($value)
    {
        return ucfirst($value);
    }

    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }

    public function himpunan()
    {
        return $this->hasMany(Himpunan::class);
    }

    public function konsultasi()
    {
        return $this->belongsToMany(Konsultasi::class, 'konsultasi_variabel')->withPivot('nilai')->withTimestamps();
    }
}
