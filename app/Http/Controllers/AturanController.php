<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Keputusan;
use App\Models\Variabel;
use App\Services\AturanService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class AturanController extends Controller
{
    protected $aturan;

    public function __construct(AturanService $as)
    {
        $this->aturan = $as;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aturan = Aturan::paginate(10);
        return view('aturan.index', compact('aturan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keputusan = Keputusan::all();
        $variabel = Variabel::with('himpunan')->get();
        return view('aturan.create', compact(['keputusan', 'variabel']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->aturan->handleStore($request->all());

        return redirect()->route('aturan.index')->with('pesan', "Data berhasil diinput");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Aturan $aturan
     * @return \Illuminate\Http\Response
     */
    public function show(Aturan $aturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Aturan $aturan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aturan = Aturan::findOrFail($id);
        $keputusan = Keputusan::all();
        return view('aturan.edit', compact(['aturan', 'keputusan']));
    }

    public function editDetailAturan($id)
    {
        $detailAturan = Aturan::with('himpunan')->findOrFail($id);
        $variabel = Variabel::all();
        return view('aturan.editdetail', compact(['detailAturan', 'variabel']));
        // return $detailAturan->himpunan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aturan $aturan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->update([
            'kode' => $request->input('kode'),
            'mb' => $request->input('mb'),
            'md' => $request->input('md'),
            'keputusan_id' => $request->input('keputusan_id'),
        ]);

        return redirect()->route('aturan.index')->with('pesan', "Data berhasil diinput");
    }

    public function updateDetailAturan(Request $request, $id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->himpunan()->sync(array_filter($request->input('himpunan_id')));

        return redirect()->route('aturan.index')->with('pesan', "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Aturan $aturan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aturan = Aturan::findOrFail($id);
        if ($aturan->himpunan()) {
            $aturan->himpunan()->detach();
        }

        $aturan->delete();

        return redirect()->route('aturan.index')->with('pesan', "Detail aturan berhasil dihapus!");
    }

    public function aturanHimpunan($id)
    {
        // dd($request->all());
        $aturan = Aturan::findOrFail($id);
        $variabel = Variabel::with('himpunan')->get();
        // dd($request->all());
        return view('aturan.detailaturan', compact(['aturan', 'variabel']));
    }

    public function handleAturanDetail(Request $request, $id)
    {
        $aturan = Aturan::findOrFail($id);


        $aturan->himpunan()->attach(array_filter($request->input('himpunan_id')));

        return redirect()->route('aturan.index')->with('pesan', "Detail aturan berhasil diinput");
    }

    public function printAturan()
    {
        $data = Aturan::with(['himpunan', 'keputusan'])->get();
        $date = date('d-m-Y');
        return PDF::loadView('aturan.cetak', ['data' => $data, 'date' => $date])->setPaper('A4', 'landscape')->stream('Laporan-basis-pengetahuan-pdf');

    }
}
