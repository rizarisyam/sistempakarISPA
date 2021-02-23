@extends('adminlte::page')

@section('title', 'Konsultasi')

@section('content')



<div class="card">
    <div class="card-body ">
        <div class="row">
            <div class="col-md-3">

                <form action="{{route('admin.konsultasi.simpan')}}" method="post">
                    @csrf

                    @foreach (auth()->user()->konsultasi as $item)
                    <input type="hidden" value="{{$item->id}}" name="konsultasi_id">
                    @endforeach

                    @foreach ($variabel as $var)
                    <div class="form-group">
                        <input type="hidden" value="{{$var->id}}" name="variabel_id[]">
                        <label for="">[{{$var->kode}}]</label>
                        <label for="">{{$var->nama}}</label>
                        <input type="text" name="nilai[]" class="form-control">
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
