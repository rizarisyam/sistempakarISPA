<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;

    protected $table = 'keputusan';

    protected $fillable = ['nama', 'kode', 'keterangan', 'saran'];

    public function getKodeAttribute($value)
    {
        return ucfirst($value);
    }

    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }

    public function aturan()
    {
        return $this->hasMany(Aturan::class);
    }
}
