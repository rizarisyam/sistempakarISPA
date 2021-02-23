@extends('layouts.user.app')

@section('section-title')
<div class="section-title">
    <h2>User Edit Password</h2>
    <p><i class="fas fa-user" style="font-size: 7rem"></i></p>
</div>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                  <form action="{{route('user-setting.update', auth()->id())}}" method="POST">
                    @csrf
                    @method('PATCH')
                      <div class="form-group">
                          <label for="">Nama Lengkap</label>
                          <input type="text" name="name" value="{{$user->name}}" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{$user->email}}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>

                </div>
              </div>
        </div>
    </div>
@endsection
