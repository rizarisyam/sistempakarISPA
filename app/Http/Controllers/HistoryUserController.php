<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Keputusan;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
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

    public function cetakKonsultasi($id)
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

        $dompdf = PDF::loadView('user.riwayat.cetak',compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue']));
        // return view('user.riwayat.cetak',compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue']));
        $dompdf->setPaper('A4', 'landscape');
        return $dompdf->stream('Diagnosa-'.date('dmY'));
    }



}
