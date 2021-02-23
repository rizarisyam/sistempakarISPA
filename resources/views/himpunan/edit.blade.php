

@extends('adminlte::page')

@section('title', 'Manage Himpunan')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">


        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                        <h6 class="text-primary mt-2">Manage Himpunan</h6>
                    </div>
                    <div>

                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-12 col-md-6 mt-2">
                        <form action="{{route('himpunan.update', $himpunan->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select name="variabel_id" id=""
                                            class="form-control @error('variabel_id') is-invalid @enderror">
                                            <option value="">Pilih Variabel atau gejala</option>
                                            @foreach ($variabel as $row)

                                            <option value="{{$row->id}}" {{$himpunan->variabel->nama == $row->nama ? 'selected' : ''}}>{{$row->nama}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="nama">Nama Himpunan</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{old('nama') ?? $himpunan->nama}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Batas-batas Himpunan</label>
                                        <div class="row">
                                            <div class="col-12" id="parentcol">
                                                @foreach (json_decode($himpunan->domain) as $item)
                                                <input type="text"
                                                class="form-control mb-2 @error('domain[]') is-invalid @enderror"
                                                name="domain[]" value="{{$item}}">
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>

                    <div class="col-md-6 mt-1">

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
<script>
    $(document).ready(function() {




    })
</script>
@stop
