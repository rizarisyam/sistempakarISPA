@extends('layouts.user.app')


@section('section-title')
<div class="section-title">
    <h2>Konsultasi</h2>

</div>
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">


                        <div>
                            <div class="text-center my-3">
                                <h4>Form Konsultasi</h4>
                            </div>
                            <form action="{{route('user-konsultasi.store')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                    <div id="" class="form-text text-muted">Nama samaran kalau tidak boleh anda kosongkan saja.</div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Mulai konsultasi</button>
                                </div>
                            </form>
                        </div>
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
