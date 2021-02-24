<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Keputusan;
use App\Models\Konsultasi;

use Barryvdh\DomPDF\Facade as PDF;


class AdminKonsultasiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $konsultasi = Konsultasi::paginate(10);

        return view('konsultasi.index', compact('konsultasi',));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
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
        return view('konsultasi.show', compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue']));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function printKonsultasiById($id)
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

        $date = date("d-m-Y");

        $maxIndex = array_search($maxValue, $nilai);
        return PDF::loadView('konsultasi.cetakbyid', ['date' => $date, 'konsultasi' => $konsultasi, 'maxIndex' => $maxIndex, 'keputusan' => $keputusan , 'maxValue' => $maxValue])->setPaper('A4', 'landscape')->stream('laporan-konsultasi-pdf');
    }
}
