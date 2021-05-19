

@extends('adminlte::page')

@section('title', 'Manage Variabel')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">


        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                        <h6 class="text-primary mt-2">Manage Variabel</h6>
                    </div>
                    <div>

                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-12 col-md-6">
                        <form action="{{route('keputusan.update', $keputusan->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="nama">Nama Keputusan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{old('nama') ?? $keputusan->nama}}">
                            </div>

                            <div class="form-group">
                                <label for="keterangan" style="font-size: 1rem !important">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="10">{{old('keterangan') ?? $keputusan->keterangan}}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="saran" style="font-size: 1rem !important">Saran</label>
                                <textarea name="saran" id="saran" cols="30" rows="10">{{old('saran') ?? $keputusan->saran}}</textarea>
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
<script>
    $(document).ready(function() {

    CKEDITOR.replace('keterangan', {
        language: 'id'
    });
    CKEDITOR.replace('saran', {
        language: 'id'
    });
    CKEDITOR.config.allowedContent = true;

})
</script>
@stop
