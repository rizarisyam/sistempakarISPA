<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama'];
    protected $table = 'konsultasi';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function variabel() {
        return $this->belongsToMany(Variabel::class, 'konsultasi_variabel')->withPivot('nilai')->withTimestamps();
    }

    public function himpunan()
    {
        return $this->belongsToMany(Himpunan::class, 'fuzzyfikasi')->withPivot('nilai')->withTimestamps();
    }

    public function konsultasiAturan()
    {
        return $this->belongsToMany(Aturan::class, 'aturan_konsultasi')->withPivot('nilai');
    }

    public function diagnosa()
    {
        return $this->hasMany(Konsultasi::class);
    }
}
