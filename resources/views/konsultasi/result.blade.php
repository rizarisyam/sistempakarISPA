{{-- @foreach ($konsultasi->variabel as $var)
   @foreach ($var->himpunan as $item) --}}
   {{-- @dump($var->pivot->nilai) --}}
    {{-- @dump(number_format((json_decode($item->domain)[1]-$var->pivot->nilai) / (json_decode($item->domain)[1]-json_decode($item->domain)[0]), 2))
   @endforeach
@endforeach --}}


@extends('adminlte::page')

@section('title', 'Konsultasi')

@section('content')

{{-- @foreach ($finalresult as $item)
@dump($item)
@endforeach --}}



<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <form action="" method="post">
                    @foreach (auth()->user()->konsultasi as $item)
                    <input type="text" value="{{$item->id}}" name="konsultasi_id">
                    @endforeach

                    @foreach ($variabel as $item)
                        <div class="form-group">
                            <label for="">{{$item->nama}}</label>
                        </div>
                        @foreach ($item->himpunan as $key => $item)
                            <div class="form-group">
                                <label for="">{{$item->nama}}</label>
                                <input type="hidden" value="{{$item->id}}" name="himpunan_id[]">
                                <input type="text" value="{{$finalresult[$key]}}">
                            </div>
                        @endforeach
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
