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
        $date = date("d-m-Y");
        foreach($diagnosa as $row) {
            $nilai = json_decode($row->nilai);
        }
        // dump($nilai);
        $maxIndex = null;
        $maxValue = max($nilai);

        $maxIndex = array_search($maxValue, $nilai);

        $dompdf = PDF::loadView('konsultasi.cetakbyid',compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue']));
        // return view('konsultasi.cetakbyid',compact(['konsultasi', 'maxIndex', 'keputusan', 'maxValue', 'date']));

        $dompdf->setPaper('A4', 'landscape');
        return $dompdf->stream('Diagnosa-'.date('dmY'));


    }
}
