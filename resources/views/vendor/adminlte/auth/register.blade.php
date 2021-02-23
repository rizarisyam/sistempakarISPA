@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
<form action="{{ $register_url }}" method="post">
    {{ csrf_field() }}

    {{-- Name field --}}
    <div class="form-group">
        <label for="">Nama Lengkap</label>

        <div class="input-group mb-3">

            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- Email field --}}
    <div class="form-group">
        <label for="">Email</label>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email') }}" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- Tanggal lahir field --}}
    <div class="form-group">
        <label for="">Tanggal Lahir</label>

        <div class="input-group mb-3">
            <input type="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                value="{{ old('date') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('date'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('date') }}</strong>
            </div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="">Jenis Kelamin</label>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="gender" value="L" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1">Laki-laki</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="gender" value="P" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2">Perempuan</label>
        </div>
    </div>


    {{-- Password field --}}
    <div class="form-group">
        <label for="">Password</label>

        <div class="input-group mb-3">
            <input type="password" name="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- Confirm password field --}}
    <div class="form-group">
        <label for="">Confirm Password</label>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- Register button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-user-plus"></span>
        {{ __('adminlte::adminlte.register') }}
    </button>

</form>
@stop

@section('auth_footer')
<p class="my-0">
    <a href="{{ $login_url }}">
        <span>Sudah punya akun, login sekarang</span>
    </a>
</p>
@stop
