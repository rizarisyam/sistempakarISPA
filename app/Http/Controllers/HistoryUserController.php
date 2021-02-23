<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Keputusan;
use App\Models\Konsultasi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\KonsultasiService;

class HistoryUserController extends Controller
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


        $user = Konsultasi::with('user')->where('user_id', auth()->id())->paginate(10);
        return view('user.riwayat.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $konsultasi = Konsultasi::with('variabel')->where('id', $id)->get();
        $diagnosa = Diagnosa::with('konsultasi')->where('konsultasi_id', $id)->get();
        $keputusan = Keputusan::all();

        $nilai = array();
        foreach($diagnosa as $row) {
            $nilai = json_decode($row->nilai);
        }
        // dump($nilai);
        $maxIndex = null;
        $maxValue = max($nilai);

        $maxIndex = array_search($maxValue, $nilai);
        // dump($maxIndex);

        return view('user.riwayat.show', compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
