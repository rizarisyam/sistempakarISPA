<?php

namespace App\Http\Controllers;

use App\Models\Keputusan;
use App\Models\Konsultasi;
use App\Models\Variabel;
use Illuminate\Http\Request;

use App\Services\KonsultasiService;
use Illuminate\Support\Facades\DB;
use App\Models\Aturan;
use App\Models\Diagnosa;
use App\Models\User;


class KonsultasiController extends Controller
{
    protected $konsul;

    public function __construct(KonsultasiService $ks)
    {
        $this->konsul = $ks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('konsultasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("konsultasi.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $konsultasi = Konsultasi::create([
            'user_id' => auth()->id(),
            'nama' => $request->input('nama'),
        ]);
        return redirect()->route('konsultasi.pertanyaan');
    }

    public function konsultasi()
    {
        // gejala
        $variabel = Variabel::all();

        if (auth()->check() && auth()->user()->role == 'user') {
            $path = 'user.konsultasi.konsultasi';
        } elseif(auth()->check() && auth()->user()->role == 'admin') {
            $path = "konsultasi.konsultasi";
        }

        return view($path, compact(['variabel']));
    }

    public function handleKonsultasi(Request $request)
    {

        $konsultasi_id =
            Konsultasi::findOrFail($request->input('konsultasi_id'));

        $variabel_id = $request->input('variabel_id');
        $nilai = $request->input('nilai');


        foreach ($nilai as $key => $value) {
            $konsultasi_id->variabel()->attach($variabel_id[$key], ['nilai' => $value]);
        }

        $min = $this->konsul->min();


        $aturan = Aturan::all();

        foreach ($min as $key => $row) {
            $konsultasi_id->konsultasiAturan()->attach($aturan[$key], ['nilai' => $row]);
        }


        return redirect()->route('konsultasi.hasilDiagnosa');
    }

    public function hasilDiagnosa()
    {
        $konsul_id = User::findOrFail(auth()->id())->konsultasi()->latest()->first()->id;


        $z = $this->konsul->defuzzyfikasi();

        $konsultasi = Konsultasi::with('konsultasiAturan')->where('id', $konsul_id)->get();
        $aturan = Aturan::all();
        // dump($aturan);
        $cfRule = array();
        $cfTotal = array();

        foreach ($konsultasi as $key => $konsul) {
            foreach ($aturan as $key => $row) {
                $minRule = $konsul->konsultasiAturan[$key]['pivot']->nilai;

                // dump($minRule);
                if ($minRule == 0) {
                    $hasil = $minRule * $row->getCertaintyFactorAttribute();
                    array_push($cfRule, $hasil);
                } else {
                    $hasil = $z * $row->getCertaintyFactorAttribute();
                    array_push($cfRule, $hasil);
                }



                // array_push($cfRule, $konsul->konsultasiAturan[$key]['pivot']->nilai * $row->getCertaintyFactorAttribute());


            }
            // dump($cfRule);
        }

        $p1 = ($cfRule[4] + $cfRule[7]) * (1 - $cfRule[4]);
        array_push($cfTotal, $p1);
        $p2 = ($cfRule[3] + $cfRule[9]) * (1 - $cfRule[3]);
        array_push($cfTotal, $p2);
        $p3 = ($cfRule[2] + $cfRule[8]) * (1 - $cfRule[2]);
        array_push($cfTotal, $p3);
        $p4 = ($cfRule[1] + $cfRule[6]) * (1 - $cfRule[1]);
        array_push($cfTotal, $p4);
        $p5 = ($cfRule[0] + $cfRule[5]) * (1 - $cfRule[0]);
        array_push($cfTotal, $p5);

        // dump($cfTotal);




        // dump($konsultasi);
        // $dfuzzy = $this->konsul->defuzzyfikasi();

        Diagnosa::create([
            'konsultasi_id' => $konsul_id,
            'nilai' => json_encode($cfTotal)
        ]);

        return redirect()->route('konsultasi.showDiagnosa');
    }

    public function showDiagnosa()
    {
        $konsul_id = User::findOrFail(auth()->id())->konsultasi()->latest()->first()->id;

        $diagnosa = DB::table('diagnosa')->where('konsultasi_id', $konsul_id)->first();
        $keputusan = Keputusan::all();
        $konsultasi = Konsultasi::with('variabel')->latest()->first();
        // dump($konsultasi);

        $nilai = json_decode($diagnosa->nilai);
        $maxIndex = null;
        $maxValue = max($nilai);
        // dump($nilai);
        // dump($maxValue);
        $maxIndex = array_search($maxValue, $nilai);
        // dump($maxIndex);

        $penyakit = null;
        $persentase = null;

        foreach($keputusan as $key => $row) {
            if ($maxIndex == $key) {
                $penyakit = $row->nama;
                $persentase = number_format($maxValue * 100, 2);
                break;
            }
        }


        return view('konsultasi.diagnosa', compact(['penyakit', 'persentase', 'konsultasi']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function show(Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsultasi $konsultasi)
    {
        //
    }
}
