@extends('layouts.user.app')

@section('section-title')
<div class="section-title">
    <h2>User Detail</h2>
    <p><i class="fas fa-user" style="font-size: 7rem"></i></p>
</div>
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" value="{{$user->name}}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" value="{{$user->email}}" class="form-control" disabled>
                    </div>

                </form>
                <div>
                    <a href="{{route('user-setting.edit', auth()->id())}}">
                        <button type="button" class="btn btn-success">Update Profil</button>
                    </a>
                    {{-- <a href="{{route('user-setting.editpass', auth()->id())}}">
                    <button type="button" class="btn btn-success">Update Password</button>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
