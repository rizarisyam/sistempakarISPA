<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzyfikasi extends Model
{
    use HasFactory;

    protected $table = 'fuzzyfikasi';

    protected $fillable = ['konsultasi_id', 'nilai', 'himpunan_id'];
}
