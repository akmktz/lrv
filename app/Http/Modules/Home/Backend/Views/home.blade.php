@extends('layouts.backend')


@section('content')
    {{ url('/') }}
    <br>
    <img src="{{asset('img/photo1.png')}}" style="max-width: 400px; max-height: 300px">
@endsection
