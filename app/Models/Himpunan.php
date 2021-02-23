<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Himpunan extends Model
{
    use HasFactory;

    protected $table = "himpunan";

    protected $fillable = ['variabel_id', 'nama', 'domain'];

    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }
    public function variabel()
    {
        return $this->belongsTo(Variabel::class);
    }

    public function aturan()
    {
        return $this->belongsToMany(Aturan::class, 'aturan_himpunan');
    }

    public function konsultasi()
    {
        return $this->belongsToMany(konsultasi::class, 'fuzzyfikasi')->withPivot('nilai')->withTimestamps();
    }
}
