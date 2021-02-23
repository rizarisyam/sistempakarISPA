@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="row">
    <div class="col-12">


        <div class="card">
            <h5 class="card-header">Dashboard</h5>
            <div class="card-body">
                <div class="container">


                    <div class="row">


                        <div class="col">

                            <div class="card shadow h-100" style="width: 12rem;">
                                <img class="card-img-top" src="{{asset('images/img1.png')}}" alt="Card image cap">
                                {{-- <span><i class="fas fa-file-medical-alt" style="font-size: 8rem;"></i></span> --}}
                                <div class="card-body d-flex flex-column align-items-center">
                                    <p class="card-text">GEJALA</p>
                                    <p class="card-text">Total gejala <strong>{{count($gejala)}}</strong></p>
                                    <a href="{{route('variabel.index')}}">
                                        <button type="button" class="btn btn-primary">Details</button>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="col">

                            <div class="card shadow h-100" style="width: 12rem;">
                                <img class="card-img-top" src="{{asset('images/img2.jpg')}}" alt="Card image cap">
                                {{-- <span><i class="fas fa-file-medical-alt" style="font-size: 8rem;"></i></span> --}}
                                <div class="card-body d-flex flex-column align-items-center">
                                    <p class="card-text">Himpunan</p>
                                    <p class="card-text">Total himpunan <strong>{{count($himpunan)}}</strong></p>
                                    <a href="{{route('himpunan.index')}}">
                                        <button type="button" class="btn btn-primary">Details</button>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="col">

                            <div class="card shadow h-100" style="width: 12rem;">
                                <img class="card-img-top" src="{{asset('images/img3.jpg')}}" alt="Card image cap">
                                {{-- <span><i class="fas fa-file-medical-alt" style="font-size: 8rem;"></i></span> --}}
                                <div class="card-body d-flex flex-column align-items-center">
                                    <p class="card-text">Basis Pengetahuan</p>
                                    <p class="card-text">Total aturan <strong>{{count($aturan)}}</strong></p>
                                    <a href="{{route('aturan.index')}}">
                                        <button type="button" class="btn btn-primary">Details</button>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="col">

                            <div class="card shadow h-100" style="width: 12rem;">
                                <img class="card-img-top" src="{{asset('images/kon.png')}}" alt="Card image cap">
                                {{-- <span><i class="fas fa-file-medical-alt" style="font-size: 8rem;"></i></span> --}}
                                <div class="card-body d-flex flex-column align-items-center">
                                    <p class="card-text">KONSULTASI</p>
                                    <p class="card-text">Total konsultasi <strong>{{count($konsultasi)}}</strong></p>
                                    <a href="{{route('admin-konsultasi.index')}}">
                                        <button type="button" class="btn btn-primary">Details</button>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="col">

                            <div class="card shadow h-100" style="width: 12rem;">
                                <img class="card-img-top" src="{{asset('images/img5.png')}}" alt="Card image cap">
                                {{-- <span><i class="fas fa-file-medical-alt" style="font-size: 8rem;"></i></span> --}}
                                <div class="card-body d-flex flex-column align-items-center">
                                    <p class="card-text">Pengguna</p>
                                    <p class="card-text">Total pengguna <strong>{{count($user)}}</strong></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')

<script>

</script>

@endsection
