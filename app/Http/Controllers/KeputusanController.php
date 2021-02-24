<?php

namespace App\Http\Controllers;

use App\Models\Keputusan;
use Illuminate\Http\Request;
use App\Http\Requests\Keputusan\store;
use App\Services\KeputusanService;

use Barryvdh\DomPDF\Facade as PDF;

use App\Imports\KeputusanImport;
use Maatwebsite\Excel\Facades\Excel;
class KeputusanController extends Controller
{

    protected $keputusan;

    public function __construct(KeputusanService $ks)
    {
        $this->keputusan = $ks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keputusan = Keputusan::paginate(10);

        $filter = request()->query('search');

        if($filter) {
            $keputusan = Keputusan::where('nama', 'LIKE', "%$filter%")->paginate(15)->withQueryString();
        }

        return view('keputusan.index', compact('keputusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keputusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(store $request)
    {
        $this->keputusan->store($request->all());

        return redirect()->route('keputusan.index')->with('pesan', "Data berhasil diinput");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function show(Keputusan $keputusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keputusan = $this->keputusan->edit($id);

        return view('keputusan.edit', compact('keputusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->keputusan->handleUpdate($request->all(), $id);

        return redirect()->route('keputusan.index')->with('pesan', "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keputusan = Keputusan::findOrFail($id);
        $keputusan->delete();

        return redirect()->route('keputusan.index')->with('pesan', "Data berhasil dihapus");
    }

    public function importExcel(Request $request)
    {
        Excel::import(new KeputusanImport, $request->file('file'));

        return redirect()->route('keputusan.index')->with('pesan', "Data berhasil diimport");
    }

    public function printKeputusan()
    {
        $data = Keputusan::all();
        $date = date('Y-m-d');

        $pdf = PDF::loadView('keputusan.cetak', ['data' => $data, 'date' => $date])->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-data-penyakit-pdf');
    }
}
