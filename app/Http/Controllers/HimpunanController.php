<?php

namespace App\Http\Controllers;

use App\Models\Himpunan;
use App\Models\Variabel;
use Illuminate\Http\Request;
use App\Http\Requests\Himpunan\store;
use App\Services\HimpunanService;

use App\Imports\HimpunanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HimpunanController extends Controller
{
    protected $himpunan;

    public function __construct(HimpunanService $h)
    {
        $this->himpunan = $h;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $himpunan = Himpunan::with('variabel')->paginate(10);

        // filter berdasarkan nama himpunan
        $search = request()->query('search');

        $search ? $himpunan = Himpunan::where('nama', 'LIKE', "%$search%")->paginate(10) : null;

        return view('himpunan.index', compact('himpunan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variabel = Variabel::get();
        return view('himpunan.create', compact('variabel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(store $request)
    {

        DB::table('himpunan')->truncate();
        $this->himpunan->store($request->all());
        return redirect()->route('himpunan.index')->with('pesan', "Data berhasil diinput");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function show(Himpunan $himpunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $himpunan = Himpunan::findOrFail($id);
        $variabel = Variabel::get();
        return view('himpunan.edit', compact(['himpunan', 'variabel']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function update(store $request, $id)
    {
        $this->himpunan->update($request->all(), $id);

        return redirect()->route('himpunan.index')->with('pesan', "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $himpunan = Himpunan::findOrFail($id);

        $himpunan->delete();

        return redirect()->route('himpunan.index')->with('pesan', "Data berhasil dihapus");
    }

    public function importExcel(Request $request)
    {
        Excel::import(new HimpunanImport, $request->file('file'));

        return redirect()->route('himpunan.index')->with('pesan', "Data berhasil diimport");
    }
}
