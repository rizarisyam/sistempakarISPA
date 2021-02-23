@extends('layouts.user.app')

@section('hero')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>SELAMAT DATANG DI SISTEM PAKAR ISPA</h1>
        <blockquote class="blockquote">
            <p class="mb-0 ">Waktu dan kesehatan adalah dua aset berharga yang tidak dikenali dan hargai sampai keduanya hilang.</p>
            <footer class="blockquote-footer"><cite title="Source Title">Denis Waitley</cite></footer>
          </blockquote>
        <a href="{{route('user-konsultasi.index')}}" class="btn-get-started scrollto">Konsultasi Sekarang</a>
    </div>
</section><!-- End Hero -->

@endsection
