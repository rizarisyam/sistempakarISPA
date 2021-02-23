@extends('adminlte::page')

@section('title', 'Detail Aturan')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">


        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                        <h6 class="text-primary mt-2">Detail Aturan</h6>

                    </div>
                    <div>
                        <h6 class="text-primary mt-2">Kode aturan <span class="text-dark font-weight-bold">{{$aturan->kode}}</span></h6>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-12 col-md-6">
                        <form action="{{route('handle.detailaturan', $aturan->id)}}" method="POST">
                            @csrf

                            @foreach ($variabel as $key=>$item)
                            <div class="form-group">
                                <span>{{$loop->iteration}}</span>
                                <label for="">[{{$item->kode}}]{{$item->nama}}</label>

                                <select name="himpunan_id[]" id="" class="form-control @error('himpunan_id') is-invalid @enderror">
                                    <option value="">Pilih himpunan</option>
                                    @foreach ($item->himpunan as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>

                                    @endforeach
                                </select>
                            </div>
                            @endforeach

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
