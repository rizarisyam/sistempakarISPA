@extends('adminlte::page')

@section('title', 'Manage Aturan')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">


        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                        <h6 class="text-primary mt-2">Manage Aturan</h6>
                    </div>
                    <div>

                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-12 col-md-4">
                        <form action="{{route('aturan.update', $aturan->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="kode">Kode Aturan</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode"
                                    name="kode" value="{{old('kode') ?? $aturan->kode}}">
                            </div>

                            <div class="form-group">
                                <label for="mb">MB</label>
                                <input type="number" class="form-control @error('mb') is-invalid @enderror" id="mb"
                                    name="mb" value="{{old('mb') ?? $aturan->mb}}">
                            </div>

                            <div class="form-group">
                                <label for="md">MD</label>
                                <input type="number" class="form-control @error('md') is-invalid @enderror" id="md"
                                    name="md" value="{{old('md') ?? $aturan->md}}">
                            </div>

                            <div class="form-group my-5">
                                <select name="keputusan_id" id=""
                                    class="form-control @error('keputusan_id') is-invalid @enderror">
                                    <option value="">Pilih keputusan atau penyakit</option>

                                    @foreach ($keputusan as $key=>$row)
                                    <option value="{{$row->id}}" {{ $row->id == $aturan->keputusan_id ? 'selected' : '' }}>{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="col-md-6 mt-4">

                        @if ($errors->any())

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> {{$error}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endforeach

                        @endif

                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
