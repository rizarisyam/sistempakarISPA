<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $table = "diagnosa";

    protected $fillable = ['konsultasi_id', 'nilai'];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }
}
