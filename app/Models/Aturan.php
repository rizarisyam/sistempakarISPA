<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $table = 'aturan';

    protected $fillable = ['keputusan_id', 'kode', 'mb', 'md'];

    public function getKodeAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCertaintyFactorAttribute() {
        return number_format($this->md / $this->mb, 2);
    }
    public function keputusan()
    {
        return $this->belongsTo(Keputusan::class);
    }

    public function himpunan()
    {
        return $this->belongsToMany(Himpunan::class, 'aturan_himpunan');
    }

    public function aturankonsultasi()
    {
        return $this->belongsToMany(Konsultasi::class, 'aturan_konsultasi')->withPivot('nilai');
    }
}
