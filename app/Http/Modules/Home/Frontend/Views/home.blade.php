@extends('layouts.frontend')


@section('content')
    {{ url('/') }}
    @widget('test')
{{--    {{ Widget::run('test') }}--}}
@endsection
