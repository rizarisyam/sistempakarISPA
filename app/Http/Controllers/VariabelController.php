<?php

namespace App\Http\Controllers;

use App\Models\Variabel;
use Illuminate\Http\Request;

use App\Imports\VariabelImport;
use Maatwebsite\Excel\Facades\Excel;

// class requrest khusus untuk method create
use App\Http\Requests\Variabel\create;
use App\Services\VariabelService;

class VariabelController extends Controller
{
    protected $variabel;

    public function __construct(VariabelService $var)
    {
        $this->variabel = $var;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $variabel = Variabel::paginate(10);
        $filter = $request->query('search');

        if($filter) {
            $variabel = Variabel::where('nama', 'LIKE', "%$filter%")->paginate(15)->withQueryString();
        }
        return view('variabel.index', compact('variabel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variabel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(create $request )
    {
        $this->variabel->store($request->all());

        return redirect()->route('variabel.index')->with('pesan', "Data berhasil diinput");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function show(Variabel $variabel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $variabel = Variabel::findOrFail($id);

        return view('variabel.edit', compact('variabel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function update(create $request, $id)
    {
        $this->variabel->update($request->all(), $id);

        return redirect()->route('variabel.index')->with('pesan', "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variabel = Variabel::findOrFail($id);
        $variabel->delete();
        return redirect()->route('variabel.index')->with('pesan', "Data berhasil dihapus");
    }

    public function importExcel(Request $request)
    {
        Excel::import(new VariabelImport, $request->file('file'));
        
        return redirect()->route('variabel.index')->with('pesan', "Data berhasil diimport");
    }
}
