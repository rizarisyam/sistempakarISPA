<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\Himpunan;
use App\Models\Konsultasi;
use App\Models\User;
use App\Models\Variabel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $gejala = Variabel::all();
        $himpunan = Himpunan::all();
        $aturan = Aturan::all();
        $user = User::where('role', 'user')->get();
        $konsultasi = Konsultasi::all();
        return view('admin.dashboard', compact(['gejala', 'himpunan', 'aturan', 'user', 'konsultasi']));
    }
}
