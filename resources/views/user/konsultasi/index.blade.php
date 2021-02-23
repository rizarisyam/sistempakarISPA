@extends('layouts.user.app')


@section('section-title')
<div class="section-title">
    <h2>Konsultasi</h2>
</div>
@endsection

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-6">


      <div class="card shadow">
        <div class="card-body">
          <div class="row">
            <div class="col-12">


              <div>
                <div class="text-center my-3">
                  <span style="font-size: 8rem !important"><i class="fas fa-user-md"></i></span>
                </div>
                <a href="{{route('user-konsultasi.create')}}">
                  <div class="text-center mt-4">
                      <button type="submit" class="btn btn-primary">Mulai konsultasi</button>
                  </div>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
